<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeaveRequest;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Leave;
use App\Models\LeaveDays;
use App\Models\LeaveStatus;
use App\Models\LeaveType;
use App\Models\Notification;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

//        $days_sum = $this->daysCalculations(Auth::id(), $converttodate);
        return view('leaves.home')
            ->with('leaves', $leaves)
            ->with('entitled_Days', $entitled_Days);
    }
    public function index2()
    {
        $leaves = Leave::where('user_id', Auth::id())->get();
        return view('leaves.index', compact('leaves'));
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
        $leave_typeItems = LeaveType::all();
        $leave_statusItems = LeaveStatus::all();
        return view('leaves.create', compact('leave_typeItems', 'leave_statusItems'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeaveRequest $request
     * @return Response
     */
    public function store(Request $request)
    {

        $input = $request->except(['_token']);
        $input['user_id'] = Auth::user()->id;

        $year = date('Y');
        $months = array();

        $date = $input['start_date'];
        $MyDateCarbon1 = Carbon::parse($date);
        $MyDateCarbon = Carbon::parse($input['end_date']);
        $period = CarbonPeriod::create($MyDateCarbon1, $MyDateCarbon);


        $userId = Auth::id();
        $input['user_id'] = $userId;
        $leaveType = $input['leave_type'];
        $entitled_Days = LeaveDays::where('leave_type', $leaveType)->first();
        $leaveName = LeaveType::where('id', $leaveType)->first()->name;
//
        $leaveSum = $this->daysValidation($userId, $leaveType);
//
        $entitled_Days_no = $entitled_Days->Entitled_days;
        $leaveSum[$leaveType];
        $diff = $entitled_Days_no - $leaveSum[$leaveType];
//
        $start_time = new Carbon($input['start_date']);
        $start_time_ob = new  Carbon($input['end_date']);


        if ($input['start_date_time'] == 1 && $input['end_date_time'] == 1) {
            $result = null;
            if ($start_time_ob->isWeekend()) {
                $result = (($start_time->diffInWeekdays($start_time_ob, false))) ;
            } else {
                $result = ((1 + $start_time->diffInWeekdays($start_time_ob, false)) - 0.5) ;

            }
        } elseif ($input['start_date_time'] == 2 && $input['end_date_time'] == 2) {
            $result = null;
            if ($start_time_ob->isWeekend()) {
                $result = (($start_time->diffInWeekdays($start_time_ob, false)) - 0.5) ;
            } else {
                $result = ((1 + $start_time->diffInWeekdays($start_time_ob, false)) - 0.5) ;
            }
        } elseif ($input['start_date_time'] == 2 && $input['end_date_time'] == 1) {
            $result = null;
            if ($start_time_ob->isWeekend()) {
                $result = (($start_time->diffInWeekdays($start_time_ob, true)) - 0.5) ;
            } else {
                $result = (($start_time->diffInWeekdays($start_time_ob, true))) ;
            }
        } else {
            $result = null;
            if ($start_time_ob->isWeekend()) {
                $result = ($start_time->diffInWeekdays($start_time_ob, false)) ;
            } else {
                $result = (1 + $start_time->diffInWeekdays($start_time_ob, false)) ;

            }
        }
        $input['days'] = $result;

        $leaves = Leave::create($input);

        $resultDays = $leaves->days;
        if ($leaves) {

            //        create audit trail
            $data = ['user_id' => Auth::id(),
                'model_id' => $leaves->id,
                'model_type' => Leave::class,
                'action_type' => 'insert',
                'created_at' => date('Y-m-d H:m:s')
            ];

            $user_admin = User::where('email','root@admin.com')->first();

            /**
             * Create Leave notification to Admin
             *
             */
            $notificationName = Leave::class;

            Notification::createNotification($user_admin->id, $leaves->id, $notificationName, "");


    }


return redirect(route('leaves.index'));
}

/**
 * Display the specified resource.
 *
 * @param Leave $leave
 * @return Response
 */
public
function show(Leave $leave)
{
    //
}

/**
 * Show the form for editing the specified resource.
 *
 * @param Leave $leave
 * @return Response
 */
public
function edit(Leave $leave)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param \App\Http\Requests\UpdateLeaveRequest $request
 * @param Leave $leave
 * @return Response
 */
public
function update(UpdateLeaveRequest $request, Leave $leave)
{
    //
}

/**
 * Remove the specified resource from storage.
 *
 * @param Leave $leave
 * @return Response
 */
public
function destroy(Leave $leave)
{
    //
}
    public function daysValidation($user_id, $leaveType)
    {
        $entitled_days = LeaveDays::all();
        $current_year = date('Y');

        $taken_dayss = array();

        $taken_days = LeaveType::all();

        foreach ($taken_days as $days):
            switch ($leaveType) {
                case 1:
                    $compassionate_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 1)
                        ->get();
                    $cresult = array();
                    foreach ($compassionate_taken_days as $compassionate_days):
                        $start_time = new Carbon($compassionate_days->start_date);
                        $start_time_ob = new  Carbon($compassionate_days->end_date);

                        $cresult[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);

                    endforeach;
                    $taken_days['compassionate_days'] = array_sum($cresult);
                    $taken_dayss[1] = $taken_days['compassionate_days'];
                    break;
                case 2:
                    $annual_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 2)
                        ->get();
                    $result = array();
                    foreach ($annual_taken_days as $annual_days):
                        $start_time = new Carbon($annual_days->start_date);
                        $start_time_ob = new  Carbon($annual_days->end_date);

                        $result[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);
//
                    endforeach;

                    $taken_days['annual_days'] = array_sum($result);
                    $taken_dayss[2] = $taken_days['annual_days'];
                    break;
                case 3:
                    $maternity_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 3)
                        ->get();
                    $result = array();
                    foreach ($maternity_taken_days as $maternity_days):
                        $start_time = new Carbon($maternity_days->start_date);
                        $start_time_ob = new  Carbon($maternity_days->end_date);
                        $result[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);
                    endforeach;

                    $taken_days['maternity_days'] = array_sum($result);
                    $taken_dayss[3] = $taken_days['maternity_days'];
                    break;
                case 4:
                    $paternity_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 4)
                        ->get();
                    $presult = array();
                    foreach ($paternity_taken_days as $paternity_days):
                        $start_time = new Carbon($paternity_days->start_date);
                        $start_time_ob = new  Carbon($paternity_days->end_date);
                        $presult[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);
                    endforeach;
                    $taken_days['paternity_days'] = array_sum($presult);
                    $taken_dayss[4] = $taken_days['paternity_days'];
                    break;
                case 5:
                    $study_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 5)
                        ->get();
                    $sresult = array();
                    foreach ($study_taken_days as $study_days):
                        $start_time = new Carbon($study_days->start_date);
                        $start_time_ob = new  Carbon($study_days->end_date);
                        $sresult[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);
                    endforeach;
                    $taken_days['study_days'] = array_sum($sresult);
                    $taken_dayss[5] = $taken_days['study_days'];
                    break;
                case 6:
                    $sick_taken_days = Leave::where('user_id', $user_id)
                        ->whereYear('created_at', $current_year)
                        ->where('leave_status', 3)
                        ->where('leave_type', 6)
                        ->get();
                    $siresult = array();
                    foreach ($sick_taken_days as $sick_days):
                        $start_time = new Carbon($sick_days->start_date);
                        $start_time_ob = new  Carbon($sick_days->end_date);
                        $siresult[] = 1 + $start_time->diffInWeekdays($start_time_ob, false);
                    endforeach;
                    $taken_days['sick_days'] = array_sum($siresult);
                    $taken_dayss[6] = $taken_days['sick_days'];
                    break;
                case 0:
                    break;
            }
        endforeach;
        return $taken_dayss;
    }

}
