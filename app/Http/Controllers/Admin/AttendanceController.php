<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        
        $students_data = Student::where('isRemove', false)->latest()->get();
        $student_data = [];

        foreach($students_data as $data) {
            $student_data[] = $data->student_folder;
        }

        $students = json_encode($student_data);


        return view('admin.manage_attendance.index', compact('students'));
    }

    public function attendances(){
        $attendances_record = Attendance::latest()->where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();

        foreach($attendances_record as $attendance){
            $attendances_data[] = array(
                'id'        => $attendance->id, 
                'image'          => '/face_recognition/labeled_images/'.$attendance->student->image1,
                'student'        => $attendance->student->name ?? '', 
                'attendance_by'        => $attendance->user->name ?? '', 
                'date_time'        => $attendance->created_at->format('M j , Y h:i A'), 
            );
        }

        return response()->json([
            'attendances'  => $attendances_data  ?? '',
        ]);
    }

    public function store(Request $request){
        $student_folder = $request->get('student_folder');

        $student = Student::where('student_folder',$student_folder)->first();
        $isAttendance = Attendance::where('student_id',$student->id)
        ->where('user_id',auth()->user()->id)->whereDate('created_at', Carbon::today())->first();

        if($isAttendance == null){
            Attendance::create(
                [
                    'student_id'         => $student->id,
                    'user_id'            => auth()->user()->id
                ]   
            );
            return response()->json(['success' => 'Successfully attended.']);
        }else{
            return response()->json(['student_attendent' => 'This student is already attended']);
        }
    }

    public function destroy(Attendance $attendance){
        $attendance->delete();
        return response()->json(['success' => 'Successfully remove.']);
        
    }


    public function attendance_records($filter){
        $users = User::latest()->get();
        $students = Student::where('isRemove', false)->orderBy('name' , 'asc')->get();
        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $attendances = Attendance::latest()->whereDate('created_at', Carbon::today())->get();
                                
        }
        elseif($filter == 'weekly'){
            $title_filter  = 'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
            $attendances = Attendance::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }
        elseif($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $attendances = Attendance::latest()->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
        }
        elseif($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $attendances = Attendance::latest()->whereYear('created_at', '=', date('Y'))->get();
        }
        elseif($filter == 'all'){
            $title_filter  = 'ALL RECORDS';
            $attendances = Attendance::latest()->get();
        }else{
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $attendances = Attendance::latest()->whereDate('created_at', Carbon::today())->get();
        }

        return view('admin.attendance_records', compact('users','students','attendances','title_filter'));
    }
}
