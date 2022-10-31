<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\RequestedDocument;
use App\Models\Resident;
use App\Models\RoleUser;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class DashboardController extends Controller
{
    public function face()
    {

        return view('face_recognition');
    }

    public function index()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documents = Document::where('isAvailable', true)->orderBy('name', 'asc')->get();
        $requests_total =  RequestedDocument::get();
        $requests =  RequestedDocument::latest()->paginate(5);
        $residents = Resident::orderBy('name','asc')->where('isRemove', false)->get();
        $staffs = RoleUser::where('role_id', 2)->orderBy('user_id', 'desc')->get();

        return view('admin.dashboard' , compact('documents','requests','residents','staffs','requests_total'));
    }
}
