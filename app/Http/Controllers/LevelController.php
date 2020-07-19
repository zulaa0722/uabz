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
use App\Level;
use DB;

class LevelController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  public function levelShow()
  {
    try{
      return view("Level.Level");
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function getLevelData(Request $req)
  {
    try{
      $getlevels = DB::table("tb_level")->get();
      return DataTables::of($getlevels)
        ->make(true);
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
  public function store(Request $req)
  {
    try{
      $insertlevel = new Level;
      $insertlevel->levelName = $req->levelName;
      $insertlevel->save();
      return "Амжилттай хадгаллаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function update(Request $req)
  {
    try{
      $updateLevel = Level::find($req->rowID);
      $updateLevel->levelName = $req->levelName;
      $updateLevel->save();
      return "Амжилттай заслаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }

  public function delete(Request $req)
  {
    try{
      $deleteLevel = Level::find($req->rowID);
      $deleteLevel->delete();
      return "Амжилттай устгалаа";
    }catch(\Exception $e){
      return "Серверийн алдаа!!! Веб мастерт хандана уу";
    }
  }
}
