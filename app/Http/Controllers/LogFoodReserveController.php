<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\LogFoodReserve;
use App\FoodProducts;
use App\FoodReserve;

class LogFoodReserveController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function showHome()
  {
    $provs = DB::table('tb_danger_sym')
        ->join('tb_danger', 'tb_danger_sym.danger_id', '=', 'tb_danger.id')
        ->join('tb_province', 'tb_danger_sym.provID', '=', 'tb_province.id')
        ->groupBy('tb_danger_sym.provID', 'tb_province.provName')
        ->select('tb_danger_sym.provID', 'tb_province.provName', 'tb_danger.id')
        ->where('tb_danger.status', '=', 1)
        ->get();

    $products = FoodProducts::all();

    return view("LogFoodReserve/LogFoodReserve", compact('provs', 'products'));
  }

  public function getProductRemaingBySym(Request $req)
  {
    try {
      $sym = DB::table("tb_sym")
        ->where('symCode', '=', $req->symID)->first();

      $products = FoodProducts::all();

      $nowProducts = DB::table("log_food_reserve")
        ->where('symCode', '=', $req->symID)
        ->where('dangerID', '=', $req->dangerID)
        ->groupBy('date')->get();

      $remainingArray = [];
      $rowCount = 1;
      foreach ($nowProducts as $nowProd) {
          $datarow = [];
          $datarow['number'] = $rowCount;
          $datarow += ['date'=>$nowProd->date];
          foreach ($products as $product) {
            $proRow = $this->getRemainingFoodByDangerIdSumCodeDateProductID($req->dangerID, $req->symID, $nowProd->date, $product->id);
            if($proRow == null){
              $datarow += ["$product->id" => ""];
            }
            else{
              $datarow += ["$product->id" => $proRow->qnttUsed];
            }
          }

          array_push($remainingArray, $datarow);
          $rowCount++;
      }
      return DataTables::of($remainingArray)
        ->make(true);

      return $remainingArray;

    } catch (\Exception $e) {
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
      // return $e;
    }
  }


  public function getRemainingFoodByDangerIdSumCodeDateProductID($dangerID, $sumID, $date, $productID){
      $productRowLog = DB::table('log_food_reserve')
          ->where('dangerID', '=', $dangerID)
          ->where('productID', '=', $productID)
          ->where('date', '=', $date)
          ->where('symCode', '=', $sumID)
          ->first();
      return $productRowLog;
  }

  public function showRemainingProducts(Request $req)
  {
    try {
      $sym = DB::table("tb_sym")
        ->where('symCode', '=', $req->symCode)->first();

      $reserve = DB::table("tb_food_reserve")
        ->join("tb_food_products", "tb_food_reserve.productID", "=", "tb_food_products.id")
        ->select("tb_food_reserve.*", "tb_food_products.*")
        ->where("tb_food_reserve.symID", "=", $sym->id)->get();

      return $reserve;
    } catch (\Exception $e) {
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
      // return $e;
    }

  }

  public function insertFoodSpent(Request $req)
  {

    $sym = DB::table("tb_sym")
      ->where('symCode', '=', $req->symCode)->first();

    try {

      foreach ($req->insertData as $key => $value) {
          $insertSpent = new LogFoodReserve;
          $insertSpent->dangerID = $req->dangerID;
          $insertSpent->provCode = $req->provCode;
          $insertSpent->symCode = $req->symCode;
          $insertSpent->productID = $value['prodID'];
          $insertSpent->qnttRemain = $value['remainingQntt'];
          $insertSpent->qnttUsed = $value['usedQntt'];
          $insertSpent->measurement = "кг";
          $insertSpent->totalKcalRemain = $value['remainingTotalKcal'];
          $insertSpent->totalKcalUsed = $value['usedKcal'];
          $insertSpent->date = $req->date;
          $insertSpent->save();

          $newReserve = (float)$value['remainingQntt'] - (float)$value['usedQntt'];
          $newTotalKcal = (float)$value['remainingTotalKcal'] - (float)$value['usedKcal'];

          // return $newTotalKcal.'  '.$value['remainingTotalKcal'].'  '.$value['usedKcal'];
          DB::table("tb_food_reserve")
            ->where("symID", '=', $sym->id)
            ->where("productID", "=", $value['prodID'])->update(['mainQntt' => $newReserve, 'totalKcal' => $newTotalKcal]);

      }



      return "Амжилттай хадгаллаа.";


    } catch (\Exception $e) {
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
      // return $e;
    }

  }










}
