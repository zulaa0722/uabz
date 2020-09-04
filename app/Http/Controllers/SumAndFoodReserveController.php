<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\NormController;
use App\Http\Controllers\PopulationController;
use App\FoodReserve;

class SumAndFoodReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSumsReserveDays(){
        try{
          $sums = DB::table('tb_danger_sym')->get();

          $normController = new NormController;
          $popController = new PopulationController;
          $foodReserve = new FoodReserve;


          $arr = [];
          foreach ($sums as $sum) {
              $sumRow = DB::table('tb_sym')
                  ->where('symCode', '=', $sum->symID)->first();
              $popCount = $popController->getStandardPopBySumID($sum->symID);
              $normKcal =$normController->sumOfNormKcalByID($sumRow->normID);
              $reserveKcal = $foodReserve->getReserveKcalBySum($sum->symID);

              if($normKcal * $popCount == 0){
                  $days = -1;
              }
              else{
                  $days = $reserveKcal / ($normKcal * $popCount);
              }

              array_push($arr, array(
                  "id" => $sumRow->symCode,
                  "symName" => $sumRow->symName,
                  "popCount" => $popCount,
                  "normKcal" => $normKcal,
                  "reserveKcal" => $reserveKcal,
                  "days" => $days
              ));
          }
          return json_encode($arr);
        }
        catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function minusNormFromReserve(Request $req){

    }
}
