<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;
use App\Danger;
use App\Http\Controllers\SumAndFoodReserveController;

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
      ////end duudna
      $obj = new SumAndFoodReserveController;
      $obj->minusNormFromReserve();



      return view("mongolianMap.mongolianMap", compact('sectors'));

    }
}
