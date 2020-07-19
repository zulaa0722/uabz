<?php

namespace App\Http\Controllers;

use App\GrainWarehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GrainWarehouseController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GrainWarehouse  $grainWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(GrainWarehouse $grainWarehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrainWarehouse  $grainWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(GrainWarehouse $grainWarehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrainWarehouse  $grainWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrainWarehouse $grainWarehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrainWarehouse  $grainWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrainWarehouse $grainWarehouse)
    {
        //
    }
}
