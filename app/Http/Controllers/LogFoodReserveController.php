<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\LogFoodReserve;

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
    return view("LogFoodReserve/LogFoodReserve", compact('provs'));
  }
}
