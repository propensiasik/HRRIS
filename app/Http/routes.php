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

//Schedule
Route::get('/Schedule','ScheduleController@getListSchedule');
Route::get('/CreateInterview','ScheduleController@create_interview');
Route::get('/CreateInterview/{id_job_vacant}-{interviewKe}','ScheduleController@getInfo');
Route::get('/SetApplicant/{id_applicant}-{id_job_vacant}-{interviewKe}','ScheduleController@setApplicant');
Route::get('/SetApplicant/SaveNewInterview/{id_av_schedule}-{type}-{id_applicant}-{id_job_vacant}-{interviewKe}','ScheduleController@saveNewInterview');
Route::get('/a','ScheduleController@info');
Route::get('/b','ScheduleController@getApplicant');

//Applicant
Route::get('/Applicants/', 'ApplicantController@getListOfApplicant'); // list applicant
Route::post('/applicants/choose', 'ApplicantController@getListOfApplicantChoosen'); // list applicant choose
Route::post('/applicants/choose/select', 'ApplicantController@choose'); // submit applicant choose
Route::post('/Applicants/search', 'ApplicantController@getSearch');	 // search
Route::get('/applicant/profile/{id_applicant}', 'ApplicantController@getApplicantProfile'); // profile + status
Route::post('/Applicants', 'ApplicantController@getStatus');  // <=== ini keknya ga ke pake
Route::post('/applicant/profile/{id_applicant}', 'ApplicantController@process');
Route::get('/applicant/profile/report/{id_applicant}', 'ApplicantController@getReport'); // Report
Route::get('/applicant/profile/cv/{id_applicant}', 'ApplicantController@getCV'); // CV
Route::get('/applicant/profile/portofolio/{id_applicant}', 'ApplicantController@getPortofolio'); // Portofolio

//Av Position
Route::get('/CreateAvailablePosition', 'JobVacantController@create'); //create available position
Route::post('/CreateAvailablePosition', 'JobVacantController@process'); //UNTUK SIMPAN AV.POSISTION
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