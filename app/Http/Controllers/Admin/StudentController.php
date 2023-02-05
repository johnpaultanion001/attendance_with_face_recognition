<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Validator;
use App\Models\Student;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index()
    {
          $students = Student::orderBy('name' , 'asc')->where('isRemove', false)->get();
        return view('admin.manage_students',compact('students'));
    }
    public function edit(Student $student)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' =>  $student,
            ]);
        }
    }
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'age' => ['required'],
            'address' => ['required'],
            'grade' => ['required'],
            'section' => ['required'],
            'schedule' => ['required'],
            'image1' => ['required','mimes:jpg'],
            'image2' => ['required','mimes:jpg'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $folder = $request->input('name')."_".substr(time(), 4);

        $image1 = $request->file('image1');
        $image1_extension = $image1->getClientOriginalExtension(); 
        $image1_save = "1.".$image1_extension;
        $image1->move('face_recognition/labeled_images/'.$folder.'/', $image1_save);

        $image2 = $request->file('image2');
        $image2_extension = $image2->getClientOriginalExtension(); 
        $image2_save = "2.".$image2_extension;
        $image2->move('face_recognition/labeled_images/'.$folder.'/', $image2_save);
        

        Student::create([
            'user_id'         => auth()->user()->id,
            'student_folder' => $folder,
            'name'         => $request->input('name'),
            'age'         => $request->input('age'),
            'address'         => $request->input('address'),
            'grade'         => $request->input('grade'),
            'section'         => $request->input('section'),
            'schedule'         => $request->input('schedule'),
            'image1'         => $folder.'/'.$image1_save,
            'image2'         => $folder.'/'.$image2_save,
        ]);
        return response()->json(['success' => 'Added Successfully.']);
    }

    public function update_student(Request $request, Student $student)
    {
        $validated =  Validator::make($request->all(), [
            'name' => ['required'],
            'age' => ['required'],
            'address' => ['required'],
            'grade' => ['required'],
            'section' => ['required'],
            'schedule' => ['required'],
            'image1' => ['mimes:jpg'],
            'image2' => ['mimes:jpg'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $folder = $student->student_folder;

        if($request->file('image1')){
            $image1 = $request->file('image1');
            $image1_extension = $image1->getClientOriginalExtension(); 
            $image1_save = "1.".$image1_extension;
            $image1->move('face_recognition/labeled_images/'.$folder.'/', $image1_save);
        }
        if($request->file('image2')){
            $image2 = $request->file('image2');
            $image2_extension = $image2->getClientOriginalExtension(); 
            $image2_save = "2.".$image2_extension;
            $image2->move('face_recognition/labeled_images/'.$folder.'/', $image2_save);
        }
       
        $student->update([
            'user_id'         => auth()->user()->id,
            'name'         => $request->input('name'),
            'age'         => $request->input('age'),
            'address'         => $request->input('address'),
            'grade'         => $request->input('grade'),
            'section'         => $request->input('section'),
            'schedule'         => $request->input('schedule'),
        ]);

      
        return response()->json(['success' => 'Updated Successfully.']);
    }


  
}
