<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showUsers(){
        $provinces = DB::table('tb_province')
            ->orderBy('provName', 'ASC')
            ->get();
        return view('User.userShow', compact('provinces'));
    }

    public function getUsers(){
        $users = DB::table('users')
            ->join('tb_province', 'users.aimagCode', '=', 'tb_province.provCode')
            ->join('users_permission', 'users.permission', '=', 'users_permission.id')
            ->select('users.*', 'users_permission.permissionName', 'tb_province.provName')
            ->get();
        return DataTables::of($users)
          ->make(true);
    }

    public function update(Request $req){
        try{
            $user = User::find($req->id);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->permission = $req->permission;
            $user->aimagCode = $req->aimagCode;
            $user->save();

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

    public function changePassword(Request $req){
        try{
            $user = User::find($req->id);
            $user->password = Hash::make($req->password);
            $user->save();

            $array = array(
                'status' => 'success',
                'msg' => 'Нууц үг амжилттай солилоо!!!'
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

    public function deleteUsers(Request $req){
        try{
            User::where('id',$req->id)->delete();
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
}
