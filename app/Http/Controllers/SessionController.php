<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\RoomTeacher;
use App\Models\Register;
use App\Models\Session;
use App\Models\Slot;
use App\Models\Allocation;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $sessions = Session::all();
        return view('dashboard.sessions.view', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sessions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = new Session();
        $session->name = $request->name;
        $session->save();
        return redirect('/slot/view/'.encrypt($session->id))->with('success','New session has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $session = Session::find($id);
        return view('dashboard.sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $session = Session::find($id);
        $session->name = $request->name;
        $session->save();
        return redirect('session/view')->with('success','Session has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $session = Session::find($id);
        $slots = $session->slots;
        foreach($slots as $slots){
            $slots->delete();
        }
        $session->delete();
        return back()->with('success','Session has been deleted');
    }

    public function allocate($id){
        $id = decrypt($id);
        $register = Register::find($id);
        $sessions = Session::all();
        $rooms = Room::all();

        $allocated_room = '';
        $allocated_session = '';
        $allocated_session_id = '';
        $allocation_slots = [];
        $slots = Slot::where('id', 0)->get();
        
        $allocation = Allocation::where('register_id', $register->id)->first();
        if($allocation != null){
            $allocated_room = $allocation->room_id;
            $allocated_session = $allocation->slot->session;
            $allocated_session_id = $allocation->slot->session->id;
            $allocation_slots = Allocation::where('register_id', $register->id)->get()->pluck('slot_id')->toArray();
            $slots = Session::find($allocated_session_id)->slots->groupBy('day');
        }
        

        return view ('dashboard.registers.allocate.add', compact('register', 'sessions', 'rooms', 'slots', 'allocated_room', 'allocated_session', 'allocation_slots', 'allocated_session_id' ));
    }

    public function allocate_store(Request $request)
    {

        $existing_allocations = Allocation::where('register_id', $request->register_id)->get();

        foreach($existing_allocations as $allocation){
            $allocation->delete();
        }
        foreach($request->slot as $index => $slot){
            if($slot != null){
                $allocate = new Allocation();
                $allocate->register_id = $request->register_id;
                $allocate->room_id = $request->room;
                $allocate->slot_id = $slot;
                $allocate->save();
            }
        }
        return redirect('register/view')->with('success','Individual has been allocated room and session.');
    }

    public function update_slots(Request $request)
    {
        if (Session::find($request->session_id)->exists()) {
            $slots = Session::find($request->session_id)->slots->groupBy('day');
            $content = '';

            foreach($slots as $day => $slot){
                $content .= '<tr class="slots_rows">';
                $content .= '  <td class="text-center">'. $day .'</td>';
                $content .= '  <td class="text-center">';
                $content .= '    <div class="form-group">';
                $content .= '      <select class="js-example-basic-single w-100" name="slot[]">';
                $content .= '        <option selected value="">Select</option>';
                foreach($slots[$day] as $slot_slots){
                    $content .= '          <option value="'.$slot_slots->id.'">'.$slot_slots->start.' - '.$slot_slots->end.'</option>';
                }
                $content .= '      </select>';
                $content .= '    </div>';
                $content .= '  </td>';
                $content .= '</tr>';
            }
            return \Response::json($content);
        }
        else{
            return \Response::json(array("error" => "not found"));
        }
    }
}
