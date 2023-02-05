<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});


Route::redirect('/', '/admin/dashboard');


Auth::routes(['verify' => true]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Finder student
    Route::get('finder_student', 'FinderStudentController@index')->name('finder_student.index');
    // Finder student
    Route::get('finder_student/{student}', 'FinderStudentController@student_result')->name('finder_student.student_result');
    
   

    //Mange Student
    Route::resource('students', 'StudentController');
    Route::post('students/{student}', 'StudentController@update_student')->name('students.update_student');

    //Manage Attendance
    Route::resource('attendance', 'AttendanceController');
    Route::get('attendances', 'AttendanceController@attendances')->name('attendances.attendances');
    
    //ATTENDANCE RECORDS
    Route::get('attendance_records/{filter}', 'AttendanceController@attendance_records')->name('attendance_records');


    //Accounts
    Route::get('staffs', 'AccountController@staffs')->name('account.staffs');
    Route::get('admins', 'AccountController@admins')->name('account.admins');
    
    Route::post('account/store', 'AccountController@store')->name('account.store');
    Route::get('account/{account}/edit', 'AccountController@edit')->name('account.edit');
    Route::put('account/{account}', 'AccountController@update')->name('account.update');
    Route::delete('account/{account}', 'AccountController@destroy')->name('account.destroy');


    Route::get('staffs/assign/{teacher}', 'AssignController@assign')->name('teacher.assign');
    Route::get('staffs/assign', 'AssignController@store_update')->name('teacher.store_update');
    Route::get('staffs/assign/{id}/edit', 'AssignController@edit')->name('teacher.edit');
    Route::delete('staffs/assign/{id}/delete', 'AssignController@destroy')->name('teacher.destroy');


    Route::get('teacher/students', 'TeacherController@students')->name('teacher.students');

    //Manage SUBJECT
    Route::resource('subjects', 'SubjectController');
    
    
});
