<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Population;
use DB;

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTable()
    {
      
    }

    public function showReportsTitle(){
      $products = DB::table("tb_food_products")->get();

      $pop = DB::table('tb_population')
      ->select([
          'tb_population.date',
          DB::raw("SUM(totalPop) as totalPop"),
          DB::raw("SUM(standardPop) as standardPop"),
        ])
      ->groupBy('date')->get();

      return view("Reports.ReportsView", compact('products','pop', count($pop)));
    }

    public function showPopulation(Request $req){
      try {
        $pop = DB::table('tb_population')
        ->select([
            'tb_population.date',
            DB::raw("SUM(totalPop) as totalPop"),
            DB::raw("SUM(standardPop) as standardPop"),
          ])
        ->groupBy('date')->get();
        return $pop;

      } catch (\Exception $e) {
        return $e;
      }



    }
}
