<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogCattle;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;

class LogCattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showLogCattle(){
        $provs = DB::table('tb_danger_sym')
            ->join('tb_danger', 'tb_danger_sym.danger_id', '=', 'tb_danger.id')
            ->join('tb_province', 'tb_danger_sym.provID', '=', 'tb_province.id')
            ->groupBy('tb_danger_sym.provID', 'tb_province.provName')
            ->select('tb_danger_sym.provID', 'tb_province.provName')
            ->where('tb_danger.status', '=', 1)
            ->get();
        return view('LogCattle.logCattleShow', compact('provs'));
    }

    public function getCattleLogBySymCode(Request $req){

    }
}
