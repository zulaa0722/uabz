<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Norm;
use App\NormName;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class NormController extends Controller
{

    public function show()
    {
        try{
            $foods = DB::table('tb_food_products')
                ->orderBy('productName', 'ASC')
                ->get();
            $normNames = DB::table('tb_normname')
                ->orderBy('id', 'ASC')
                ->get();
            return view('Norm.normShow', compact('foods', 'normNames'));
        }catch(\Exception $e){
            return 'Серверийн алдаа!!! Веб мастерт хандана уу!!!';
        }
    }

    public function store(Request $req)
    {
        try{
            $normNames = DB::table('tb_normname')
                ->where('NormName', '=', $req->normName)
                ->get();
            if(count($normNames) > 0){
                $array = array(
                    'status' => 'exist',
                    'msg' => 'Энэ нормын нэр бүртгэгдсэн байна!!!'
                );
                return $array;
            }

            $normName = new NormName;
            $normName->NormName = $req->normName;
            $normName->sumKcal = $req->sumKcal;
            $normName->save();
            $normID = $normName->id;
            foreach ($req->norms as $key => $value) {
                $norm = new Norm;
                $norm->producID = $value['productID'];
                $norm->normQntt = $value['normQntt'];
                $norm->normCkal = $value['normCkal'];
                $norm->normID = $normID;
                $norm->save();
            }
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!',
                'normID' => $normID
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


    public function update(Request $req)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
