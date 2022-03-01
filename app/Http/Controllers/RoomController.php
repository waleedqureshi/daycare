<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\RoomTeacher;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $rooms = Room::all();
        $teachers = Teacher::all();
        return view('dashboard.rooms.view', compact('rooms', 'teachers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rooms.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = new Room();
        $room->name = $request->name;
        $room->capacity = $request->capacity;
        $room->save();
        return redirect('room/view')->with('success','New room has been added.');
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
        $room = Room::find($id);
        return view('dashboard.rooms.edit', compact('room'));
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
        $room = Room::find($id);
        $room->name = $request->name;
        $room->capacity = $request->capacity;
        $room->save();
        return redirect('room/view')->with('success','Room has been updated.');
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
        $room = Room::find($id);
        $teachers = RoomTeacher::where('room_id', $id)->get();
        foreach($teachers as $teacher){
            $teacher->delete();
        }
        $room->delete();
        return back()->with('success','Room has been deleted');
    }

    public function assign_teacher(Request $request, $id)
    {
        $room_id = decrypt($id);
        $teachers = RoomTeacher::where('room_id', $room_id)->get();
        foreach($teachers as $teacher){
            $teacher->delete();
        }

        foreach($request->teachers as $teacher_id){
            $rt = new RoomTeacher();
            $rt->room_id = $room_id;
            $rt->teacher_id = $teacher_id;
            $rt->save();
        }
        
        return redirect('room/view')->with('success','Assigned teachers to the room have been updated.');
    }
}
