<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;
use App\Danger;
use Carbon\Carbon;
use DB;
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
      ////end duudna
      $obj = new SumAndFoodReserveController;
      $obj->minusNormFromReserve();


      $year = Carbon::now()->year;
      $sumStandardPop = DB::table('tb_population')->where('date', '=', $year)->sum('standardPop');
      $sumTotalPop = DB::table('tb_population')->where('date', '=', $year)->sum('totalPop');
      $sumCattQntt = DB::table('tb_cattle_qntt')->where('year', '=', $year)->sum('cattQntt');

      $sectors = Sector::orderBy('sectorName', 'ASC')->get();
      return view("mongolianMap.mongolianMap", compact('sectors', 'sumStandardPop', 'sumTotalPop', 'sumCattQntt', 'year'));

    }
}
