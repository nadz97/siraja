<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use App\Http\Requests\StoreSaksiRequest;
use App\Http\Requests\UpdateSaksiRequest;

class SaksiController extends Controller
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
     * @param  \App\Http\Requests\StoreSaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function show(Saksi $saksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Saksi $saksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaksiRequest  $request
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaksiRequest $request, Saksi $saksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saksi  $saksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saksi $saksi)
    {
        //
    }
}
