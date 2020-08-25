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
use App\SubProducts;
use DB;

class SubProductsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function subProductsShow()
  {
    try{
      $getFoodProducts = DB::table("tb_food_products")->get();
      return view("SubProducts.SubProducts", compact("getFoodProducts"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getSubProductsData(Request $req)
  {
    try{
      $subProducts = DB::table("tb_sub_products")
      ->join("tb_food_products", "tb_sub_products.fProductID", "=", "tb_food_products.id")
      ->select("tb_sub_products.*", "tb_food_products.productName")->get();
      return DataTables::of($subProducts)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertSubProducts = new SubProducts;
      $insertSubProducts->fProductID = $req->fProductID;
      $insertSubProducts->subName = $req->subName;
      $insertSubProducts->multiplier = $req->multiplier;
      $insertSubProducts->price = $req->price;
      $insertSubProducts->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return $e;
    }
  }

  public function update(Request $req)
  {
    try{
      $updateSubProducts = SubProducts::find($req->rowID);
      $updateSubProducts->fProductID = $req->fProductID;
      $updateSubProducts->subName = $req->subName;
      $updateSubProducts->multiplier = $req->multiplier;
      $updateSubProducts->price = $req->price;
      $updateSubProducts->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteSubProducts = SubProducts::find($req->rowID);
      $deleteSubProducts->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
