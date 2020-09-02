<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("ShowSubProduct.ShowSubProducts");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }


}
