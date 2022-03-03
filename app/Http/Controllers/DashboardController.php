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
        // $allocations = Allocation::groupBy('room_id')
        //                             ->groupBy('slot_id')->select('*', DB::raw('count(register_id) as total'))
        //                             ->get();

        $allocations = DB::select('SELECT r.name AS "room", se.name AS "session", s.day, s.start, s.end, COUNT(c.id) AS "Occupied" FROM allocations a JOIN registers c ON c.id = a.register_id JOIN rooms r ON r.id = a.room_id JOIN slots s ON s.id = a.slot_id JOIN sessions se ON se.id = s.session_id GROUP BY s.id, r.id, session');
        // dd($allocations);
        return view('dashboard.occupancy', compact('allocations'));
    }
}
