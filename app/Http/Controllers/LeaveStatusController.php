<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveStatusRequest;
use App\Http\Requests\UpdateLeaveStatusRequest;
use App\Models\LeaveStatus;
use Illuminate\Http\Response;

class LeaveStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * @param StoreLeaveStatusRequest $request
     * @return Response
     */
    public function store(StoreLeaveStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param LeaveStatus $leaveStatus
     * @return Response
     */
    public function show(LeaveStatus $leaveStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LeaveStatus $leaveStatus
     * @return Response
     */
    public function edit(LeaveStatus $leaveStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLeaveStatusRequest $request
     * @param LeaveStatus $leaveStatus
     * @return Response
     */
    public function update(UpdateLeaveStatusRequest $request, LeaveStatus $leaveStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LeaveStatus $leaveStatus
     * @return Response
     */
    public function destroy(LeaveStatus $leaveStatus)
    {
        //
    }
}
