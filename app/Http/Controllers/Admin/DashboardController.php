<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\RoleUser;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        
        $students = Student::orderBy('name','asc')->where('isRemove', false)->get();
        $teachers = RoleUser::where('role_id', 2)->orderBy('user_id', 'desc')->get();
        $attendances = Attendance::latest()->whereDate('created_at', Carbon::today())->get();


        return view('admin.dashboard' , compact('students','teachers','attendances'));
    }
}
