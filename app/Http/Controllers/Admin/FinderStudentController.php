<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class FinderStudentController extends Controller
{
    public function index(){
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $students = Student::where('isRemove', false)->orderBy('name' , 'asc')->first();
        return redirect('/admin/finder_student/'.$students->id);
    }
    public function student_result(Student $student){
        $students = Student::where('isRemove', false)->orderBy('name' , 'asc')->get();
        $attendances = Attendance::where('student_id', $student->id)->latest()->get();

        return view('admin.finder_student', compact('student','students','attendances'));
    }
   
}
