<?php

namespace App\Http\Controllers;

use App\Models\Pengujian;
use App\Http\Requests\StorePengujianRequest;
use App\Http\Requests\UpdatePengujianRequest;

class PengujianController extends Controller
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
     * @param  \App\Http\Requests\StorePengujianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengujianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian  $pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengujian  $pengujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengujian $pengujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengujianRequest  $request
     * @param  \App\Models\Pengujian  $pengujian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengujianRequest $request, Pengujian $pengujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengujian  $pengujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengujian $pengujian)
    {
        //
    }
}
