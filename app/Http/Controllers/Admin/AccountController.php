<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\ActivityLog;
use Validator;
use Illuminate\Support\Facades\Hash;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function staffs()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $staffs = RoleUser::where('role_id', 2)->orderBy('user_id', 'desc')->get();
        return view('admin.manage_staffs' , compact('staffs'));
    }
    public function admins()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $admins = RoleUser::where('role_id', 1)->get();
        return view('admin.manage_administrator' , compact('admins'));
    }

    public function edit(User $account){
        if (request()->ajax()) {
            return response()->json([
                'result' =>  $account,
            ]);
        }
    }

    public function store(Request $request){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'           => ['required'],
            'email'          => ['required',  'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'min:8','max:11'],
            'password'       => ['required', 'min:8'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $account = User::create([
            'name'                  => $request->input('name'),
            'email'                 => $request->input('email'),
            'contact_number'        => $request->input('contact_number'),
            'password'              => Hash::make($request->input('password')),
            'email_verified_at'     => date("Y-m-d H:i:s"),
        ]);
        RoleUser::insert([
            'user_id' => $account->id,
            'role_id' => $request->input('role'),
        ]);
    

        return response()->json(['success' => 'Successfully created.']);
    }
    
    public function update(Request $request ,User $account){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'           => ['required'],
            'email'          => ['required',  'email', 'max:255', 'unique:users,email,'.$account->id],
            'contact_number' => ['required', 'string', 'min:8','max:11'],
            'password'       => ['nullable','min:8'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $account->update([
            'name'                  => $request->input('name'),
            'email'                 => $request->input('email'),
            'contact_number'        => $request->input('contact_number'),
            'password'              => Hash::make($request->input('password')),
        ]);

       
        return response()->json(['success' => 'Successfully updated.']);
    }

    public function destroy(User $account){
        date_default_timezone_set('Asia/Manila');
       
        RoleUser::where('user_id', $account->id)->delete();
        $account->delete();
        return response()->json(['success' => 'Successfully removed.']);
    }
}
