<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sym;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class DangerController extends Controller
{
    public function declareDangerBySum(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }
        try{
            foreach($req->sums as $sum){
                $sum = Sym::find($sum);
                $sum->isStart = 1;
                $sum->save();
            }
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function declareDangerByProvs(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }

        try{
            foreach($req->provs as $prov){
                $sum = Sym::where('provID', $prov)
                    ->update([
                        'isStart' => 1
                    ]);
            }
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function declareDangerBySector(Request $req){
        if (!(Hash::check($req->get('password'), Auth::user()->password))) {
            $array = array(
                'status' => 'error',
                'msg' => 'Нууц үг буруу байна!!!'
            );
            return $array;
        }

        try{
            foreach($req->sectors as $sector){
                $provs = DB::table('tb_province')->where('sectorID', '=', $sector)->get();
                foreach ($provs as $prov) {
                    $sum = Sym::where('provID', $prov->id)
                        ->update([
                            'isStart' => 1
                        ]);
                }
            }
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }


}
