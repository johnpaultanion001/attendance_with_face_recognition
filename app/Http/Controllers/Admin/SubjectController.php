<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
  
    public function index()
    {
        $subjects = Subject::where('isRemove', false)->orderBy('subject_code', 'asc')->get();
        return view('admin.manage_subjects' , compact('subjects'));
    }
   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'subject_code'           => ['required'],
            'subject_title'           => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Subject::create([
            'subject_code'                  => $request->input('subject_code'),
            'subject_title'                 => $request->input('subject_title'),
         
        ]);
      

        return response()->json(['success' => 'Successfully created.']);
    }

    
    public function edit(Subject $subject)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' =>  $subject,
            ]);
        }
    }

    
    public function update(Request $request, Subject $subject)
    {
        $validated =  Validator::make($request->all(), [
            'subject_code'           => ['required'],
            'subject_title'           => ['required'],
            
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $subject->update([
            'subject_code'                  => $request->input('subject_code'),
            'subject_title'                 => $request->input('subject_title'),
         
        ]);
      

        return response()->json(['success' => 'Successfully updated.']);
    }

   
    public function destroy(Subject $subject)
    {
        $subject->update([
            'isRemove' => true,
        ]);
        return response()->json(['success' => 'Successfully removed.']);
    }
}
