<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});
Route::get('face', 'Admin\DashboardController@face')->name('face');

Route::redirect('/', '/admin/dashboard');


Auth::routes(['verify' => true]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Finder Resident
    Route::get('finder_resident', 'FinderResidentController@index')->name('finder_resident.index');
    // Finder Resident
    Route::get('finder_resident/{resident}', 'FinderResidentController@resident_result')->name('finder_resident.resident_result');
    
    //Mange Resident
    Route::resource('residents', 'ResidentController');

    //Mange Student
    Route::resource('students', 'StudentController');
    Route::post('students/{student}', 'StudentController@update_student')->name('students.update_student');

   
    //Request Document
    Route::get('request_document', 'RequestedDocumentController@index')->name('request_document.index');
    Route::get('request_document/{resident}/{document}/{request_id}', 'RequestedDocumentController@index_request')->name('request_document.index_request');
    Route::get('resident_info/{resident}', 'RequestedDocumentController@resident_info')->name('request_document.resident_info');
    Route::get('document_info/{document}', 'RequestedDocumentController@document_info')->name('request_document.document_info');
    //CREATE AND UPDATE
    Route::get('requesting_document', 'RequestedDocumentController@requesting_document')->name('request_document.requesting_document');
   
     //Requested Document
     Route::get('requested_document', 'RequestedDocumentController@requested_document')->name('requested_document.index');
   
    //Documents
    Route::resource('documents', 'DocumentController');

    //Accounts
    Route::get('staffs', 'AccountController@staffs')->name('account.staffs');
    Route::get('admins', 'AccountController@admins')->name('account.admins');
    
    Route::post('account/store', 'AccountController@store')->name('account.store');
    Route::get('account/{account}/edit', 'AccountController@edit')->name('account.edit');
    Route::put('account/{account}', 'AccountController@update')->name('account.update');
    Route::delete('account/{account}', 'AccountController@destroy')->name('account.destroy');
    
    //Activity Logs
    Route::get('activity_logs', 'ActivityLogController@index')->name('logs.index');
    
});
