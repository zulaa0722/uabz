<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;

class mongolianMapsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mongolianMapsShow(){
        return view("mongolianMap.mongolianMap");
    }

    public function mongolianSumd(Request $req){
        $aimagNam = $req->name;
        return view("mongolianMap.sumduud", compact("aimagNam"));
    }

    public function getName(Request $req){
        return $req->name;
    }

    public function form1(Request $req){
        return view("forms.nootsiinSudalgaa");
    }

    public function getBaliarArray(){
        $sums = DB::table('tb_province')
            ->get();
        $baliarArray=[];
        foreach ($sums as $sum) {
            array_push($baliarArray, array("sumID"=>"$sum->id","aimagID"=>"$sum->provID","Joe"=>"43"));
        }
        return $baliarArray;
    }
}
