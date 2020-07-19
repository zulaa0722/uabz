<?php

namespace App\Http\Controllers;

use App\FoodFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodFactoryController extends Controller
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
     * @param  \App\FoodFactory  $foodFactory
     * @return \Illuminate\Http\Response
     */
    public function show(FoodFactory $foodFactory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodFactory  $foodFactory
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodFactory $foodFactory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodFactory  $foodFactory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodFactory $foodFactory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodFactory  $foodFactory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodFactory $foodFactory)
    {
        //
    }
}
