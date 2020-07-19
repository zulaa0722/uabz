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
        try{
            Norm::where('normID',$req->normID)->delete();
            $normName = NormName::find($req->normID);
            $normName->sumKcal = $req->sumKcal;
            $normName->save();
            foreach ($req->norms as $key => $value) {
                $norm = new Norm;
                $norm->producID = $value['productID'];
                $norm->normQntt = $value['normQntt'];
                $norm->normCkal = $value['normCkal'];
                $norm->normID = $req->normID;
                $norm->save();
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

    public function destroy(Request $req)
    {
        try{
            NormName::where('id',$req->normID)->delete();
            Norm::where('normID',$req->normID)->delete();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай устгалаа!!!'
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

    public function getNormsByNormID(Request $req){
        try{
            $norms = DB::table('tb_norms')
                ->join('tb_food_products', 'tb_norms.producID', '=', 'tb_food_products.id')
                ->select('tb_food_products.productName', 'tb_norms.*')
                ->where('tb_norms.normID', '=', $req->id)
                ->get();
            return DataTables::of($norms)
              ->make(true);
        }catch(\Exception $e){
            return "Серверийн алдаа!!! Веб мастерт хандана уу";
        }
    }
}
