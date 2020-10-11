<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogCattle;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;
use App\Cattle;
use App\ConstanVariables;
use App\CattleQntt;
use App\Sym;

class LogCattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showLogCattle(){
        $provs = DB::table('tb_danger_sym')
            ->join('tb_danger', 'tb_danger_sym.danger_id', '=', 'tb_danger.id')
            ->join('tb_province', 'tb_danger_sym.provID', '=', 'tb_province.id')
            ->groupBy('tb_danger_sym.provID', 'tb_province.provName')
            ->select('tb_danger_sym.provID', 'tb_province.provName')
            ->where('tb_danger.status', '=', 1)
            ->get();
        $cattles = Cattle::all();
        return view('LogCattle.logCattleShow', compact('provs', 'cattles'));
    }

    public function getCattlesLogBySymCode(Request $req){
        $logSums = DB::table("log_cattle")
            ->where('sumCode', '=', $req->sumCode)
            ->where('dangerID', '=', $req->dangerID)
            ->select('sumCode', 'date', 'dangerID')
            ->groupBy('sumCode', 'date', 'dangerID')
            ->get();

        $cattles = Cattle::all();

        $arrCattleQtt = [];
        $rowCount = 1;
        foreach ($logSums as $logSum) {
            $datarow = [];
            $datarow['number'] = $rowCount;
            $datarow['date'] = $logSum->date;
            foreach ($cattles as $cattle) {
                $logCatRow = $this->getLogCattleCountBySumCodeDateDangerID($logSum->sumCode, $logSum->date, $logSum->dangerID, $cattle->id);
                if($logCatRow == null){
                    $datarow += ["qtt$cattle->id" => ""];
                    $datarow += ["toSheep$cattle->id" => ""];
                    $datarow += ["toKG$cattle->id" => ""];
                }
                else{
                    $datarow += ["qtt$cattle->id" => $logCatRow->quantity];
                    $datarow += ["toSheep$cattle->id" => $logCatRow->toSheep];
                    $datarow += ["toKG$cattle->id" => $logCatRow->toKG];
                }

            }
            array_push($arrCattleQtt, $datarow);
            $rowCount++;
        }
        return DataTables::of($arrCattleQtt)
          ->make(true);
    }

    public function getLogCattleCountBySumCodeDateDangerID($sumCode, $date, $danger, $cattleID){
        $cattleCount = DB::table('log_cattle')
            ->where('sumCode', '=', $sumCode)
            ->where('date', '=', $date)
            ->where('dangerID', '=', $danger)
            ->where('cattleID', '=', $cattleID)
            ->select('quantity', 'toSheep', 'toKG')
            ->first();
        return $cattleCount;
    }

    public function storeCattleLog(Request $req){
        // try {
            // DB::beginTransaction();
            $dateArray = explode('-', $req->date);
            $year = $dateArray[0];

            $oldCattleLogs = DB::table('log_cattle')
                ->where('sumCode', '=', $req->symCode)
                ->where('date', '=', $req->date)
                ->where('dangerID', '=', $req->dangerid)
                ->get();
            foreach ($oldCattleLogs as $oldCattleLog) {
                $symRow = DB::table('tb_sym')->where('symCode', '=', $oldCattleLog->sumCode)->first();
                $cattleQntt = DB::table('tb_cattle_qntt')
                    ->where('symID', '=', $symRow->id)
                    ->where('cattleID', '=', $oldCattleLog->cattleID)
                    ->orderby('year', 'DESC')->first();
                if($cattleQntt != null){
                    DB::table('tb_cattle_qntt')
                        ->where('symID', '=', $symRow->id)
                        ->where('cattleID', '=', $oldCattleLog->cattleID)
                        ->where('year', '=', $cattleQntt->year)->update([
                          'cattQntt' => $cattleQntt->cattQntt + $oldCattleLog->quantity,
                          'toSheep' => $cattleQntt->toSheep + $oldCattleLog->toSheep,
                          'sheepKg' => $cattleQntt->sheepKg + $oldCattleLog->toKG
                        ]);
                }
            }
            $oldCattleLogs = DB::table('log_cattle')
                ->where('sumCode', '=', $req->symCode)
                ->where('date', '=', $req->date)
                ->where('dangerID', '=', $req->dangerid)->delete();
            foreach ($req->jsonObj as $key => $value) {
                $symRow = DB::table('tb_sym')->where('symCode', '=', $req->symCode)->first();
                $cattleQntt = DB::table('tb_cattle_qntt')
                    ->where('symID', '=', $symRow->id)
                    ->where('cattleID', '=', $value["cattleID"])
                    ->orderby('year', 'DESC')->first();
                DB::table('tb_cattle_qntt')
                    ->where('symID', '=', $symRow->id)
                    ->where('cattleID', '=', $cattleQntt->cattleID)
                    ->where('year', '=', $cattleQntt->year)->update([
                      'cattQntt' => $cattleQntt->cattQntt - $value["cattleQntt"],
                      'toSheep' => $cattleQntt->toSheep - $value["toSheepQntt"],
                      'sheepKg' => $cattleQntt->sheepKg - $value["toSheepKg"]
                    ]);
                $cattleLog = new LogCattle;
                $cattleLog->provCode = $req->provID;
                $cattleLog->sumCode = $req->symCode;
                $cattleLog->cattleID = $value["cattleID"];
                $cattleLog->quantity = $value["cattleQntt"];
                $cattleLog->toSheep = $value["toSheepQntt"];
                $cattleLog->toKG = $value["toSheepKg"];
                $cattleLog->date = $req->date;
                $cattleLog->dangerID = $req->dangerid;
                $cattleLog->save();
            }


        // } catch (\Exception $e) {
        //     DB::rollback();
        // }
    }

}
