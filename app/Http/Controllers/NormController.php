<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Norm;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class NormController extends Controller
{

    public function show()
    {
        return view('Norm.normShow');
    }

    public function store(Request $request)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
