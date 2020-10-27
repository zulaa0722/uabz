<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;
use App\FoodFactory;

class SrvyFoodFactoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function showFoodFactory(){
      try {
        $provinces = DB::table("tb_province")->get();
        return view('Survey.FoodFactory.FoodFactory', compact("provinces"));
      } catch (\Exception $e) {

      }
  }

  public function getFoodFactory(Request $req)
  {
    try{
      $foodFactory = DB::table("srvy_food_factories")
      ->join("tb_province", "srvy_food_factories.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_food_factories.symID", "=", "tb_sym.id")
      ->select("srvy_food_factories.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($foodFactory)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function store(Request $req)
  {
    try{
      $foodFactory = new FoodFactory;
      $foodFactory->provID = $req->provID;
      $foodFactory->symID = $req->symID;
      $foodFactory->name = $req->name;
      $foodFactory->activity = $req->activity;
      $foodFactory->factoryCapacity = $req->capacity;
      $foodFactory->resName = $req->resName;
      $foodFactory->contact = $req->contact;
      $foodFactory->save();
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

  public function update(Request $req)
  {
    try{
      $foodFactory = FoodFactory::find($req->rowID);
      $foodFactory->provID = $req->provID;
      $foodFactory->symID = $req->symID;
      $foodFactory->name = $req->name;
      $foodFactory->activity = $req->activity;
      $foodFactory->factoryCapacity = $req->capacity;
      $foodFactory->resName = $req->resName;
      $foodFactory->contact = $req->contact;
      $foodFactory->save();
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

  public function delete(Request $req)
  {
    try{
      $foodFactory = FoodFactory::find($req->rowID);
      $foodFactory->delete();
      $array = array(
          'status' => 'success',
          'msg' => 'Амжилттай устгалаа!!!'
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
}
