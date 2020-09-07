<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class SymController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function symShow()
  {
    try{
      if(Auth::user()->permission == 2){
        return view("permission.permissionError");
      }
      else{
        $Provinces = DB::table("tb_province")->get();
        return view("Sym.Sym", compact("Provinces"));
      }
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getSymData(Request $req)
  {
    try{
      $syms = DB::table("tb_sym")
        ->join("tb_province", "tb_sym.provID", "=", "tb_province.id")
        ->select("tb_sym.*", "tb_province.provName")->get();
      return DataTables::of($syms)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertSym = new Sym;
      $insertSym->provID = $req->provID;
      $insertSym->symName = $req->symName;
      $insertSym->symCode = $req->symCode;
      $insertSym->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateSym = Sym::find($req->rowID);
      $updateSym->provID = $req->provID;
      $updateSym->symName = $req->symName;
      $updateSym->symCode = $req->symCode;
      $updateSym->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteSym = Sym::find($req->rowID);
      $deleteSym->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getSymByProvinceID(Request $req)
  {
    try{
      $getSyms  = DB::table("tb_sym")->where("provID", "=", $req->provID)->get();
      return json_encode($getSyms);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
