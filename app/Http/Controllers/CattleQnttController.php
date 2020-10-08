<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Cattle;
use App\CattleQntt;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class CattleQnttController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cattleQnttShow()
    {
        try{
            if(Auth::user()->permission == 2){
              $syms = DB::table("tb_sym")
                ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
                ->select("tb_sym.*", "tb_province.provName")
                ->where('tb_province.provCode', '=', Auth::user()->aimagCode)
                ->get();
            }
            else{
              $syms = DB::table("tb_sym")
                ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
                ->select("tb_sym.*", "tb_province.provName")->get();
            }
            // $provinces = DB::table("tb_province")->get();
            $now = Carbon::now();
            $year = $now->year;
            $year = $year - 1;
            $cattles = DB::table("tb_cattle")->get();

            return view("CattleQntt.CattleQntt", compact("syms", "cattles", "year"));
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }
    public function store(Request $req)
    {

      try{
        CattleQntt::where('symID',$req->symID)
            ->where('year', $req->year)
            ->delete();
        foreach ($req->qntt as $key => $value) {
            $insertCattleQntt = new CattleQntt;
            $insertCattleQntt->provID = $req->provID;
            $insertCattleQntt->symID = $req->symID;
            $insertCattleQntt->cattleID = $value['cattleID'];
            $insertCattleQntt->cattQntt = $value['cattleQntt'];
            $insertCattleQntt->toSheep = $value['toSheepQntt'];
            $insertCattleQntt->sheepKg = $value['toSheepKg'];
            $insertCattleQntt->year = $req->year;
            $insertCattleQntt->save();
        }

        $arrayMsg = array(
            'status' => 'success',
            'msg' => 'Амжилттай хадгаллаа!!!'
        );
        return $arrayMsg;
      }catch(\Exception $e){
        $arrayMsg = array(
            'status' => 'error',
            'msg' => $e
        );
        return $arrayMsg;
      }

    }


    public function delete(Request $req)
    {
      try{
        CattleQntt::where('symID',$req->symID)
            ->where('year', '=', $req->year)->delete();
        $arrayMsg = array(
            'status' => 'success',
            'msg' => 'Амжилттай устгалаа...'
        );
        return $arrayMsg;
      }catch(\Exception $e){
        $arrayMsg = array(
            'status' => 'error',
            'msg' => "Серверийн алдаа!!! Веб мастерт хандана уу"
        );
        return $arrayMsg;
      }
    }

    public static function getCattleCountBySymID($sumID, $cattleID, $year){
        // $now = Carbon::now();
        // $year = $now->year;
        // $year = $year - 1;
        $cattleCount = DB::table('tb_cattle_qntt')
            ->where('symID', '=', $sumID)
            ->where('cattleID', '=', $cattleID)
            ->where('year', '=', $year)
            ->first();
        if ($cattleCount == null) {
            return "";
        }
        return $cattleCount->cattQntt;
    }
    public static function getTotalCattleBySym($symID)
    {
        $cattleCount = DB::table('tb_cattle_qntt')
          ->where('symID', '=', $symID)->sum('sheepKg');
        return $cattleCount;
    }

    public function getCattleQuantity(Request $req){
        try {
            $syms = DB::table("tb_sym")
                ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
                ->select("tb_sym.*", "tb_province.provName")->get();
            $arrCattleQtt = [];
            $rowCount = 1;
            foreach ($syms as $sym) {
                $sheep = $this::getCattleCountBySymID($sym->id, 1, $req->year);
                $goat = $this::getCattleCountBySymID($sym->id, 2, $req->year);
                $cattle = $this::getCattleCountBySymID($sym->id, 3, $req->year);
                $horse = $this::getCattleCountBySymID($sym->id, 4, $req->year);
                $camel = $this::getCattleCountBySymID($sym->id, 5, $req->year);
                array_push($arrCattleQtt, array(
                    "number" => $rowCount,
                    "provID" => $sym->provID,
                    "sumID" => $sym->id,
                    "provName" => $sym->provName,
                    "sumName" => $sym->symName,
                    "sheep" => $sheep,
                    "goat" => $goat,
                    "cattle" => $cattle,
                    "horse" => $horse,
                    "camel" => $camel
                ));
                $rowCount++;
            }
            return DataTables::of($arrCattleQtt)
              ->make(true);
        } catch (\Exception $e) {

        }
    }
}
