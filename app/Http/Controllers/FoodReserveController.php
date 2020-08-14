<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;
use App\FoodReserve;
use App\FoodProducts;

class FoodReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function foodReserveShow()
    {
      try{
        $syms = DB::table("tb_sym")
          ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
          ->select("tb_sym.*", "tb_province.provName")->get();
        $products = DB::table("tb_food_products")
          ->orderBy("productName")->get();
        $provinces = DB::table("tb_province")->get();
        return view("FoodReserve.FoodReserve", compact("syms", "products","provinces"));
        // return view("FoodReserve.FoodReserve");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }

    public function store(Request $req)
    {
      try{
        FoodReserve::where('symID',$req->symID)->delete();
        foreach ($req->qntt as $key => $value) {
            $insertFoodReserve = new FoodReserve;
            $insertFoodReserve->provID = $req->provID;
            $insertFoodReserve->symID = $req->symID;
            $insertFoodReserve->fReseverDate = $req->reserveDate;
            $insertFoodReserve->productID = $value['productID'];
            $insertFoodReserve->mainQntt = $value['foodQntt'];
            $insertFoodReserve->totalKcal = $value['totalKcal'];
            $insertFoodReserve->measurement = "тн";
            $insertFoodReserve->save();
        }

        $arrayMsg = array(
            'status' => 'success',
            'msg' => 'Амжилттай хадгаллаа!!!'
        );
        return $arrayMsg;
      }catch(\Exception $e){
        $arrayMsg = array(
            'status' => 'error',
            'msg' => "Серверийн алдаа!!! Веб мастерт хандана уу"
            // 'msg' => $e

        );
        return $arrayMsg;
      }
    }
    public function delete(Request $req)
    {
      try{
        FoodReserve::where('symID',$req->symID)->delete();
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
    public static function selectReserveFootQnttByProvSym($provID, $symID, $productID)
    {
        try{
            $qntt = DB::table("tb_food_reserve")
                ->where('provID', '=', $provID)
                ->where('symID', '=', $symID)
                ->where('productID', '=', $productID)->get();

            return $qntt;
          }
        catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }
}
