<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Population;
use App\Sym;
use App\CattleQntt;
use App\NormName;
use App\FoodReserve;
use App\FoodProducts;
use App\Norm;
use DB;

class Sides extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAimagInfo(Request $req)
    {
      try {
        $province = DB::table("tb_province")->where("provCode", "=", $req->provCode)->first();

        //tuhain aimgiin normiin id-iig avch bn
        $norm = DB::table("tb_normname")->where("id", "=", $province->normID)->first();
        $normKcal = $norm->sumKcal;

        //tuhain amgiin niit hun amiin too
        $totalPop = DB::table("tb_population")
        ->where("provID", "=", $province->id)->sum("totalPop");

        //tuhain amgiin jishsen hun amiin too
        $standardPop = DB::table("tb_population")
          ->where("provID", "=", $province->id)->sum("standardPop");

        //normiin kcal-iig tuhain aimgiin jishsen huneer urjuulj niit kcal-iig bodoj bn
        if($standardPop != 0)
          $aimagTotalKcal = $normKcal * $standardPop;
        else
          $aimagTotalKcal = 0;

        //hunsnii nootsoos niit kcal-iig avch bn
        $reserveTotalKcal = DB::table("tb_food_reserve")
          ->where("provID", "=", $province->id)->sum("totalKcal");


        //aimgiin niit maliin too
        $totalCattle = DB::table("tb_cattle_qntt")
          ->where("provID", "=", $province->id)->sum("cattQntt");

        //aimgiin niit maliin toog honin tolgoid shiljuulsen kg-iig ni avch bn
        $totalSheepKg = DB::table("tb_cattle_qntt")
          ->where("provID", "=", $province->id)->sum("sheepKg");

        //maliin honin tolgoid shiljuulsen kg-iin niit kcal iig bodoh heseg
        $meat = DB::table("tb_food_products")
          ->where("productCode", "=", "01")->first();
        $meatQntt = $meat->foodQntt;
        $meatKcal = $meat->foodCkal;

        //niit maliin kcal
        $totalCattleKcal = $totalSheepKg*$meatKcal/$meatQntt;

        //heden honog uldseniig kcal-oor huvaaj hariulj bn
        $reserveDay = ($reserveTotalKcal + $totalCattleKcal) / $aimagTotalKcal;

        $rightSide = array(
          "totalPop" => $totalPop,
          "standardPop" => $standardPop,
          "totalCattle" => $totalCattle,
          "reserveDay" => intval($reserveDay)
        );

#End of RIGHTSIDE

        //hunsnii buteegdhuunuudiig avch bn
        $products = DB::table("tb_food_products")->get();
        //aimag ymar norm ashiglaj bgaag avch bn
        $provNormProducts = DB::table("tb_norms")->where('normID', '=', $province->normID)->get();

        $bottomSide = [];

        foreach ($products as $product) {
          //tus aimagt bgaa hunsnii neg ner torliin baraa niit her bgaag avch bn
          $productTotalQntt = DB::table("tb_food_reserve")
            ->where("provID", "=", $province->id)
            ->where("productID","=",$product->id)->sum("mainQntt");

          $totalProtein = ($productTotalQntt * $product->foodProtein) / ($product->foodQntt);
          $totalFat = ($productTotalQntt * $product->foodFat) / ($product->foodQntt);
          $totalCarbon = ($productTotalQntt * $product->foodCarbon) / ($product->foodQntt);
          $Kcal = ($productTotalQntt * $product->foodCkal) / ($product->foodQntt);
          $isMeat = 0;
          $totalCattleProtein = 0;
          $totalCattleFat = 0;
          $totalCattleCarbon = 0;

          if($product->productCode == '01')
          {
            $isMeat = 1;
            $totalCattleProtein = ($totalSheepKg * $product->foodProtein) / ($product->foodQntt);
            $totalCattleFat = ($totalSheepKg * $product->foodFat) / ($product->foodQntt);
            $totalCattleCarbon = ($totalSheepKg * $product->foodCarbon) / ($product->foodQntt);
          }

          foreach ($provNormProducts as $normProduct) {
            //tuhain aimgiin norm dahi hunsnii buteegdehuunii ilchleguudiig gol neriin buteegdhun tablees avch bn
            if($product->id == $normProduct->producID){

              $val = $normProduct->normQntt * $standardPop;
              array_push($bottomSide, array(
                  "product" => $product->productName,
                  "leftDays" => intval($productTotalQntt / $val),
                  "remaining" => $productTotalQntt,
                  "foodProtein" => $totalProtein,
                  "foodFat" => $totalFat,
                  "foodCarbon" => $totalCarbon,
                  "Kcal" =>$Kcal,
                  "isMeat" => $isMeat,
                  "totalCattleKg" => $totalSheepKg,
                  "totalCattleProtein" => $totalCattleProtein,
                  "totalCattleFat" => $totalCattleFat,
                  "totalCattleCarbon" => $totalCattleCarbon,
                  "totalCattleKcal" => $totalCattleKcal
                )
              );
            }
          }
        }

        $totalPop1 = DB::table("tb_population")
        ->join('tb_sym', 'tb_sym.id', '=','tb_population.symID')
        ->select('tb_sym.symName', 'tb_population.*')
        ->where("tb_population.provID", "=", $province->id)->get();
        // return ($totalPop1);
        //dd($totalPop1);

        $bothSides = array(
          "rightSide" => $rightSide,
          "bottomSide" => $bottomSide,
          "totalPop1" => $totalPop1
        );
        return $bothSides;

      } catch (\Exception $e) {
        // return "Серверийн алдаа!!! Веб мастерт хандана уу";
        return $e;
      }

    }
    public function getSymInfo(Request $req){
      try {
        $sym = DB::table("tb_sym")->where("symCode", "=", $req->symCode)->first();

        //dd($req->symCode);

        //tuhain aimgiin normiin id-iig avch bn
        $norm = DB::table("tb_normname")->where("id", "=", $sym->normID)->first();
        $normKcal = $norm->sumKcal;

        //tuhain symiin niit hun amiin too
        $totalPop = DB::table("tb_population")
          ->where("symID", "=", $sym->id)->sum("totalPop");

        //tuhain symiin jishsen hun amiin too
        $standardPop = DB::table("tb_population")
          ->where("symID", "=", $sym->id)->sum("standardPop");

        //normiin kcal-iig tuhain symiin jishsen huneer urjuulj niit kcal-iig bodoj bn
        if($standardPop != 0)
          $symTotalKcal = $normKcal * $standardPop;
        else
          $symTotalKcal = 0;

        //hunsnii nootsoos niit kcal-iig avch bn
        $reserveTotalKcal = DB::table("tb_food_reserve")
          ->where("provID", "=", $sym->id)->sum("totalKcal");


        //symiin niit maliin too
        $totalCattle = DB::table("tb_cattle_qntt")
          ->where("symID", "=", $sym->id)->sum("cattQntt");

        $totalSheepKg = DB::table("tb_cattle_qntt")
          ->where("symID", "=", $sym->id)->sum("sheepKg");

        //maliin honin tolgoid shiljuulsen kg-iin niit kcal iig bodoh heseg
        $meat = DB::table("tb_food_products")
          ->where("productCode", "=", "01")->first();
        $meatQntt = $meat->foodQntt;
        $meatKcal = $meat->foodCkal;
        //niit maliin kcal
        $totalCattleKcal = $totalSheepKg*$meatKcal/$meatQntt;

        //heden honog uldseniig kcal-oor huvaaj haruulj bn
        $reserveDay = ($reserveTotalKcal + $totalCattleKcal) / $symTotalKcal;

        $rightSide = array(
          "totalPop" => $totalPop,
          "standardPop" => $standardPop,
          "totalCattle" => $totalCattle,
          "reserveDay" => intval($reserveDay)
        );
#End of RIGHTSIDE

        //hunsnii golneriin buteegdhuunuudiig avch bn
        $products = DB::table("tb_food_products")->get();
        //tuhain sumiin normiin hunsnii buteegdhuunuudiig avch bn
        $symNormProducts = DB::table("tb_norms")->where('normID', '=', $sym->normID)->get();

        $bottomSide = [];

        foreach ($products as $product) {
          $productTotalQntt = DB::table("tb_food_reserve")
            ->where("symID", "=", $sym->id)
            ->where("productID","=",$product->id)->sum("mainQntt");

          $totalProtein = ($productTotalQntt * $product->foodProtein) / ($product->foodQntt);
          $totalFat = ($productTotalQntt * $product->foodFat) / ($product->foodQntt);
          $totalCarbon = ($productTotalQntt * $product->foodCarbon) / ($product->foodQntt);
          $Kcal = ($productTotalQntt * $product->foodCkal) / ($product->foodQntt);

          $isMeat = 0;
          $totalCattleProtein = 0;
          $totalCattleFat = 0;
          $totalCattleCarbon = 0;

          if($product->productCode == '01')
          {
            $isMeat = 1;
            $totalCattleProtein = ($totalSheepKg * $product->foodProtein) / ($product->foodQntt);
            $totalCattleFat = ($totalSheepKg * $product->foodFat) / ($product->foodQntt);
            $totalCattleCarbon = ($totalSheepKg * $product->foodCarbon) / ($product->foodQntt);
          }

          foreach ($symNormProducts as $normProduct) {
            if($product->id == $normProduct->producID){
              $val = $normProduct->normQntt * $standardPop;
              array_push($bottomSide, array(
                  "product" => $product->productName,
                  "leftDays" => intval($productTotalQntt / $val),
                  "remaining" => $productTotalQntt,
                  "foodProtein" => $totalProtein,
                  "foodFat" => $totalFat,
                  "foodCarbon" => $totalCarbon,
                  "Kcal" => $Kcal,
                  "isMeat" => $isMeat,
                  "totalCattleKg" => intval($totalSheepKg),
                  "totalCattleProtein" => intval($totalCattleProtein),
                  "totalCattleFat" => intval($totalCattleFat),
                  "totalCattleCarbon" => intval($totalCattleCarbon),
                  "totalCattleKcal" => intval($totalCattleKcal)
                )
              );
            }
          }
        }
        $bothSides = array(
          "rightSide" => $rightSide,
          "bottomSide" => $bottomSide,

        );
        return $bothSides;

      } catch (\Exception $e) {
        // return "Серверийн алдаа!!! Веб мастерт хандана уу";
        return $e;
      }
    }
}
