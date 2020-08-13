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
          $sums = DB::table('tb_sym')
              ->where('isStart', '=', 1)->get();

          $normController = new NormController;
          $popController = new PopulationController;
          $foodReserve = new FoodReserve;


          $arr = [];
          foreach ($sums as $sum) {
              $popCount = $popController->getStandardPopBySumID($sum->id);
              $normKcal =$normController->sumOfNormKcalByID($sum->normID);
              $reserveKcal = $foodReserve->getReserveKcalBySum($sum->id);

              if($normKcal * $popCount == 0){
                  $days = -1;
              }
              else{
                  $days = $reserveKcal / ($normKcal * $popCount);
              }

              array_push($arr, array(
                  "id" => $sum->symCode,
                  "symName" => $sum->symName,
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
}
