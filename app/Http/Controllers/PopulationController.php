<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Population;
use App\Sym;
use App\CattleQntt;
use DB;

class PopulationController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function popShow()
  {
    try{
      $provinces = DB::table("tb_province")->get();
      return view("Population.Population", compact("provinces"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getPopData(Request $req)
  {
    try{
      $populations = DB::table("tb_population")
        ->join("tb_province", "tb_population.provID", "=", "tb_province.id")
        ->join("tb_sym", "tb_population.symID", "=", "tb_sym.id")
        ->select("tb_population.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($populations)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertPopulation = new Population;
      $insertPopulation->provID = $req->provID;
      $insertPopulation->symID = $req->symID;
      $insertPopulation->totalPop = $req->totalPop;
      $insertPopulation->standardPop = $req->standardPop;
      $insertPopulation->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return $e;
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updatePopulation = Population::find($req->rowID);
      $updatePopulation->provID = $req->provID;
      $updatePopulation->symID = $req->symID;
      $updatePopulation->totalPop = $req->totalPop;
      $updatePopulation->standardPop = $req->standardPop;
      $updatePopulation->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deletePopulation = Population::find($req->rowID);
      $deletePopulation->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

    public function getStandardPopByProvID($provID){
        $sumOfStandartPopByProvID = Population::where('provID', $provID)->sum('standardPop');
        return $sumOfStandartPopByProvID;
    }
}
