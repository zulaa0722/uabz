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

    public function getCattleQnttData(Request $req)
    {
      try{
          $cattleQntts = DB::table("tb_cattle_qntt")
            ->join("tb_province", "tb_cattle_qntt.provID", "=", "tb_province.id")
            ->join("tb_sym", "tb_cattle_qntt.symID", "=", "tb_sym.id")
            ->join("tb_cattle", "tb_cattle_qntt.cattleID", "=", "tb_cattle.id")
            ->select("tb_cattle_qntt.*", "tb_province.provName", "tb_sym.symName", "tb_cattle.cattleName")->get();
          return DataTables::of($cattleQntts)
            ->make(true);
      }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }
    public function store(Request $req)
    {
      try{
          $insertCattleQntt = new CattleQntt;
          $insertCattleQntt->provID = $req->provID;
          $insertCattleQntt->symID = $req->symID;
          $insertCattleQntt->cattleID = $req->cattleID;
          $insertCattleQntt->cattQntt = $req->cattleQntt;
          $insertCattleQntt->save();
          return "Амжилттай хадгаллаа";
      }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }

    public function update(Request $req)
    {
        try{
            $updateCattleQntt = CattleQntt::find($req->rowID);
            $updateCattleQntt->provID = $req->provID;
            $updateCattleQntt->symID = $req->symID;
            $updateCattleQntt->cattleID = $req->cattleID;
            $updateCattleQntt->cattQntt = $req->cattleQntt;
            $updateCattleQntt->save();
            return "Амжилттай заслаа";
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function delete(Request $req)
    {
        try{
            $deleteCattleQntt = CattleQntt::find($req->rowID);
            $deleteCattleQntt->delete();
            return "Амжилттай устгалаа";
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
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
