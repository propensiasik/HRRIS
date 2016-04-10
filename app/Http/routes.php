<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::get('/', function () { return view('welcome'); }   );
Route::get('/Tai','HomeController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//ROUTER DINI
Route::get('/registrasi', 'JobvacantController@form'); //registrasi form
Route::post('registrasi', 'JobvacantController@store');
//Route::post('registrasi', 'JobvacantController@reg');
Route::get('create', 'PageController@create'); //create available position
Route::post('create', 'PageController@store'); //UNTUK SIMPAN AV.POSISTION

//Route::get('/applicant', 'ApplicantController@show'); //view list applicant
//Route::get('about/create', 'PageController@form'); //untuk membuat job baru
Route::post('jobvacant', 'JobvacantController@store'); 

Route::get('jobvacant', 'JobvacantController@reg');

Route::get('jobvacant', 'JobvacantController@regis'); //nampilin home applicant yang bisa registrasi sekalian

Route::get('create/jobvacant' , 'JobvacantController@form'); //ngeliat jobvacant

Route::get('interviewSchedule', 'ScheduleController@getListSchedule'); //untuk ambil schedule

// ROUTER FERRI 
Route::get('/applicant', 'ApplicantController@getListOfApplicant');
Route::get('/applicant/profile/{id_applicant}', 'ApplicantController@getApplicantProfile');


//ROUTER KHALILA
//untuk menampilkan halaman list of job vacant ketika user memilih menu Job Vacant
Route::get('/JobVacant', 'JobVacantController@getListOfJobVacant');

//untuk menampilkan halaman penjelasan dari suatu job vacant ketika user memilih salah satu job vacant
Route::get('/JobVacant/{id_job_vacant}', 'JobVacantController@showJobVacantInformation');

//untuk cek apakah suatu jobVacant udah punya report form atau belum
Route::get('/JobVacant/ReportForm/{id_job_vacant}', 'ReportFormController@cekApakahReportFormUdahDibuat');

//untuk menampilkan form create report form
Route::get('/JobVacant/ReportForm/CreateReportForm/{id_job_vacant}', 'ReportFormController@openReportForm');

//untuk menampikan halaman ketika report form telah exist
Route::get('/JobVacant/ReportForm/ViewReportForm/{id_report_form}', 'ReportFormController@viewReportForm');


Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });


});
