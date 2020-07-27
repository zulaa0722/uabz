<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Axax;
use App\Sector;
use App\Province;
use App\Sym;
use App\Status;
use DB;

class StatusController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  
  public function statusShow()
  {
    try{
      return view("Status.Status");
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getStatusData(Request $req)
  {
    try{
      $status = DB::table("tb_status")->get();
      return DataTables::of($status)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertStatus = new Status;
      $insertStatus->statusName = $req->statusName;
      $insertStatus->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateStatus = Status::find($req->rowID);
      $updateStatus->statusName = $req->statusName;
      $updateStatus->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteStatus = Status::find($req->rowID);
      $deleteStatus->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
