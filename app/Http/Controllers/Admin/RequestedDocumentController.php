<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestedDocument;
use Validator;
use File;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
use Gate;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ActivityLog;
use App\Models\Resident;
use App\Models\Document;



class RequestedDocumentController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $resident = Resident::where('isRemove', false)->orderBy('name' , 'asc')->first();
        $document = Document::where('isAvailable', true)->orderBy('name' , 'asc')->first();
        return redirect('/admin/request_document/'.$resident->id.'/'.$document->id.'/request');
    }
    public function index_request(Resident $resident, Document $document, $request_id)
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request = RequestedDocument::where('id', $request_id)->first();
        $residents = Resident::where('isRemove', false)->orderBy('name' , 'asc')->get();
        $documents = Document::where('isAvailable', true)->orderBy('name' , 'asc')->get();
        return view('admin.request_document.request_document',compact('resident','document','request','residents','documents'));
    }
    public function resident_info(Resident $resident)
    {
        return view('admin.request_document.resident_info',compact('resident'));
    }
    public function document_info(Document $document)
    {
        return view('admin.request_document.document_info',compact('document'));
    }
    

    public function requesting_document(Request $request){
        date_default_timezone_set('Asia/Manila');
        $request_id = $request->input('request_id');
        if($request_id == 'request'){
            $request = RequestedDocument::create([
                'user_id'       =>  auth()->user()->id,
                'request_number'    =>  'BRGY'.substr(time(), 4).$request->input('resident_id'),
                'resident_id'       =>  $request->input('resident_id'),
                'document_id'       =>  $request->input('document_id'),
                'amount_to_pay'     => $request->input('amount_to_pay'),
                'claiming_date'     =>  $request->input('claiming_date'),
                'remarks'           =>  $request->input('remarks'),
            ]);

            ActivityLog::create([
                'activity'  => 'Activity: Requested Document<br>
                                Request Number: '.$request->request_number.
                               '<br> User: '. auth()->user()->name,
            ]);

            return response()->json(['success' => 'Document has been successfully requested.']);
        }else{
            RequestedDocument::where('id', $request_id)->update([
                'user_id'       =>  auth()->user()->id,
                'resident_id'       =>  $request->input('resident_id'),
                'document_id'       =>  $request->input('document_id'),
                'amount_to_pay'     => $request->input('amount_to_pay'),
                'claiming_date'     =>  $request->input('claiming_date'),
                'remarks'           =>  $request->input('remarks'),
            ]);
            $request1 = RequestedDocument::where('id', $request_id)->first();

            ActivityLog::create([
                'activity'  => 'Activity: Updated Requested Document<br>
                                Request Number: '.$request1->request_number.
                               '<br> User: '. auth()->user()->name,
            ]);
            return response()->json(['success' => 'Document has been successfully updated.']);
        }
      
        

    }

    public function requested_document()
    {
        abort_if(Gate::denies('teacher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documents = RequestedDocument::where('isRemove', false)->latest()->get();
        return view('admin.manage_requested_documents',compact('documents'));
    }
    
}
