<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\RequestedDocument;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class FinderResidentController extends Controller
{
    public function index(){
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $residents = Resident::where('isRemove', false)->orderBy('name' , 'asc')->first();
        return redirect('/admin/finder_resident/'.$residents->id);
    }
    public function resident_result(Resident $resident){
        $residents = Resident::where('isRemove', false)->orderBy('name' , 'asc')->get();
        $requested_documents = RequestedDocument::where('resident_id', $resident->id)->where('isRemove', 0)->latest()->get();
        $resident = Resident::where('id', $resident->id)->orderBy('name' , 'asc')->first();

        return view('admin.finder_resident', compact('resident','residents','requested_documents'));
    }
   
}
