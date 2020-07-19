<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Axax;
use App\Sector;
use App\Province;
use App\Sym;
use App\FoodProducts;
use DB;

class FoodProductsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  public function foodProductsShow()
  {
    try{
      return view("FoodProducts.FoodProducts");
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getFoodProductsData(Request $req)
  {
    try{
      $foodProducts = DB::table("tb_food_products")->get();
      return DataTables::of($foodProducts)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertFoodProducts = new FoodProducts;
      $insertFoodProducts->productName = $req->productName;
      $insertFoodProducts->foodQntt = $req->foodQntt;
      $insertFoodProducts->foodProtein = $req->foodProtein;
      $insertFoodProducts->foodFat = $req->foodFat;
      $insertFoodProducts->foodCarbon = $req->foodCarbon;
      $insertFoodProducts->foodCkal = $req->foodCkal;
      $insertFoodProducts->foodTomCkal = $req->foodTomCkal;
      $insertFoodProducts->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateFoodProducts = FoodProducts::find($req->rowID);
      $updateFoodProducts->productName = $req->productName;
      $updateFoodProducts->foodQntt = $req->foodQntt;
      $updateFoodProducts->foodProtein = $req->foodProtein;
      $updateFoodProducts->foodFat = $req->foodFat;
      $updateFoodProducts->foodCarbon = $req->foodCarbon;
      $updateFoodProducts->foodCkal = $req->foodCkal;
      $updateFoodProducts->foodTomCkal = $req->foodTomCkal;

      $updateFoodProducts->save();
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
