<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Student;
use App\Models\SubjectTeacherStudent;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AssignController extends Controller
{
    public function assign(User $teacher)
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subjects = Subject::where('isRemove', false)->orderBy('subject_code', 'asc')->get();
        $students = Student::where('isRemove', false)->orderBy('name', 'asc')->get();
        
        return view('admin.assign' , compact('teacher','subjects','students'));
    }

    public function edit(SubjectTeacherStudent $id)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' =>  $id,
            ]);
        }
    }

    public function store_update(Request $request)
    {
    
        SubjectTeacherStudent::updateOrCreate(
            [
                'student_id'                   => $request->input('student_id'),
                'subject_id'                   => $request->input('subject_id'),
                'teacher_id'                   => $request->input('teacher_id'),
            ],
            [
                'student_id'                   => $request->input('student_id'),
                'subject_id'                   => $request->input('subject_id'),
                'teacher_id'                   => $request->input('teacher_id'),
            ]
        );

        return response()->json(['success' => 'Successfully updated.']);
    }

    public function destroy(SubjectTeacherStudent $id){
       
        $id->delete();
        return response()->json(['success' => 'Successfully removed.']);
    }
    
    
}
