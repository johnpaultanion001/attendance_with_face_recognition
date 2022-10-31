<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ResidentController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $residents = Resident::orderBy('name' , 'asc')->where('isRemove', false)->get();
        return view('admin.manage_residents',compact('residents'));
    }
    public function edit(Resident $resident)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' =>  $resident,
            ]);
        }
    }

    public function update(Request $request, Resident $resident)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            'contact_number' => ['required', 'min:8','unique:residents,contact_number,' . $resident->id  ],
            'birthdate' => ['required', 'date','before:today'],
            'birthplace' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $resident->update([
            'name'         => $request->input('name'),
            'address'            => $request->input('address'),
            'contact_number'     => $request->input('contact_number'),
            'birthdate'     => $request->input('birthdate'),
            'birthplace'     => $request->input('birthplace'),
            'civil_status'     => $request->input('civil_status'),
            'gender'     => $request->input('gender'),
            'isVoter'     => $request->input('isVoter'),
            'isRecord'     => $request->input('isRecord'),
            'isEmployed'     => $request->input('isEmployed'),
            'isStudent'     => $request->input('isStudent'),
            'isPWD'     => $request->input('isPWD'),
            'isSr'     => $request->input('isSr'),
        ]);
        ActivityLog::create([
            'activity'  => 'Activity: Updated Resident Record <br>
                            Resident Name: '.$resident->name.
                           '<br> User: '. auth()->user()->name,
                            
        ]);
      
        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'address' => ['required'],
            'contact_number' => ['required', 'min:8','unique:residents'],
            'birthdate' => ['required', 'date','before:today'],
            'birthplace' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $resident = Resident::create([
            'name'         => $request->input('name'),
            'address'            => $request->input('address'),
            'contact_number'     => $request->input('contact_number'),
            'birthdate'     => $request->input('birthdate'),
            'birthplace'     => $request->input('birthplace'),
            'civil_status'     => $request->input('civil_status'),
            'gender'     => $request->input('gender'),
            'isVoter'     => $request->input('isVoter'),
            'isRecord'     => $request->input('isRecord'),
            'isEmployed'     => $request->input('isEmployed'),
            'isStudent'     => $request->input('isStudent'),
            'isPWD'     => $request->input('isPWD'),
            'isSr'     => $request->input('isSr'),
        ]);
        ActivityLog::create([
            'activity'  => 'Activity: Added Resident Record <br>
                            Resident Name: '.$resident->name.
                           '<br> User: '. auth()->user()->name,
                            
        ]);
        return response()->json(['success' => 'Added Successfully.']);
    }

    public function destroy(Request $request, Resident $resident)
    {
        date_default_timezone_set('Asia/Manila');
        $resident->update([
            'isRemove' => true,
        ]);
        ActivityLog::create([
            'activity'  => 'Activity: Removed Resident Record <br>
                            Resident Name: '.$resident->name.
                           '<br> User: '. auth()->user()->name,
                            
        ]);
        return response()->json(['success' => 'Removed Successfully.']);
    }


}
