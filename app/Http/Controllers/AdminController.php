<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAdmin(){
        return view('admins.admins');
    }

    public function getAdmins(){
        // return auth()->user();
        $users = DB::table("users")->get();
        return DataTables::of($users)
              ->make(true);
    }
}
