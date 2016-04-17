<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::get('/av','ScheduleController@available_schedule');
//View Applicant
//Route::get('/registrasi', 'PageController@form'); //registrasi form
//Route::post('/registrasi', 'JobVacantController@store');
//Route::post('/Cari', 'JobVacantController@store'); 
//Route::get('/Cari', 'JobVacantController@gantiNama');
//Route::get('/Cari', 'JobVacantController@regis'); //nampilin home applicant yang bisa registrasi sekalian

//Schedule
Route::get('/Schedule','ScheduleController@getListSchedule');
Route::get('/CreateInterview','ScheduleController@create_interview');
Route::get('/a','ScheduleController@info');

//Applicant
Route::get('/Applicants', 'ApplicantController@getListOfApplicant');
Route::get('/applicant/profile/{id_applicant}', 'ApplicantController@getApplicantProfile');
Route::post('/Applicants/search', 'ApplicantController@getSearch');	
Route::post('/Applicants', 'ApplicantController@getStatus');
//Route::post('uploadFile', 'ApplicantController@uploadCV');

//Av Position
Route::get('/CreateAvailablePosition', 'PageController@create'); //create available position
Route::post('/create', 'PageController@store'); //UNTUK SIMPAN AV.POSISTION
//untuk menampilkan halaman list of job vacant ketika user memilih menu Job Vacant
Route::get('/JobVacant', 'JobVacantController@getListOfJobVacant');

//untuk menampilkan halaman penjelasan dari suatu job vacant ketika user memilih salah satu job vacant
Route::get('/JobVacant/{id_job_vacant}', 'JobVacantController@showJobVacantInformation');

//Report Form
//untuk cek apakah suatu jobVacant udah punya report form atau belum
Route::get('/JobVacant/ReportForm/{id_job_vacant}', 'ReportFormController@cekApakahReportFormUdahDibuat');
//untuk menampilkan form create report form
Route::get('/JobVacant/ReportForm/CreateReportForm/{id_job_vacant}', 'ReportFormController@createReportForm');
//untuk menampikan halaman ketika report form telah exist
Route::get('/JobVacant/ReportForm/ViewReportForm/{id_report_form}', 'ReportFormController@viewReportForm');
//untuk menampilkan form update report form
Route::get('/JobVacant/ReportForm/UpdateReportForm/{id_job_vacant}', 'ReportFormController@updateReportForm');




Route::get('/','UserController@index');
Route::get('/Home','HomeController@index');

Route::group(['middleware'=>'web'],function(){
	Route::post('/dologin','UserController@login');
	Route::get('/dologout','UserController@logout');
	}

	);