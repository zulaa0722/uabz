<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangerSym;
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
use App\SubProducts;
use App\SubReserve;
use DB;

class SubReserveController extends Controller
{
  //
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function showSubView()
  {
    try{
      //onts baidal zarlasan sumuudiig avch bn
      $dangerSymd = DB::table("tb_danger_sym")->get();


      //hunsnii golneriin buteegdhuunuudiig avch bn
      $products = DB::table("tb_food_products")->get();
      $arr = [];

      foreach ($dangerSymd as $dangerSym) {
        $sym = DB::table("tb_sym")->where("symCode", "=", $dangerSym->symID)->first();

        $province = DB::table("tb_province")->where("id", "=", $dangerSym->provID)->first();

        //tuhain sumiin normiin hunsnii buteegdhuunuudiig avch bn
        $symNormProducts = DB::table("tb_norms")->where('normID', '=', $sym->normID)->get();

        //tuhain symiin jishsen hun amiin too
        $standardPop = DB::table("tb_population")
          ->where("symID", "=", $sym->id)->sum("standardPop");

        foreach ($products as $product) {
          //tuhain sumiin nootsod bga hunsnii buteegdehuunuudiin hemjee
          $productTotalQntt = DB::table("tb_food_reserve")
            ->where("symID", "=", $sym->id)
            ->where("productID","=",$product->id)->sum("mainQntt");

          foreach ($symNormProducts as $normProduct) {
            if($product->id == $normProduct->producID){
              //tuhain sumiin normiin hunsnii buteegdehuunuudiin hemjeeg jishsen hun amaar urjuulj bn.
              //neg odort hereglegdeh hunsnii buteegdehuunuudiin hemjee garch irne
              $val = $normProduct->normQntt * $standardPop;

              $leftDays = 0;
              if($productTotalQntt != 0)
                $leftDays = intval($productTotalQntt / $val);
                if($leftDays < 7)
                  array_push($arr, array(
                    // "pp" => $val
                      "provID" => $province->id,
                      "provName" => $province->provName,
                      "symID" => $sym->symCode,
                      "symName" => $sym->symName,
                      "productID" => $product->id,
                      "product" => $product->productName,
                      "leftDays" => $leftDays
                    )
                  );
            }
          }
        }
      }

      return view("ShowSubProduct.ShowSubProducts", compact("arr"));
    }catch(\Exception $e){
      // return $e;
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function ShowCompanySubs(Request $req)
  {
    try {
      $subs = DB::table("tb_sub_products")->where("fProductID", "=", $req->productID)->get();
      return $subs;
    } catch (\Exception $e) {
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
      // return $e;
    }

  }
  public function saveSubProducts(Request $req)
  {
    try {
      foreach ($req->subs as $key => $value) {
          $insertSubReserve = new SubReserve;
          $insertSubReserve->provID = $req->provID;
          $insertSubReserve->symID = $req->symID;
          $insertSubReserve->companyName = $req->companyName;
          $insertSubReserve->companyCode = $req->companyCode;
          $insertSubReserve->subProductID = $value["id"];
          $insertSubReserve->measurement = "кг";
          $insertSubReserve->mainQntt = $value['qntt'];
          $insertSubReserve->totalPrice = $value['totalPrice'];
          $insertSubReserve->subReseverDate = "";
          $insertSubReserve->save();
        }
    } catch (\Exception $e) {
      return $e;
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }

  }
}
