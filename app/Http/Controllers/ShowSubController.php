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
use DB;

class ShowSubController extends Controller
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
                  if($leftDays > 7)
                    array_push($arr, array(
                      // "pp" => $val
                        "product" => $product->productName,
                        "productID" => $product->id,
                        "leftDays" => $leftDays
                      )
                    );
              }
            }
          }
        }

        return $arr;





        return view("ShowSubProduct.ShowSubProducts");
      }catch(\Exception $e){
        return $e;
        // return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }


}
