<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreStopRequest;
use App\Http\Requests\UpdateStopRequest;
use App\Models\Stop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class StopController extends Controller
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
     * @param  \App\Http\Requests\StoreStopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stop  $stop
     * @return \Illuminate\Http\Response
     */
    public function show(Stop $stop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stop  $stop
     * @return \Illuminate\Http\Response
     */
    public function edit(Stop $stop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStopRequest  $request
     * @param  \App\Models\Stop  $stop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStopRequest $request, Stop $stop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stop  $stop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stop $stop)
    {
        //
    }
}
