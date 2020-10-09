<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogCattle;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;
use App\Cattle;

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
        $cattles = Cattle::all();
        return view('LogCattle.logCattleShow', compact('provs', 'cattles'));
    }

    public function getCattlesLogBySymCode(Request $req){
        // $logCattles = DB::table('log_cattle')
        //     ->join('tb_cattle', 'log_cattle.cattleID')
        $syms = DB::table("tb_sym")
            ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
            ->select("tb_sym.*", "tb_province.provName")
            ->where('tb_sym.id', '<', 20)
            ->get();
        $arrCattleQtt = [];
        $rowCount = 1;
        $cattles = Cattle::all();
        $cols=[];

        foreach ($syms as $sym) {
            $datarow = [];
            $datarow['number'] = $rowCount;
            $datarow += ['provID'=>$sym->provID];
            $datarow += ['sumID'=>$sym->id];
            foreach ($cattles as $cattle) {
              // $cattle->id => $cattle->cattleName,
              $datarow += ["$cattle->cattleName" => $cattle->id];
              // $datarow += ["$cattle->id" => $cattle->id];
            }
            array_push($arrCattleQtt, $datarow);
            $rowCount++;
        }
        return DataTables::of($arrCattleQtt)
          ->make(true);
    }


}
