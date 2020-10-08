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
      if(Auth::user()->permission == 2){
        return view("permission.permissionError");
      }
      else{
        $levels = DB::table("tb_level")->get();
        $organizations = DB::table("tb_organizations")->get();
        $statuss = DB::table("tb_status")->get();
        $axaxTypes = DB::table("tb_axaxtype")->get();

        return view("Axax.Axax", compact("levels", "organizations", "statuss", "axaxTypes"));
      }
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public static function getAxaxesByType($axaxType){
    try {
      $axaxes = DB::table("tb_axax")
      ->join("tb_level", "tb_axax.levelID", "=", "tb_level.id")
      ->join("tb_organizations", "tb_axax.mainOrgID", "=", "tb_organizations.id")
      ->join("tb_status", "tb_axax.statusID", "=", "tb_status.id")
      ->select("tb_axax.*", "tb_level.levelName", "tb_status.statusName", "tb_organizations.abbrName")
      ->where("typeID","=",$axaxType)->get();
      return $axaxes;
    } catch (\Exception $e) {
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }

  }

  public function store(Request $req)
  {
    // return $req->fields[2]["value"];

    try{
      $insertAxax = new Axax;
      $insertAxax->typeID = $req->fields[0]['value'];
      $insertAxax->axaxName = $req->fields[1]['value'];
      $insertAxax->levelID = $req->fields[4]['value'];
      $insertAxax->statusID = $req->fields[3]['value'];
      $insertAxax->inTime = $req->fields[2]['value'];
      $insertAxax->mainOrgID = $req->fields[5]['value'];
      $insertAxax->comment = $req->fields[6]['value'];
      $insertAxax->supportOrg = $req->orgs;

      $insertAxax->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      // return $e;
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    // return $req;
    try{
      $updateAxax = Axax::find($req->fields[0]['value']);
      $updateAxax->typeID = $req->fields[1]['value'];
      $updateAxax->axaxName = $req->fields[2]['value'];
      $updateAxax->inTime = $req->fields[3]['value'];
      $updateAxax->statusID = $req->fields[4]['value'];
      $updateAxax->levelID = $req->fields[5]['value'];
      $updateAxax->mainOrgID = $req->fields[6]['value'];
      $updateAxax->supportOrg = $req->supportOrgs;
      $updateAxax->comment = $req->fields[7]['value'];
      $updateAxax->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      // return $e;
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
