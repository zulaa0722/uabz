<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;
use App\LocalSaltDeposit;

class SrvyLocalSaltDepositsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function showSaltDeposit(){
      try {
        $provinces = DB::table("tb_province")->get();
        return view('Survey.SaltDeposit.SaltDeposit', compact("provinces"));
      } catch (\Exception $e) {

      }
  }

  public function getSaltDeposit(Request $req)
  {
    try{
      $saltDeposits = DB::table("srvy_local_salt_deposits")
      ->join("tb_province", "srvy_local_salt_deposits.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_local_salt_deposits.symID", "=", "tb_sym.id")
      ->select("srvy_local_salt_deposits.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($saltDeposits)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function store(Request $req)
  {
    try{
      $saltDeposit = new LocalSaltDeposit;
      $saltDeposit->provID = $req->provID;
      $saltDeposit->symID = $req->symID;
      $saltDeposit->dpstName = $req->dpstName;
      $saltDeposit->dpstReserve = $req->dpstReserve;
      $saltDeposit->dpstState = $req->dpstState;
      $saltDeposit->distance = $req->distance;
      $saltDeposit->resName = $req->resName;
      $saltDeposit->contact = $req->contact;
      $saltDeposit->save();
      $array = array(
          'status' => 'success',
          'msg' => 'Амжилттай хадгаллаа!!!'
      );
      return $array;
    }catch(\Exception $e){
      $array = array(
          'status' => 'error',
          'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
      );
      return $array;
    }
  }

  public function update(Request $req)
  {
    try{
      $saltDeposit = LocalSaltDeposit::find($req->rowID);
      $saltDeposit->provID = $req->provID;
      $saltDeposit->symID = $req->symID;
      $saltDeposit->dpstName = $req->dpstName;
      $saltDeposit->dpstReserve = $req->dpstReserve;
      $saltDeposit->dpstState = $req->dpstState;
      $saltDeposit->distance = $req->distance;
      $saltDeposit->resName = $req->resName;
      $saltDeposit->contact = $req->contact;
      $saltDeposit->save();
      $array = array(
          'status' => 'success',
          'msg' => 'Амжилттай хадгаллаа!!!'
      );
      return $array;
    }catch(\Exception $e){
      $array = array(
          'status' => 'error',
          'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
      );
      return $array;
    }
  }

  public function delete(Request $req)
  {
    try{
      $saltDeposit = LocalSaltDeposit::find($req->rowID);
      $saltDeposit->delete();
      $array = array(
          'status' => 'success',
          'msg' => 'Амжилттай устгалаа!!!'
      );
      return $array;
    }catch(\Exception $e){
      $array = array(
          'status' => 'error',
          'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
      );
      return $array;
    }
  }
}
