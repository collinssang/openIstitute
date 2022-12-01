<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Leave;
use App\Models\LeaveDays;
use App\Models\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $leaves = Leave::where('user_id', Auth::id())->get();
        $entitled_Days = LeaveDays::where('leave_type', 2)->first();

        $year = date('Y');
        $months = array();
        $converttodate = array();

        $days_sum = $this->daysCalculations(Auth::id(), $converttodate);

        return view('leaves.home')
            ->with('leaves', $leaves)
            ->with('days_sum', $days_sum)
            ->with('entitled_Days', $entitled_Days);
    }
    public function leavesNotice(LeaveDataTable $leaveDataTable)
    {

        $notice = Notification::where('recipient_id', Auth::id())->where('model_name', Leave::class)->where('status', '0')->count();
        if ($notice > 0) {
            return $leaveDataTable->with('slug', 'leaves')->render('leaves.index');
        } else {
            return redirect(url('/leaves_lists'));
        }
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
     * @param  \App\Http\Requests\StoreLeaveRequest  $request
     * @return Response
     */
    public function store(StoreLeaveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeaveRequest  $request
     * @param  \App\Models\Leave  $leave
     * @return Response
     */
    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
}
