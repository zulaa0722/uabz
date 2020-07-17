<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodReserveController extends Controller
{
    //
    public function foodReserveShow()
    {
      try{
        return view("FoodReserve.FoodReserve");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }
}
