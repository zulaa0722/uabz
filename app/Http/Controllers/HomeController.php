<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $sectors = Sector::orderBy('sectorName', 'ASC')->get();

//       try {
//         // $province = DB::table("tb_province")->where("provCode", "=", $req->provCode)->first();
//         //
//         // //tuhain aimgiin normiin id-iig avch bn
//         // $norm = DB::table("tb_normname")->where("id", "=", $province->normID)->first();
//         // $normKcal = $norm->sumKcal;
//
//         //tuhain amgiin niit hun amiin too
//         $totalPop = DB::table("tb_population")->sum("totalPop");
//
//         //tuhain amgiin jishsen hun amiin too
//         $standardPop = DB::table("tb_population")->sum("standardPop");
//
//         //normiin kcal-iig tuhain aimgiin jishsen huneer urjuulj niit kcal-iig bodoj bn
//         if($standardPop != 0)
//           $aimagTotalKcal = $normKcal * $standardPop;
//         else
//           $aimagTotalKcal = 0;
//
//         //hunsnii nootsoos niit kcal-iig avch bn
//         $reserveTotalKcal = DB::table("tb_food_reserve")
//           ->where("provID", "=", $province->id)->sum("totalKcal");
//
//
//         //aimgiin niit maliin too
//         $totalCattle = DB::table("tb_cattle_qntt")
//           ->where("provID", "=", $province->id)->sum("cattQntt");
//
//         $totalSheepKg = DB::table("tb_cattle_qntt")
//           ->where("provID", "=", $province->id)->sum("sheepKg");
//
//         //maliin honin tolgoid shiljuulsen kg-iin niit kcal iig bodoh heseg
//         $meat = DB::table("tb_food_products")
//           ->where("productCode", "=", "01")->first();
//         $meatQntt = $meat->foodQntt;
//         $meatKcal = $meat->foodCkal;
//         //niit maliin kcal
//         $totalCattleKcal = $totalSheepKg*$meatKcal/$meatQntt;
//
//         //heden honog uldseniig kcal-oor huvaaj hariulj bn
//         $reserveDay = ($reserveTotalKcal + $totalCattleKcal) / $aimagTotalKcal;
//
//         $rightSide = array(
//           "totalPop" => $totalPop,
//           "standardPop" => $standardPop,
//           "totalCattle" => $totalCattle,
//           "reserveDay" => intval($reserveDay)
//         );
//
// #End of RIGHTSIDE
//         // $bottomSide = [];
//         //
//         // $products = DB::table("tb_food_products")->get();
//         // $provNormProducts = DB::table("tb_norms")->where('normID', '=', $province->normID)->get();
//         //
//         // $bottomSide = [];
//         //
//         // foreach ($products as $product) {
//         //   $productTotalQntt = DB::table("tb_food_reserve")
//         //     ->where("provID", "=", $province->id)
//         //     ->where("productID","=",$product->id)->sum("mainQntt");
//         //
//         //   foreach ($provNormProducts as $normProduct) {
//         //     if($product->id == $normProduct->producID){
//         //       $val = $normProduct->normQntt * $standardPop;
//         //       array_push($bottomSide, array(
//         //           "product" => $product->productName,
//         //           "leftDays" => intval($productTotalQntt / $val)
//         //         )
//         //       );
//         //     }
//         //   }
//         // }
//         // $bothSides = array(
//         //   "rightSide" => $rightSide,
//         //   "bottomSide" => $bottomSide
//         // );
//         // return $bothSides;
//
//       } catch (\Exception $e) {
//         return "Серверийн алдаа!!! Веб мастерт хандана уу";
//         // return $e;
//       }
//



      return view("mongolianMap.mongolianMap", compact('sectors'));

    }
}
