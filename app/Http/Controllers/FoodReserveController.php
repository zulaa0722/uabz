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

class FoodReserveController extends Controller
{
    //
    public function foodReserveShow()
    {
      try{
        $syms = DB::table("tb_sym")
          ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
          ->select("tb_sym.*", "tb_province.provName")->get();
        $products = DB::table("tb_food_products")->get();
        $provinces = DB::table("tb_province")->get();
        return view("FoodReserve.FoodReserve", compact("syms", "products","provinces"));
        // return view("FoodReserve.FoodReserve");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }
}
