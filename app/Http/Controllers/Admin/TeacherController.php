<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class TeacherController extends Controller
{
   
    public function students()
    {
        $subjects = Subject::where('isRemove', false)->orderBy('subject_code', 'asc')->get();
        return view('teacher.students', compact('subjects') );
    }

}
