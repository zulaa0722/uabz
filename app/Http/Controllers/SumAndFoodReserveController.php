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
              $popCount = $popController->getStandardPopBySumID($sumRow->id);
              $normKcal =$normController->sumOfNormKcalByID($sumRow->normID);
              $reserveKcal = $foodReserve->getReserveKcalBySum($sumRow->id);

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
                    // return $dangerSyms;
                    foreach ($dangerSyms as $dangerSym) {
                        $norms = Norm::where('normID', '=', $dangerSym->normID)->get();
                        foreach ($norms as $norm) {
                            $foodReserveRow = DB::table("tb_food_reserve")
                                ->where('tb_food_reserve.symID', '=', $dangerSym->id)
                                ->where('tb_food_reserve.productID', '=', $norm->producID)
                                ->first();
                            // хоногоор нь хүнсийн нөөцийг нормоор нь бодож олж байна
                            $minusedProductQtt = $foodReserveRow->mainQntt - $norm->normQntt * $dangerSym->standardPop * $day;
                            $minusedProductKcal = $foodReserveRow->totalKcal - $norm->normCkal * $dangerSym->standardPop * $day;
                            if($minusedProductQtt < 0){ //хэрвээ хүнс дууссан бол шууд 0 болгоно
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
