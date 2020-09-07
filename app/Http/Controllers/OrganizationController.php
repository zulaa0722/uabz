<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Organization;
use Carbon\Carbon;
use App\Sector;
use App\Province;
use App\Sym;
use DB;

class OrganizationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function orgShow()
  {
    try{
      if(Auth::user()->permission == 2){
        return view("permission.permissionError");
      }
      else{
        return view("Organization.Organization");
      }
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getOrgData(Request $req)
  {
    try{
      $organizations = DB::table("tb_organizations")->get();
      return DataTables::of($organizations)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertOrganization = new Organization;
      $insertOrganization->abbrName = $req->abbrName;
      $insertOrganization->fullName = $req->fullName;
      $insertOrganization->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateOrganization = Organization::find($req->rowID);
      $updateOrganization->abbrName = $req->abbrName;
      $updateOrganization->fullName = $req->fullName;
      $updateOrganization->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteOrganization = Organization::find($req->rowID);
      $deleteOrganization->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
