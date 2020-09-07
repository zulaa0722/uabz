<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use DB;
use App\Population;

class ProvinceController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function provinceShow()
  {
    try{
      if(Auth::user()->permission == 2){
        return view("permission.permissionError");
      }
      else{
        $Secters = DB::table("tb_sectors")->get();
        return view("Province.Province", compact("Secters"));
      }
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getProvinceData(Request $req)
  {
    try{
      $province = DB::table("tb_province")
        ->join("tb_sectors", "tb_province.sectorID", "=", "tb_sectors.id")
        ->select("tb_province.*", "tb_sectors.sectorName")->get();
      return DataTables::of($province)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertProvince = new Province;
      $insertProvince->sectorID = $req->sectorID;
      $insertProvince->provName = $req->provName;
      $insertProvince->provCode = $req->provCode;
      $insertProvince->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateProvince = Province::find($req->rowID);
      $updateProvince->sectorID = $req->sectorID;
      $updateProvince->provName = $req->provName;
      $updateProvince->provCode = $req->provCode;
      $updateProvince->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteProvince = Province::find($req->rowID);
      $deleteProvince->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getProvsByBus(Request $req){
      try{
          $provs = DB::table('tb_province')
              ->where('sectorID', '=', $req->bus)
              ->get();
          return json_encode($provs);
      }catch(\Exception $e){
          return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
  }
}
