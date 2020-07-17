<?php

namespace App\Http\Controllers;

use App\DrinkingWaterSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class DrinkingWaterSourceController extends Controller
{
  public function drinkingWaterShow()
  {
    try{
      $provinces = DB::table("tb_province")->get();
      return view("Survey.DrinkingWaterSource.DrinkingWaterSource", compact("provinces"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getDrinkingWaterData(Request $req)
  {
    try{
      $drinkingWaters = DB::table("srvy_drinking_water_sources")
      ->join("tb_province", "srvy_drinking_water_sources.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_drinking_water_sources.symID", "=", "tb_sym.id")
      ->select("srvy_drinking_water_sources.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($drinkingWaters)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertDrinkingWater = new DrinkingWaterSource;
      $insertDrinkingWater->provID = $req->provID;
      $insertDrinkingWater->symID = $req->symID;
      $insertDrinkingWater->location = $req->location;
      $insertDrinkingWater->wellName = $req->wellName;
      $insertDrinkingWater->capacity = $req->capacity;
      $insertDrinkingWater->state = $req->state;
      $insertDrinkingWater->resName = $req->resName;
      $insertDrinkingWater->contact = $req->contact;
      $insertDrinkingWater->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      // $updateFoodProducts = FoodProducts::find($req->rowID);
      // $updateFoodProducts->productName = $req->productName;
      // $updateFoodProducts->foodQntt = $req->foodQntt;
      // $updateFoodProducts->foodProtein = $req->foodProtein;
      // $updateFoodProducts->foodFat = $req->foodFat;
      // $updateFoodProducts->foodCarbon = $req->foodCarbon;
      // $updateFoodProducts->foodCkal = $req->foodCkal;
      // $updateFoodProducts->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteFoodProducts = FoodProducts::find($req->rowID);
      $deleteFoodProducts->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
