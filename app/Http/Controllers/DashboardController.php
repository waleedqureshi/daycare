<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Allocation;

class DashboardController extends Controller
{
    function index(){
        return view('dashboard.dashboard');
    }

    public function occupancy(){
        $allocations = Allocation::groupBy('room_id')
                                    ->groupBy('slot_id')->select('*', DB::raw('count(*) as total'))
                                    ->get();
        return view('dashboard.occupancy', compact('allocations'));
    }
}
