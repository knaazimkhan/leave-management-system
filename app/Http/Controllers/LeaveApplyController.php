<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\LeaveApply;
use App\LeaveBalance;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveApplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('leave.index');
    }

    public function store(Request $request)
    {
        
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        
        $period = CarbonPeriod::create($start_date, '1 days', $end_date);
        $leave_count = 0;

        foreach ($period as $key => $date) {
            if (!$date->isSaturday() and !$date->isSunday()){
                $leave_count++;
            }
        }
        $user = Auth::user();
        $leave_balance = LeaveBalance::where(['user_id' => $user->id, 'leave_type' => $request->leave_type])
            ->first();
        
        if ($leave_balance->leave_type == $request->leave_type and $leave_count <= $leave_balance->left) {
            LeaveApply::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'leave_type' => $request->leave_type,
                'status' => 'Pending',
                'description' => $request->description,
                'count' =>  $leave_count,
            
            ]);
            $leave_balance->increment('used', $leave_count);
            return redirect()->route('home')->with('success', 'ur leave applied sucessfully');
        } else {
            return redirect()->back()->with('error', 'u can not apply');
        }
    }
}
