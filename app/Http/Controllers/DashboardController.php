<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Allocation;
use App\Models\Room;
use App\Models\Attendance;

class DashboardController extends Controller
{
    function index(){
        return view('dashboard.dashboard');
    }

    public function occupancy(){
        // $allocations = DB::table('allocations')
        //                     ->select('*')
        //                     ->groupBy(['slot_id', 'room_id'])
        //                     ->get();

        $allocations = DB::select('
                                SELECT r.name AS "room", se.name AS "session", s.day, s.start, s.end, COUNT(c.id) AS "Occupied" 
                                FROM allocations a 
                                JOIN registers c ON c.id = a.register_id 
                                JOIN rooms r ON r.id = a.room_id 
                                JOIN slots s ON s.id = a.slot_id 
                                JOIN sessions se ON se.id = s.session_id GROUP BY s.id, r.id, session, room
                            ');        
        return view('dashboard.occupancy', compact('allocations'));
    }

    public function attendance(){
        $rooms = Room::all();
        return view('dashboard.attendance', compact('rooms'));
    }

    public function get_slots(Request $request)
    {
        $allocations = Allocation::where('room_id', $request->room_id)->get()->groupBy('slot_id');
        $content = '';

        foreach($allocations as $id => $allocation){
            $content .= '<option class="slots_dropdown" value="'.$id.'">'.$allocation[0]->slot->session->name.' - '.$allocation[0]->slot->start.' - '.$allocation[0]->slot->end.'</option>';
        }
        return \Response::json($content);
    }

    public function get_childs(Request $request)
    {
        $allocations = Allocation::where('room_id', $request->room_id)->where('slot_id', $request->slot_id)->get();
        $content = '';
        $date = Carbon::parse($request->date)->format('y-m-d');

        foreach($allocations as $serial => $allocation){
            $content .= '<tr class="child_rows">';
            $content .= '<input type="hidden" name="allocation_ids[]" value="'.$allocation->id.'">';
            $content .= '<td class="text-center">';
            $content .= $allocation->register->child_name;
            $content .= '</td>';
            $content .= '<td class="text-center">';

            $attendance = Attendance::where('allocation_id', $allocation->id)->where('date', $date)->first();

            if($attendance == null){
            $content .= '<input type="radio" id="present_'.$serial.'" name="attendance_'.$serial.'" value="Present">
                        <label for="present_'.$serial.'">Present</label><br>
                        <input type="radio" id="absent_'.$serial.'" name="attendance_'.$serial.'" value="Absent">
                        <label for="absent_'.$serial.'">Absent</label><br>';
            }
            else{
                if($attendance->attendance == 'Present'){
                $content .= '<input type="radio" id="present_'.$serial.'" name="attendance_'.$serial.'" value="Present" checked>
                        <label for="present_'.$serial.'">Present</label><br>
                        <input type="radio" id="absent_'.$serial.'" name="attendance_'.$serial.'" value="Absent">
                        <label for="absent_'.$serial.'">Absent</label><br>';
                }
                else{
                    $content .= '<input type="radio" id="present_'.$serial.'" name="attendance_'.$serial.'" value="Present">
                        <label for="present_'.$serial.'">Present</label><br>
                        <input type="radio" id="absent_'.$serial.'" name="attendance_'.$serial.'" value="Absent" checked>
                        <label for="absent_'.$serial.'">Absent</label><br>';
                }
            }

            
            $content .= '</td>';
            $content .= '</tr>';
        }
        return \Response::json($content);
    }

    public function save(Request $request){
        $date = Carbon::parse($request->date)->format('y-m-d');
        foreach($request->allocation_ids as $key => $id){
            $attendance_value = $request->input('attendance_'.$key);
            $attendance = Attendance::firstOrCreate(
                ['allocation_id' => $id, 'date' => $date],
            );
            $attendance->attendance = $attendance_value;
            $attendance->save();
        }

        return redirect('/')->with('success', 'Attendance for mentioned details has been marked');
    }
}
