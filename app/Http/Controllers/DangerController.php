<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sym;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\DangerSym;
use App\Danger;
use Yajra\DataTables\DataTables;
use App\Province;

class DangerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Зарласан онц байдал харуулдаг view харуулна
    public function showDangers(){
        try{
            $sectors = DB::table("tb_sectors")
                ->get();
            return view("danger.dangerShow", compact("sectors"));
        }catch(\Exception $e){
            return 'Серверийн алдаа!!! Веб мастерт хандана уу!!!';
        }
    }
    // Зарласан онц байдал харуулдаг view харуулна

    // онц байдал зарлсан id-аар нь тухайн онц байдалд оруулсан бүх сумдын мэдээллийг json хэлбэрээр буцаана
    public function getSumIDsByDangerID(Request $req){
        try{
            $sums = DB::table("tb_danger_sym")
                ->join("tb_sym", 'tb_danger_sym.symID', '=', 'tb_sym.symCode')
                ->select('tb_danger_sym.*', 'tb_sym.symName')
                ->where("tb_danger_sym.danger_id", "=", $req->id)
                ->get();
            return json_encode($sums);
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }
    // онц байдал зарлсан id-аар нь тухайн онц байдалд оруулсан бүх сумдын мэдээллийг json хэлбэрээр буцаана

    // Бүртгэгдсэн онц байдлуудыг Datatable format руу хөрвуулж буцааж байна
    public function getDangers(){
        try{
            $dangers = DB::table("tb_danger")
                ->orderBy("declareDate", "DESC")
                ->get();
            return DataTables::of($dangers)
              ->make(true);
        }catch(\Exception $e){
            return 'Серверийн алдаа!!! Веб мастерт хандана уу!!!';
        }
    }
    // Бүртгэгдсэн онц байдлуудыг Datatable format руу хөрвуулж буцааж байна

    // Sumaar onts baidal zarlah heseg
    public function declareDangerBySum(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }
        try{
            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna
            $danger = new Danger;
            $danger->commandNumber = $req->commandNumber;
            $danger->declareDate = $req->declareDate;
            $danger->minusedDate = $req->declareDate;
            $danger->comment = $req->comment;
            $danger->save();
            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna
            foreach($req->sums as $key => $value){
              $symRow = DB::table("tb_sym")->where('symCode', '=', $value['sumID'])->first();
              $provRow = DB::table("tb_province")->where('id', '=', $symRow->provID)->first();
              $dangerSym = new DangerSym;
              $dangerSym->danger_id = $danger->id;
              $dangerSym->sectorID = $provRow->sectorID;
              $dangerSym->provID = $symRow->provID;
              $dangerSym->symID = $value['sumID'];
              $dangerSym->save();
            }
            $array = array(
                'status' => 'success',
                'msg' => $req->commandNumber . ' тушаалтай онц байдал зарлалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }
    // Sumaar onts baidal zarlah heseg



    // Aimgaar onts baidal zarlah uyd hiih function
    public function declareDangerByProvs(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }

        try{
            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna
            $danger = new Danger;
            $danger->commandNumber = $req->commandNumber;
            $danger->declareDate = $req->declareDate;
            $danger->minusedDate = $req->declareDate;
            $danger->comment = $req->comment;
            $danger->save();
            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna

            foreach($req->provs as $key => $value){
                $sums = DB::table('tb_sym')->where('provID', '=', $value["provID"])->get();
                $provRow = DB::table("tb_province")->where('id', '=', $value["provID"])->first();
                foreach ($sums as $sum) {
                    $dangerSym = new DangerSym;
                    $dangerSym->danger_id = $danger->id;
                    $dangerSym->sectorID = $provRow->sectorID;
                    $dangerSym->provID = $value["provID"];
                    $dangerSym->symID = $sum->symCode;
                    $dangerSym->save();
                }
            }
            $array = array(
                'status' => 'success',
                'msg' => $req->commandNumber . ' тушаалтай онц байдал зарлалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }
    // Aimgaar onts baidal zarlah uyd hiih function



    // Buseer onts baidal zarlah uyd hiih function
    public function declareDangerBySector(Request $req){
        if (!(Hash::check($req->get('password1'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }

        try{

            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna
            $danger = new Danger;
            $danger->commandNumber = $req->commandNumber;
            $danger->declareDate = $req->declareDate;
            $danger->minusedDate = $req->declareDate;
            $danger->comment = $req->comment;
            $danger->save();
            // ehleed danger table ruu tushaal dugaar ognoo ederee hadgalaad hadgalsan id-g avaad danger_sym ruu hadgalna

            // odoo danger_sym ruu ugugdul hadgalj baina
            // ehleed sector davtaltand aimag avaad davtalt tegeed sums avaad sum davtaltand ugugdul hadgalna
            foreach($req->sectors as $sector){
                $provs = DB::table('tb_province')->where('sectorID', '=', $sector)->get();
                foreach ($provs as $prov) {
                    $sums = DB::table('tb_sym')->where('provID', '=', $prov->id)->get();
                    foreach ($sums as $sum) {
                        $dangerSym = new DangerSym;
                        $dangerSym->danger_id = $danger->id;
                        $dangerSym->sectorID = $sector;
                        $dangerSym->provID = $prov->id;
                        $dangerSym->symID = $sum->symCode;
                        $dangerSym->save();
                    }
                }
            }
            $array = array(
                'status' => 'success',
                'msg' => $req->commandNumber . ' тушаалтай онц байдал зарлалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Дахин оролдоно уу!!!'
            );
            return $array;
        }
    }


    // Зарласан онц байдлыг засах хэсэг
    public function editDanger(Request $req){
        try{

            $danger = Danger::find($req->id);
            $danger->commandNumber = $req->commandNumber;
            $danger->declareDate = $req->declareDate;
            $danger->minusedDate = $req->minusedDate;
            $danger->comment = $req->comment;
            $danger->save();

            // хуучин сумыг устгаад
            DangerSym::where('danger_id',$req->id)->delete();

            // шинээр засаж буй сумыг хадгална
            $province = new Province;
            foreach($req->sums as $key => $value){
                $symRow = DB::table("tb_sym")->where('symCode', '=', $value['sumID'])->first();
                $provRow = DB::table("tb_province")->where('id', '=', $symRow->provID)->first();

                $dangerSym = new DangerSym;
                $dangerSym->danger_id = $req->id;
                $dangerSym->sectorID = $provRow->sectorID;
                $dangerSym->provID = $symRow->provID;
                $dangerSym->symID = $value['sumID'];
                $dangerSym->save();
            }

            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }
    // Зарласан онц байдлыг засах хэсэг

}
