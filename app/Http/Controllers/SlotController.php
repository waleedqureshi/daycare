<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\RoomTeacher;
use App\Models\Session;
use App\Models\Slot;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $id = decrypt($id);
        $session = Session::find($id);
        $slots = $session->slots;
        return view('dashboard.slots.add', compact('session', 'slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slot = new Slot();
        $slot->day = $request->day;
        $slot->start = $request->start;
        $slot->end = $request->end;
        $slot->session_id = $request->session_id;
        $slot->save();
        return back()->with('success','New slot has been added.');
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
        $slot = Slot::find($id);
        return view('dashboard.slots.edit', compact('slot'));
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
        $slot = Slot::find($id);
        $slot->day = $request->day;
        $slot->start = $request->start;
        $slot->end = $request->end;
        $slot->save();
        return redirect('slot/view/'.encrypt($slot->session->id))->with('success','Slot has been updated.');
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
        $slot = Slot::find($id);
        $slot->delete();
        return back()->with('success','Slot has been deleted');
    }
}
