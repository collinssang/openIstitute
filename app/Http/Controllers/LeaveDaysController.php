<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveDaysRequest;
use App\Http\Requests\UpdateLeaveDaysRequest;
use App\Models\LeaveDays;

class LeaveDaysController extends Controller
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
     * @param  \App\Http\Requests\StoreLeaveDaysRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaveDaysRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaveDays  $leaveDays
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveDays  $leaveDays
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeaveDaysRequest  $request
     * @param  \App\Models\LeaveDays  $leaveDays
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaveDaysRequest $request, LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveDays  $leaveDays
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveDays $leaveDays)
    {
        //
    }
}
