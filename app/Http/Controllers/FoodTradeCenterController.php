<?php

namespace App\Http\Controllers;

use App\FoodTradeCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodTradeCenterController extends Controller
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
     * @param  \App\FoodTradeCenter  $foodTradeCenter
     * @return \Illuminate\Http\Response
     */
    public function show(FoodTradeCenter $foodTradeCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodTradeCenter  $foodTradeCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodTradeCenter $foodTradeCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodTradeCenter  $foodTradeCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodTradeCenter $foodTradeCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodTradeCenter  $foodTradeCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodTradeCenter $foodTradeCenter)
    {
        //
    }
}
