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

class SurveyController extends Controller
{
    public function surveyListShow()
    {
      try{
        return view("Survey.Survey");
      }catch(\Exception $e){
        return "Серверийн алдаа!!! Веб мастерт хандана уу";
      }
    }
}
