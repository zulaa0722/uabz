<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Sector;
use DB;

class SectorController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function sectoreShow()
    {
      try{
        return view("Sector.Sector");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }

    public function getSectorData(Request $req)
    {
      try{
        $sector = DB::table("tb_sectors")->get();
        return DataTables::of($sector)
          ->make(true);
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }
    public function store(Request $req)
    {
      try{
        $insertSector = new Sector;
        $insertSector->sectorName = $req->sectorName;
        $insertSector->sectorCode = $req->sectorCode;
        $insertSector->save();
        return "Амжилттай хадгаллаа";
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }

    public function update(Request $req)
    {
      try{
        $updateSector = Sector::find($req->rowID);
        $updateSector->sectorName = $req->sectorName;
        $updateSector->sectorCode = $req->sectorCode;
        $updateSector->save();
        return "Амжилттай заслаа";
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }

    public function delete(Request $req)
    {
      try{
        $deleteSector = Sector::find($req->rowID);
        $deleteSector->delete();
        return "Амжилттай устгалаа";
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }


}
