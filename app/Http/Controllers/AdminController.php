<?php

namespace App\Http\Controllers;

use App\LeaveApply;
use App\LeaveBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $leave_balance = LeaveBalance::all();
        $leave_apply = LeaveApply::latest()->get();
        return view('admin.index', compact('leave_balance','leave_apply'));
    }

    public function approve(Request $request) {
        $row = LeaveApply::where('id', $request->id)
                    ->update(['status' => 'Approved']);
        if(!$row) {
            return redirect('admin/home')->with('error', 'not approved');
        }
        return redirect('admin/home')->with('success', 'approved success');
    }

    public function reject(Request $request) {
        // return $request->id;
        
        try {
            $leave_apply = LeaveApply::where('id', $request->id)->first();
            $leave_apply->update(['status' => 'Rejected']);

            $leave_balance = LeaveBalance::where(['user_id' => $leave_apply->user_id, 'leave_type' => $leave_apply->leave_type])
            ->first();
            // return $leave_balance;
            if($leave_balance->used > 0)
                $leave_balance->decrement('used', $leave_apply->count);
            
            return redirect('admin/home')->with('success', 'Rejected success');
        } catch (QueryException $e) {
            
            return redirect('admin/home')->with('error', 'not Rejected');
        }
        
    }
}
