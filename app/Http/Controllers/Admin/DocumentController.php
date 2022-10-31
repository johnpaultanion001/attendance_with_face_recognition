<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentRequirement;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class DocumentController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documents = Document::orderBy('name', 'asc')->get();
        return view('admin.manage_documents', compact('documents'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'           => ['required'],
            'amount'           => ['required', 'numeric', 'min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $document = Document::create([
            'name'                   => $request->input('name'),
            'amount'                 => $request->input('amount'),
            'isAvailable'                 => $request->input('isAvailable'),
        ]);

        foreach($request->input('requirement') as $requirement )
        {
            DocumentRequirement::updateOrCreate(
                [
                    'document_id'            => $document->id,
                    'name'                   => $requirement,
                ],
                [
                    'document_id'            => $document->id,
                    'name'                   => $requirement,
                ]
            );
        }

        ActivityLog::create([
            'activity'  => 'Activity: Create newly document <br>
                            Document Name: '.$document->name.
                            '<br> User: '. auth()->user()->name,
        ]);

        return response()->json(['success' => 'Successfully created.']);
    }

   
    public function show(Document $document)
    {
        //
    }

   
    public function edit(Document $document)
    {
        foreach($document->requirements()->get() as $requirement){
            $requirements[] = array(
                'name'        => $requirement->name, 
            );
        }

        return response()->json([
            'result' =>  $document,
            'requirements'  => $requirements,
        ]);
        
    }

   
    public function update(Request $request, Document $document)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'           => ['required'],
            'amount'           => ['required', 'numeric', 'min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $document->update([
            'name'                   => $request->input('name'),
            'amount'                 => $request->input('amount'),
            'isAvailable'            => $request->input('isAvailable'),
        ]);

        DocumentRequirement::where('document_id', $document->id)
                    ->whereNotIn('name', $request->input('requirement'))
                    ->delete();
        foreach($request->input('requirement') as $requirement )
        {
            DocumentRequirement::updateOrCreate(
                [
                    'document_id'            => $document->id,
                    'name'                   => $requirement,
                ],
                [
                    'document_id'            => $document->id,
                    'name'                   => $requirement,
                ]
            );
        }
        ActivityLog::create([
            'activity'  => 'Activity: Updated document <br>
                            Document Name: '.$document->name.
                            '<br> User: '. auth()->user()->name,
        ]);

        return response()->json(['success' => 'Successfully updated.']);


    }

   
    public function destroy(Document $document)
    {
        //
    }
}
