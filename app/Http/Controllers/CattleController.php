<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Cattle;
use DB;

class CattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cattleShow()
    {
        try{
          $cattles = DB::table("tb_cattle")->get();
          return view("Cattle.Cattle", compact("cattles"));
        }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function getCattleData(Request $req)
    {
        try{
          $cattles = DB::table("tb_cattle")->get();
          return DataTables::of($cattles)
            ->make(true);
        }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу".$e;
        }
    }
    public function store(Request $req)
    {
        try{
          $insertCattle = new Cattle;
          $insertCattle->cattleName = $req->cattleName;
          $insertCattle->save();
          return "Амжилттай хадгаллаа";
        }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function update(Request $req)
    {
        try{
            $updateCattle = Cattle::find($req->rowID);
            $updateCattle->cattleName = $req->cattleName;
            $updateCattle->save();
            return "Амжилттай заслаа";
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function delete(Request $req)
    {
        try{
            $deleteCattle = Cattle::find($req->rowID);
            $deleteCattle->delete();
            return "Амжилттай устгалаа";
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function cattleToMeatKG($cattleID, $cattleCount){
        $cattle = DB::table('tb_cattle')
            ->where('id', '=', $cattleID)
            ->first();
        return $cattle->ratio * $cattleCount * 18;
    }
}
