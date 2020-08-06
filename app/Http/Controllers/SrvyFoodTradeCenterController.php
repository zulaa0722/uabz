<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodTradeCenter;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class SrvyFoodTradeCenterController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function foodTradeCenterShow()
  {
    try{
      $provinces = DB::table("tb_province")->get();
      return view("Survey.FoodTradeCenter.FoodTradeCenter", compact("provinces"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getFoodTradeCenterData(Request $req)
  {
    try{
      $foodTradeCenters = DB::table("srvy_food_trade_centers")
      ->join("tb_province", "srvy_food_trade_centers.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_food_trade_centers.symID", "=", "tb_sym.id")
      ->select("srvy_food_trade_centers.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($foodTradeCenters)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertFoodTradeCenter = new FoodTradeCenter;
      $insertFoodTradeCenter->provID = $req->provID;
      $insertFoodTradeCenter->symID = $req->symID;
      $insertFoodTradeCenter->firmName = $req->firmName;
      $insertFoodTradeCenter->startDate = $req->startDate;
      $insertFoodTradeCenter->capacity = $req->capacity;
      $insertFoodTradeCenter->state = $req->state;
      $insertFoodTradeCenter->resName = $req->resName;
      $insertFoodTradeCenter->contact = $req->contact;
      $insertFoodTradeCenter->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $insertDrinkingWater = FoodTradeCenter::find($req->rowID);
      $insertDrinkingWater->provID = $req->provID;
      $insertDrinkingWater->symID = $req->symID;
      $insertDrinkingWater->location = $req->location;
      $insertDrinkingWater->wellName = $req->wellName;
      $insertDrinkingWater->capacity = $req->capacity;
      $insertDrinkingWater->state = $req->state;
      $insertDrinkingWater->resName = $req->resName;
      $insertDrinkingWater->contact = $req->contact;
      $insertDrinkingWater->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteDrinkingWater = FoodTradeCenter::find($req->rowID);
      $deleteDrinkingWater->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
