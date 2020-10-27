<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GrainWarehouse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class SrvyGrainWarehousesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function grainWarehouseShow()
  {
    try{
      $provinces = DB::table("tb_province")->get();
      return view("Survey.GrainWarehouse.GrainWarehouse", compact("provinces"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function getGrainWarehouseData(Request $req)
  {
    try{
      $grainWarehouse = DB::table("srvy_grain_warehouses")
      ->join("tb_province", "srvy_grain_warehouses.provID", "=", "tb_province.id")
      ->join("tb_sym", "srvy_grain_warehouses.symID", "=", "tb_sym.id")
      ->select("srvy_grain_warehouses.*", "tb_province.provName", "tb_sym.symName")->get();
      return DataTables::of($grainWarehouse)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function store(Request $req)
  {
    try{
      $insertGrainWarehouse = new GrainWarehouse;
      $insertGrainWarehouse->provID = $req->provID;
      $insertGrainWarehouse->symID = $req->symID;
      $insertGrainWarehouse->firmName = $req->firmName;
      $insertGrainWarehouse->startDate = $req->startDate;
      $insertGrainWarehouse->capacity = $req->capacity;
      $insertGrainWarehouse->state = $req->state;
      $insertGrainWarehouse->resName = $req->resName;
      $insertGrainWarehouse->contact = $req->contact;
      $insertGrainWarehouse->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
      return $e;
    }
  }

  public function update(Request $req)
  {
    try{
      $updateGrainWarehouse = GrainWarehouse::find($req->rowID);
      $updateGrainWarehouse->provID = $req->provID;
      $updateGrainWarehouse->symID = $req->symID;
      $updateGrainWarehouse->firmName = $req->firmName;
      $updateGrainWarehouse->startDate = $req->startDate;
      $updateGrainWarehouse->capacity = $req->capacity;
      $updateGrainWarehouse->state = $req->state;
      $updateGrainWarehouse->resName = $req->resName;
      $updateGrainWarehouse->contact = $req->contact;
      $updateGrainWarehouse->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $warehouse = GrainWarehouse::find($req->rowID);
      $warehouse->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
