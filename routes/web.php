<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\singup_controller;
use App\Models\signup_model;
use App\Http\Controllers\subject_controller;
use App\Http\Controllers\login_controller;
use App\Models\subject_model;
use App\Http\Controllers\add_faculty_controller;
use App\Http\Controllers\pdf_download;
use App\Models\add_faculty_model;
use App\Http\Controllers\setsubfac_controller;
use App\Http\Controllers\services_controller;
use App\Http\Controllers\csv_download;
use App\Http\Controllers\admin_controller;
use App\Http\Controllers\temptimetablecontroller;
use App\Http\Controllers\maketimetable;
use App\Http\Controllers\ttm_generate_controller;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FacultySetController;




Route::get('/', function () {
    return view('user/home');
});

// Route::get('/index', function () {
//     return view('user/index4');
// });
Route::get('/sindex', function () {
    return view('user/student');
});

Route::get('/singup', function () {
    return view('user/singup_form');
});

Route::get('/login', function () {
    return view('user/login');
});

Route::get('/add_subject', function () {
    return view('admin/add_subject');
});
Route::get('/add_faculty', function () {
    return view('admin/add_faculty');
});

Route::get('/download_s', function () {
    return view('admin/download_subject');
});
Route::get('/addforms', function () {
    return view('admin/form');
});

Route::get('/adminlogin1', function () {
    return view('admin/adminlogin');
});
// Route::get('/admin', function () {
//     return view('admin/adminindex2');
// });
Route::get('/viewdata', function () {
    return view('admin/viewdata');
});

Route::get('/studentupdate', function () {
    return view('user/student');
});
Route::get('/datadownload', function () {
    return view('admin/downloaddata');
});

Route::get('/add_services', function () {
    return view('admin/services');
});

Route::get('/admin_r', function () {
    return view('admin/admin_reg');
});
Route::get('/upload_csv', function () {
    return view('admin/upload_csv');
});
Route::get('/csvdownload', function () {
    return view('admin/csvdownload');
});

Route::get('/openmail', function () {
    return view('admin/mail');
});
Route::get('/sendusermail', function () {
    return view('admin/user_mail');
});
Route::get('/reportlist', function () {
    return view('admin/reportlist');
});

Route::get('/upload_ttm', function () {
    return view('admin/upload_tt');
});




Route::get('/index',[login_controller::class,'index']);

Route::get('/admin',[login_controller::class,'adminindex']);

Route::post('/admin_singup',[singup_controller::class,'admin_store']);

Route::post('/student_singup',[singup_controller::class,'store']);

Route::post('/login1',[login_controller::class,'ck']);

Route::post('/filldataset',[setsubfac_controller::class,'store']);

Route::get('/logout',[login_controller::class,'logout']);

Route::post('add_subject',[subject_controller::class,'store']);

Route::post('add_faculty',[add_faculty_controller::class,'store']);

Route::get('/view_subject', [pdf_download::class, 'subjectV']);

Route::get('/download_course', [admin_controller::class, 'course']);

Route::get('/download_subject', [pdf_download::class,'subjectD']);

Route::get('/viewfaculty', [add_faculty_controller::class,'show']);

Route::get('/viewsubject', [subject_controller::class,'show']);

Route::get('/viewstudent', [singup_controller::class,'show']);

Route::post('/adminlogin',[login_controller::class,'adminlogin']);

Route::get('/updatestudent', [singup_controller::class,'getupdatedata']);

Route::post('/updatedata', [singup_controller::class,'update']);

Route::get('/setdata', [setsubfac_controller::class,'getdata']);

Route::get('/generatetimetable', [setsubfac_controller::class,'generatett']);

Route::post('/services_add', [services_controller::class,'store']);

Route::get('/view_services', [services_controller::class,'show']);

//Route::get('/updatestudent', [singup_controller::class,'getupdatedata']);

Route::get('/details/{id}/demo', [singup_controller::class, 'adminupdate'])->name('demo');

Route::post('/adminupdatestud', [singup_controller::class,'updatestud']);

Route::get('/details/{id}/deletestud', [singup_controller::class, 'studdelete'])->name('deletestud');

Route::get('/details/{id}/subupdate', [subject_controller::class, 'updatesub'])->name('subupdate');

Route::get('/details/{id}/subdelete', [subject_controller::class, 'deletesub'])->name('subdelete');

Route::post('/update_subject', [subject_controller::class,'subupdate']);

Route::post('/upload_csv_file', [csv_download::class,'csv_insert']);

Route::get('/download_csv_faculty', [csv_download::class,'exportCsv']);

Route::get('/details/{id}/facdelete', [add_faculty_controller::class, 'facdelete'])->name('facdelete');

Route::get('/details/{id}/updatefacshow', [add_faculty_controller::class, 'updatefacshow'])->name('updatefacshow');

Route::post('/updatefac', [add_faculty_controller::class, 'updatefac'])->name('updatefac');

Route::post('/sendEmail', [admin_controller::class, 'sendmail']);

Route::post('/sendusermail1', [admin_controller::class, 'sendmailuser']);

Route::get('/viewcouse', [admin_controller::class, 'viewcoursedata']);

Route::get('/details/{id}//services_delete', [services_controller::class, 'services_delete'])->name('services_delete');

Route::get('/details/{id}/services_update', [services_controller::class, 'services_update'])->name('services_update');

Route::post('services_update1', [services_controller::class, 'update']);

Route::post('/coursreportgenerate', [admin_controller::class, 'generatecourse']);
Route::post('/coursreportgenerate1', [admin_controller::class, 'generatecourse1']);

Route::get('/coursereport', [admin_controller::class, 'showcours']);

Route::get('/sortsubject', [ttm_generate_controller::class, 'generatetimetable']);

Route::match(['get', 'post'],'/pdfttm', [ttm_generate_controller::class, 'downloadttm']);

Route::post('/upload_ttm_data', [admin_controller::class, 'store']);

Route::get('/view_ttimetable', [admin_controller::class, 'viewttm']);

Route::get('/details/{id}//update_ttm', [admin_controller::class, 'update_ttm'])->name('update_ttm');

Route::get('/details/{id}/delete_ttm', [admin_controller::class, 'delete_ttm'])->name('delete_ttm');

// Report Generation Routes
Route::get('/generate_report', [ReportController::class, 'showGenerateForm'])->name('generate.report');
Route::post('/search_student', [ReportController::class, 'searchStudents'])->name('search.students');
Route::get('/generate_pdf/{id}', [ReportController::class, 'generatePDF'])->name('generate.pdf');
Route::post('/generate_combined_pdf', [ReportController::class, 'generateCombinedPDF'])->name('generate.combined.pdf');

// Faculty Sets Routes
Route::get('/view-faculty-sets', [FacultySetController::class, 'index'])->name('view.faculty.sets');
Route::put('/faculty-sets/{id}', [FacultySetController::class, 'update'])->name('faculty.sets.update');
Route::delete('/faculty-sets/{id}', [FacultySetController::class, 'destroy'])->name('faculty.sets.delete');







