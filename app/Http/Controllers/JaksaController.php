<?php

namespace App\Http\Controllers;

use App\Models\Jaksa;
use App\Http\Requests\StoreJaksaRequest;
use App\Http\Requests\UpdateJaksaRequest;

class JaksaController extends Controller
{
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
     * @param  \App\Http\Requests\StoreJaksaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJaksaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jaksa  $jaksa
     * @return \Illuminate\Http\Response
     */
    public function show(Jaksa $jaksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jaksa  $jaksa
     * @return \Illuminate\Http\Response
     */
    public function edit(Jaksa $jaksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJaksaRequest  $request
     * @param  \App\Models\Jaksa  $jaksa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJaksaRequest $request, Jaksa $jaksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jaksa  $jaksa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jaksa $jaksa)
    {
        //
    }
}
