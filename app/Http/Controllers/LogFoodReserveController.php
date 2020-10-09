<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogFoodReserveController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function showHome()
  {
    return view("LogFoodReserve/LogFoodReserve");
  }
}
