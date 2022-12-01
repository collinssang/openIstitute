<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveDaysRequest;
use App\Http\Requests\UpdateLeaveDaysRequest;
use App\Models\LeaveDays;
use Illuminate\Http\Response;

class LeaveDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeaveDaysRequest  $request
     * @return Response
     */
    public function store(StoreLeaveDaysRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param LeaveDays $leaveDays
     * @return Response
     */
    public function show(LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LeaveDays $leaveDays
     * @return Response
     */
    public function edit(LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeaveDaysRequest  $request
     * @param LeaveDays $leaveDays
     * @return Response
     */
    public function update(UpdateLeaveDaysRequest $request, LeaveDays $leaveDays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LeaveDays $leaveDays
     * @return Response
     */
    public function destroy(LeaveDays $leaveDays): Response
    {
        //
    }
}
