<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveDays;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        dd("home");
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
}
