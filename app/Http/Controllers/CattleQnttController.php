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
            $provinces = DB::table("tb_province")->get();
            $syms = DB::table("tb_sym")
              ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
              ->select("tb_sym.*", "tb_province.provName")->get();
            $cattles = DB::table("tb_cattle")->get();

            return view("CattleQntt.CattleQntt", compact("provinces", "syms", "cattles"));
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }
    public function store(Request $req)
    {

      try{
        CattleQntt::where('symID',$req->symID)->delete();
        foreach ($req->qntt as $key => $value) {
            $insertCattleQntt = new CattleQntt;
            $insertCattleQntt->provID = $req->provID;
            $insertCattleQntt->symID = $req->symID;
            $insertCattleQntt->cattleID = $value['cattleID'];
            $insertCattleQntt->cattQntt = $value['cattleQntt'];
            $insertCattleQntt->toSheep = $value['toSheepQntt'];
            $insertCattleQntt->sheepKg = $value['toSheepKg'];

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
        CattleQntt::where('symID',$req->symID)->delete();
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

    public static function getCattleCountBySymID($sumID, $cattleID){
        $cattleCount = DB::table('tb_cattle_qntt')
            ->where('symID', '=', $sumID)
            ->where('cattleID', '=', $cattleID)
            ->get();
        return $cattleCount;
    }
}
