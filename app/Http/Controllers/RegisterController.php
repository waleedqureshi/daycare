<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Room;
use App\Models\RoomTeacher;
use App\Models\Register;
use App\Models\Attendance;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $registers = Register::all();
        return view('dashboard.registers.view', compact('registers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.registers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $register = new Register();

        $register->child_name = $request->child_name;
        $register->child_date_of_birth = $request->child_date_of_birth;
        $register->child_sex = $request->child_sex;
        $register->child_address = $request->child_address;
        $register->child_postcode = $request->child_postcode;
        $register->child_homephone = $request->child_homephone;
        $register->child_school = $request->child_school;
        $register->child_year = $request->child_year;
        $register->child_start_date = $request->child_start_date;
        $register->child_group = $request->child_group;

        $register->family1_name = $request->family1_name;
        $register->family1_relation = $request->family1_relation;
        $register->family1_occupation = $request->family1_occupation;
        $register->family1_employer = $request->family1_employer;
        $register->family1_work_phone = $request->family1_work_phone;
        $register->family1_mobile_phone = $request->family1_mobile_phone;
        $register->family1_email = $request->family1_email;
        $register->family1_postcode = $request->family1_postcode;
        $register->family1_address = $request->family1_address;

        $register->family2_name = $request->family2_name;
        $register->family2_relation = $request->family2_relation;
        $register->family2_occupation = $request->family2_occupation;
        $register->family2_employer = $request->family2_employer;
        $register->family2_work_phone = $request->family2_work_phone;
        $register->family2_mobile_phone = $request->family2_mobile_phone;
        $register->family2_email = $request->family2_email;
        $register->family2_postcode = $request->family2_postcode;
        $register->family2_address = $request->family2_address;

        $register->provider_name = $request->provider_name;
        $register->provider_email = $request->provider_email;
        $register->provider_registration_no = $request->provider_registration_no;
        $register->provider_address = $request->provider_address;
        $register->provider_telephone = $request->provider_telephone;
        $register->provider_emergency_tel_no = $request->provider_emergency_tel_no;

        $register->emergency_name = $request->emergency_name;
        $register->emergency_contact = $request->name;
        $register->emergency_relation = $request->emergency_relation;

        $register->other_allergy = $request->other_allergy;
        $register->other_allergy_details = $request->other_allergy_details;
        $register->other_condition = $request->other_condition;
        $register->other_condition_details = $request->other_condition_details;
        $register->other_vaccination = $request->other_vaccination;
        $register->other_vaccination_details = $request->other_vaccination_details;
        $register->other_name = $request->other_name;
        $register->other_tel = $request->other_tel;
        $register->other_address = $request->other_address;

        $register->date = $request->date;
        $register->registration_no = $request->registration_no;

        if($request->file('signature')){
            $file = $request->file('signature');
            $filename = time() . '.' . $request->file('signature')->extension();
            $filePath = public_path().'/files/uploads/signature/';
            $file->move($filePath, $filename);
            $doc_path = '/files/uploads/signature/'.$filename;

            $register->signature = $doc_path;
        }

        $register->save();
        return redirect('register/view')->with('success','New register has been added.');
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
        $register = Register::find($id);
        return view('dashboard.registers.edit', compact('register'));
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
        $register = Register::find($id);

        $register->child_name = $request->child_name;
        $register->child_date_of_birth = $request->child_date_of_birth;
        $register->child_sex = $request->child_sex;
        $register->child_address = $request->child_address;
        $register->child_postcode = $request->child_postcode;
        $register->child_homephone = $request->child_homephone;
        $register->child_school = $request->child_school;
        $register->child_year = $request->child_year;
        $register->child_start_date = $request->child_start_date;
        $register->child_group = $request->child_group;

        $register->family1_name = $request->family1_name;
        $register->family1_relation = $request->family1_relation;
        $register->family1_occupation = $request->family1_occupation;
        $register->family1_employer = $request->family1_employer;
        $register->family1_work_phone = $request->family1_work_phone;
        $register->family1_mobile_phone = $request->family1_mobile_phone;
        $register->family1_email = $request->family1_email;
        $register->family1_postcode = $request->family1_postcode;
        $register->family1_address = $request->family1_address;

        $register->family2_name = $request->family2_name;
        $register->family2_relation = $request->family2_relation;
        $register->family2_occupation = $request->family2_occupation;
        $register->family2_employer = $request->family2_employer;
        $register->family2_work_phone = $request->family2_work_phone;
        $register->family2_mobile_phone = $request->family2_mobile_phone;
        $register->family2_email = $request->family2_email;
        $register->family2_postcode = $request->family2_postcode;
        $register->family2_address = $request->family2_address;

        $register->provider_name = $request->provider_name;
        $register->provider_email = $request->provider_email;
        $register->provider_registration_no = $request->provider_registration_no;
        $register->provider_address = $request->provider_address;
        $register->provider_telephone = $request->provider_telephone;
        $register->provider_emergency_tel_no = $request->provider_emergency_tel_no;

        $register->emergency_name = $request->emergency_name;
        $register->emergency_contact = $request->name;
        $register->emergency_relation = $request->emergency_relation;

        $register->other_allergy = $request->other_allergy;
        $register->other_allergy_details = $request->other_allergy_details;
        $register->other_condition = $request->other_condition;
        $register->other_condition_details = $request->other_condition_details;
        $register->other_vaccination = $request->other_vaccination;
        $register->other_vaccination_details = $request->other_vaccination_details;
        $register->other_name = $request->other_name;
        $register->other_tel = $request->other_tel;
        $register->other_address = $request->other_address;

        $register->date = $request->date;
        $register->registration_no = $request->registration_no;

        if($request->file('signature')){
            if($register->signature != null){
                $destinationPath = public_path().($register->signature);
                File::delete($destinationPath);
            }  
            $file = $request->file('signature');
            $filename = time() . '.' . $request->file('signature')->extension();
            $filePath = public_path().'/files/uploads/signature/';
            $file->move($filePath, $filename);
            $doc_path = '/files/uploads/signature/'.$filename;

            $register->signature = $doc_path;
        }

        $register->save();
        return redirect('register/view')->with('success','Register has been updated.');
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
        $register = Register::find($id);

        if($register->signature != null){
            $destinationPath = public_path().($register->signature);
            File::delete($destinationPath);
        }  

        $register->delete();
        return redirect('register/view')->with('success','Register has been deleted.');
    }

    public function attendance($id)
    {
        $id = decrypt($id);
        $register = Register::find($id);
        $allocations = $register->allocations->pluck('id');
        $attendances = Attendance::whereIn('allocation_id', $allocations)->orderBy('date')->get();
        // dd($attendances);
        return view('dashboard.registers.attendance', compact('attendances'));
    }
}
