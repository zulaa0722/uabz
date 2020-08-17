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

class DangerController extends Controller
{
    public function declareDangerBySum(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }
        try{
            foreach($req->sums as $sum){
                $sum = Sym::find($sum);
                $sum->isStart = 1;
                $sum->save();
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

    public function declareDangerByProvs(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }

        try{
            foreach($req->provs as $prov){
                $sum = Sym::where('provID', $prov)
                    ->update([
                        'isStart' => 1
                    ]);
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
                        $dangerSym->symID = $sum->id;
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


}
