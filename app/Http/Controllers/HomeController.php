<?php

namespace App\Http\Controllers;

use App\UserLeave;
use Carbon\Carbon;
use App\LeaveApply;
use App\LeaveBalance;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        $leave_balance = LeaveBalance::where('user_id', Auth::user()->id)->get();
        $leave_apply = LeaveApply::where('user_id', Auth::user()->id)->get();
        // return $leave_balance;
        return view('home', compact('leave_balance','leave_apply'));
    }
}
