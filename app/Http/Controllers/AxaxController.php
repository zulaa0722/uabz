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
use DB;

class AxaxController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function axaxShow()
  {
    try{
      $levels = DB::table("tb_level")->get();
      $organizations = DB::table("tb_organizations")->get();

      return view("Axax.Axax", compact("levels", "organizations"));
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getAxaxData(Request $req)
  {
    try{
      $axax = DB::table("tb_axax")
        ->join("tb_level", "tb_axax.levelID", "=", "tb_level.id")
        ->join("tb_organizations", "tb_axax.mainOrgID", "=", "tb_organizations.id")
        ->select("tb_axax.*", "tb_level.levelName", "tb_organizations.abbrName as mainName",
                  DB::raw('(select tb_organizations.abbrName from tb_organizations where tb_organizations.id = tb_axax.supportOrgID) as supportName'))->get();
      return DataTables::of($axax)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertAxax = new Axax;
      $insertAxax->axaxName = $req->axaxName;
      $insertAxax->levelID = $req->levelID;
      $insertAxax->inTime = $req->inTime;
      $insertAxax->mainOrgID = $req->mainOrgID;
      $insertAxax->supportOrgID = $req->supportOrgID;
      $insertAxax->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateAxax = Axax::find($req->rowID);
      $updateAxax->axaxName = $req->axaxName;
      $updateAxax->levelID = $req->levelID;
      $updateAxax->inTime = $req->inTime;
      $updateAxax->mainOrgID = $req->mainOrgID;
      $updateAxax->supportOrgID = $req->supportOrgID;
      $updateAxax->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteAxax = Axax::find($req->rowID);
      $deleteAxax->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
