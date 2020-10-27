<?php

namespace App\Http\Controllers;

use App\FoodWareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;

class FoodWarehouseController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function showFoodWareHouse(){
      try {
        $provinces = DB::table("tb_province")->get();
        return view('Survey.FoodWareHouse.FoodWareHouse', compact("provinces"));
      } catch (\Exception $e) {

      }
  }

  public function getFoodWareHouse(Request $req)
  {
    try{
      $foodWareHouse = DB::table("srvy_food_warehouses")
      ->join("tb_province", "srvy_food_warehouses.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_food_warehouses.symID", "=", "tb_sym.id")
      ->select("srvy_food_warehouses.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($foodWareHouse)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function store(Request $req)
  {
    try{
      $foodWarehouse = new FoodWarehouse;
      $foodWarehouse->provID = $req->provID;
      $foodWarehouse->symID = $req->symID;
      $foodWarehouse->firmName = $req->firmName;
      $foodWarehouse->startDate = $req->startDate;
      $foodWarehouse->capacity = $req->capacity;
      $foodWarehouse->state = $req->state;
      $foodWarehouse->resName = $req->resName;
      $foodWarehouse->contact = $req->contact;
      $foodWarehouse->save();
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
      $foodWarehouse = FoodWarehouse::find($req->rowID);
      $foodWarehouse->provID = $req->provID;
      $foodWarehouse->symID = $req->symID;
      $foodWarehouse->firmName = $req->firmName;
      $foodWarehouse->startDate = $req->startDate;
      $foodWarehouse->capacity = $req->capacity;
      $foodWarehouse->state = $req->state;
      $foodWarehouse->resName = $req->resName;
      $foodWarehouse->contact = $req->contact;
      $foodWarehouse->save();
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
      $foodWarehouse = FoodWarehouse::find($req->rowID);
      $foodWarehouse->delete();
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
