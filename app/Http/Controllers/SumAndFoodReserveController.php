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
use App\Danger;
use Carbon\Carbon;
use App\DangerSym;
use App\Norm;
use App\Population;
use App\FoodProducts;
use App\sendmail;

class SumAndFoodReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSumsReserveDays(){
      // return view('layouts.mailto');
        try{
          $now = Carbon::now();
          $yearNow = $now->year - 1;
          $sums = DB::table('tb_danger_sym')
              ->join('tb_danger', 'tb_danger_sym.danger_id', '=', 'tb_danger.id')
              ->join('tb_sym', 'tb_danger_sym.symID', '=', 'tb_sym.symCode')
              ->where('tb_danger.status', '=', 1)
              ->select('tb_danger_sym.*', 'tb_danger.status', 'tb_sym.id as symiinID', 'tb_sym.normID', 'tb_sym.symName')
              ->get();

          $foodProducts = FoodProducts::all();

          $arr = [];
          foreach ($sums as $sum) {

              $foodDays = DB::table('tb_food_products')
                  ->select(
                      'tb_food_products.id as productID',
                      'tb_food_products.productName',
                      DB::raw("(SELECT tb_population.standardPop FROM tb_population WHERE tb_population.date = $yearNow AND tb_population.symID = $sum->symiinID LIMIT 0,1) as standartPop"),
                      DB::raw("(SELECT tb_norms.normCkal FROM tb_norms WHERE tb_norms.producID = tb_food_products.id LIMIT 0,1) as normKcal"),
                      DB::raw("(SELECT tb_food_reserve.totalKcal FROM tb_food_reserve WHERE tb_food_reserve.productID = tb_food_products.id AND tb_food_reserve.symID = $sum->symiinID LIMIT 0,1) as reserve")
                  )
                  ->get();

              $minDays = 1000000;
              foreach ($foodDays as $foodDay) {
                  if($foodDay->normKcal * $foodDay->standartPop == 0){
                      $days = 0;
                  }
                  else{
                      $days = $foodDay->reserve / ($foodDay->normKcal * $foodDay->standartPop);
                  }
                  if($days < $minDays){
                      $minDays = $days;
                  }
              }


              array_push($arr, array(
                  "id" => $sum->symID,
                  "days" => $minDays
              ));
          }
          return json_encode($arr);
        }
        catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }

    public function minusNormFromReserve(){
        // DB::raw('lock tables tb_food_reserve write');
        try{
            DB::beginTransaction();
            $dangers = Danger::all();
            foreach ($dangers as $danger) {
                if(Carbon::now()->toDateString() > $danger->minusedDate){
                    // хэд хоног хасах эсэхийг бодож байна
                    $diff = abs(strtotime(Carbon::now()->toDateString()) - strtotime($danger->minusedDate));
                    $day = (int)$diff / 86400;
                    // $dangerSyms бол онц байдал зарласан сумдууд
                    $dangerSyms = DB::table('tb_danger_sym')
                        ->join('tb_sym', 'tb_danger_sym.symID', '=', 'tb_sym.symCode')
                        ->join('tb_population', 'tb_sym.id', '=', 'tb_population.symID')
                        ->where('tb_danger_sym.danger_id', '=', $danger->id)
                        ->select('tb_sym.*', 'tb_danger_sym.danger_id', 'tb_population.standardPop')->get();
                    foreach ($dangerSyms as $dangerSym) {
                        $norms = Norm::where('normID', '=', $dangerSym->normID)->get();
                        foreach ($norms as $norm) {
                            $foodReserveRow = DB::table("tb_food_reserve")
                                ->where('tb_food_reserve.symID', '=', $dangerSym->id)
                                ->where('tb_food_reserve.productID', '=', $norm->producID)
                                ->first();
                            // return $dangerSym->id;
                            if($foodReserveRow == null){
                              $insertFoodReserve = new FoodReserve;
                              $insertFoodReserve->provID = $dangerSym->provID;
                              $sumRow = DB::table('tb_sym')
                                  ->where('symCode', '=', $dangerSym->symCode)->first();
                                  // return $sumRow->id;
                              $insertFoodReserve->symID = $sumRow->id;
                              $insertFoodReserve->fReseverDate = Carbon::now();
                              $insertFoodReserve->productID = $norm->producID;
                              $insertFoodReserve->mainQntt = "0";
                              $insertFoodReserve->totalKcal = "0";
                              $insertFoodReserve->measurement = "тн";
                              $insertFoodReserve->save();

                              $foodReserveRow = DB::table("tb_food_reserve")
                                  ->where('tb_food_reserve.symID', '=', $dangerSym->id)
                                  ->where('tb_food_reserve.productID', '=', $norm->producID)
                                  ->first();
                                  // return count($foodReserveRow);
                            }

                            // return count($foodReserveRow);
                            // хоногоор нь хүнсийн нөөцийг нормоор нь бодож олж байна
                            $minusedProductQtt = $foodReserveRow->mainQntt - $norm->normQntt * $dangerSym->standardPop * $day;
                            $minusedProductKcal = $foodReserveRow->totalKcal - $norm->normCkal * $dangerSym->standardPop * $day;
                            //хэрвээ хүнс дууссан бол шууд 0 болгоно
                            if($minusedProductQtt < 0){
                                $minusedProductQtt = 0;
                                $minusedProductKcal = 0;
                            }
                            $foodReserve = FoodReserve::find($foodReserveRow->id);
                            $foodReserve->mainQntt = $minusedProductQtt;
                            $foodReserve->totalKcal = $minusedProductKcal;
                            $foodReserve->save();
                        }
                    }
                }
                $danger = Danger::find($danger->id);
                $danger->minusedDate = Carbon::now();
                $danger->save();
                // sleep(5);
                DB::commit();
            }
            // DB::raw('unlock tables');
            // return "haslaa";
        }catch(Exception $e){
            DB::rollback();
        }
    }

}
