<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use App\Province;
use App\Http\Controllers\NormController;
use App\Http\Controllers\PopulationController;
use App\Sector;

class mongolianMapsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mongolianMapsShow(){
        $sectors = Sector::orderBy('sectorName', 'ASC')->get();
        return view("mongolianMap.mongolianMap", compact('sectors'));
    }

    public function mongolianSumd(Request $req){
        $aimagNam = $req->name;
        return view("mongolianMap.sumduud", compact("aimagNam"));
    }

    public function getName(Request $req){
        return $req->name;
    }

  // public function mongolianMapsAll(){
  //   return view("mongolianMap.allMaps");
  // }

    public function allMapsShow(){
      return view("mongolianMap.allMaps");
    }

    public function arkhangai(){
      return view("mongolianMap.Arkhangai");
    }

    public function BayanUlgii(){
      return view("mongolianMap.Bayan-Ulgii");
    }

    public function Bayankhongor(){
      return view("mongolianMap.Bayankhongor");
    }

    public function Bulgan(){
      return view("mongolianMap.Bulgan");
    }

    public function DarkhanUul(){
      return view("mongolianMap.Darkhan-Uul");
    }

    public function Dornod(){
      return view("mongolianMap.Dornod");
    }

    public function Dornogovi(){
      return view("mongolianMap.Dornogovi");
    }

    public function Dundgovi(){
      return view("mongolianMap.Dundgovi");
    }

    public function GoviAltai(){
      return view("mongolianMap.Govi-Altai");
    }

    public function Govisumber(){
      return view("mongolianMap.Govisumber");
    }

    public function Khentii(){
      return view("mongolianMap.Khentii");
    }
    public function Khovd(){
      return view("mongolianMap.Khovd");
    }
    public function Khuvsgul(){
      return view("mongolianMap.Khuvsgul");
    }
    public function Orkhon(){
      return view("mongolianMap.Orkhon");
    }
    public function Selenge(){
      return view("mongolianMap.Selenge");
    }
    public function Sukhbaatar(){
      return view("mongolianMap.Sukhbaatar");
    }

    public function Tuv(){
      return view("mongolianMap.Tuv");
    }
    public function Ulaanbaatar(){
      return view("mongolianMap.Ulaanbaatar");
    }
    public function Umnugovi(){
      return view("mongolianMap.Umnugovi");
    }
    public function Uvs(){
      return view("mongolianMap.Uvs");
    }
    public function Uvurkhangai(){
      return view("mongolianMap.Uvurkhangai");
    }
    public function Zavkhan(){
      return view("mongolianMap.Zavkhan");
    }

    public function showProvince(Request $req)
    {
      $province = DB::table("tb_province")->where("provCode", "=", $req->provCode)->first();

        $url = "mongolianMap.".$province->provEngName;
        // return $url;
      return view($url);
    }

    public function getBaliarSda(){
        $provinces = DB::table('tb_province')
            ->where('isStart', '=', 1)->get();

        $normController = new NormController;
        $popController = new PopulationController;
        $arr = [];
        foreach ($provinces as $province) {
            array_push($arr, array(
                  "id" => $province->id,
                  "name" => $province->provName,
                  "popCount" => $popController->getStandardPopByProvID($province->id),
                  "Kcal" => $normController->sumOfNormKcalByID($province->normID),
                  "reserveKcal" => "100000000"
              ));
        }
        return json_encode($arr);
    }

    // public function getSumsDay
}
