<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\LogFoodReserve;
use App\FoodProducts;

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

      // $remaining = DB::table("tb_food_reserve")
      //   ->where('symID', '=', $sym->id)->get();

      $nowProducts = DB::table("log_food_reserve")
        ->where('symCode', '=', $req->symID)
        ->where('dangerID', '=', $req->dangerID)
        ->groupBy('date')->get();

      // return $nowProducts;

      $remainingArray = [];
      $rowCount = 1;
      foreach ($nowProducts as $nowProd) {
          $datarow = [];
          $datarow['number'] = $rowCount;
          foreach ($products as $product) {
            $proRow = $this->getRemainingFoodByDangerIdSumCodeDateProductID($req->dangerID, $req->symID, $nowProd->date, $product->id);
            if($proRow == null){
              $datarow += ["$product->id" => ""];
            }
            else{
              $datarow += ["$product->id" => $proRow->qnttRemain];
            }
            // getRemainingFoodByDangerIdSumCodeDateProductID($dangerID, $sumID, $date, $productID)
            // if($nowProd->productID == $product->id)
            //   $datarow += ["$product->id" => $nowProd->qnttRemain];
            // else
            //   $datarow += ["$product->id" => ""];
          }
          $datarow += ['date'=>$nowProd->date];

          array_push($remainingArray, $datarow);
          $rowCount++;
      }
      return DataTables::of($remainingArray)
        ->make(true);

      return $remainingArray;

    } catch (\Exception $e) {
      return $e;
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













}
