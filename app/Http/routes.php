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

//Av Position
//untuk menampilkan halaman list of job vacant ketika user memilih menu Job Vacant
Route::get('/JobVacant', 'JobVacantController@getListOfJobVacant');
//untuk menampilkan halaman penjelasan dari suatu job vacant ketika user memilih salah satu job vacant
Route::get('/JobVacant/{id_job_vacant}', 'JobVacantController@showJobVacantInformation');
//untuk menampilkan list available position yang bisa di apply oleh applicant

//Applicant Job Vacant
Route::get('/career', 'JobVacantController@showAvailablePosition');
Route::post('/applicant/registration', 'ApplicantController@showRegistrationForm');
//untuk menyimpan isian form dari applicant
Route::post('/applicant/Registration/Save', 'ApplicantController@storeApplicant');




Route::get('/','UserController@index');
Route::get('/login','UserController@index')->name('login');
Route::get('/Home','HomeController@index');

Route::group(['middleware'=>'auth'],function(){
	//Schedule
	Route::get('/Schedule','ScheduleController@getListSchedule');


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
	Route::post('/Applicants', 'ApplicantController@filter'); //Filtering
	//untuk menampilkan form registrasi applicant
	//Statistic
	Route::get('/Statistic','StatisticController@statistic');
});

Route::group(['middleware'=>'hr'],function(){
	//Create Update Interview
	Route::get('/CreateInterview','ScheduleController@create_interview');
	Route::get('/CreateInterview/{id_job_vacant}-{interviewKe}','ScheduleController@getInfo');
	Route::get('/SetApplicant/{id_applicant}-{id_job_vacant}-{interviewKe}','ScheduleController@setApplicant');
	Route::get('/SetApplicant/SaveNewInterview/{id_av_schedule}-{type}-{id_applicant}-{id_job_vacant}-{interviewKe}','ScheduleController@createInterview');
	Route::get('/UpdateInterview','ScheduleController@update_interview');
	Route::get('/UpdateInterview/{id_job_vacant}-{interviewKe}','ScheduleController@updateInfo');
	Route::get('/ChangeInterview/{id_applicant}-{id_job_vacant}-{interviewKe}','ScheduleController@setUpdate');
	Route::get('/ChangeInterview/Change/{id_av_schedule}-{type}-{id_applicant}-{id_job_vacant}-{interviewKe}-{jadwal_lama}','ScheduleController@saveChanges');

	//Create Update Available Position
	//untuk memproses perubahan pada update available position information
	Route::post('/AvailablePosition/Update', 'JobVacantController@storeUpdateJobVacantInformation');
//untuk menampilkan form create job vacant
	Route::get('/CreateAvailablePosition', 'JobVacantController@showCreateJobVacantForm');
//untuk menyimpan jobvacant yang baru dibuat
	Route::post('/CreateAvailablePosition/Save', 'JobVacantController@saveCreatedJobVacant');
//untuk menampilkan form update job vacant
	Route::get('/UpdateAvailablePosition/{id_job_vacant}', 'JobVacantController@showUpdateJobVacantForm');
//untuk menyimpan jobvacant yang baru diupdate
	Route::post('/UpdateAvailablePosition/Save', 'JobVacantController@saveUpdatedJobVacant');
	//Assessment Form
//untuk cek apakah suatu jobVacant udah punya report form atau belum
	Route::get('/JobVacant/ReportForm/{id_job_vacant}', 'ReportFormController@cekApakahReportFormUdahDibuat');
//untuk menampilkan form create report form
	Route::get('/JobVacant/ReportForm/CreateReportForm/{id_job_vacant}', 'ReportFormController@createReportForm');
//untuk menampikan halaman ketika report form telah exist
	Route::get('/JobVacant/ReportForm/ViewReportForm/{id_report_form}', 'ReportFormController@viewReportForm');
//untuk mengecek apakah reportform sedang digunakan
	Route::get('/JobVacant/ReportForm/CheckReportForm/{id_job_vacant}', 'ReportFormController@cekApakahReportFormUdahAdaYangGunain');
//untuk menampilkan form update report form
	Route::get('/JobVacant/ReportForm/UpdateReportForm/{id_job_vacant}', 'ReportFormController@updateReportForm');
//untuk menyimpan report form yang telah diisi
	Route::post('/JobVacant/ReportForm/CreateReportForm/SaveCreatedForm', 'ReportFormController@saveCreatedForm');
//untuk menyimpan report form yang telah diupdate
	Route::post('/JobVacant/ReportForm/UpdateReportForm/SaveUpdatedForm', 'ReportFormController@saveUpdatedForm');
});

Route::group(['middleware'=>'admin'],function(){
	//Admin
	//Route::get('/HomeAdmin','HomeController@admin');
//Untuk menampilkan list of users
	Route::get('/Users','UsersController@getListofUser');
//Untuk menampilkan create user
	Route::get('/Users/Create','UsersController@createUser');
	Route::post('/Users/Create','UsersController@storeUser');
//Route::get('/Users/Create','UsersController@getCompanyDivisi');
//Untuk delete user
	Route::get('Users/Delete/{email_users}','UsersController@deleteUser');
//Untuk menampilkan update user
	Route::get('Users/Update/{email_users}', array('as' => 'edit', 'uses' => 'UsersController@editUser'));
	Route::patch('Users/Update/{email_users}', array('as' => 'update', 'uses' => 'UsersController@updateUser'));
	//Halaman list applicant untuk admin
	Route::get('/ApplicantsAdmin', 'ApplicantController@getListOfApplicantAdmin');
//Delete applicant
	Route::get('Applicants/delete/{id_applicant}','ApplicantController@deleteApplicant');
});
Route::group(['middleware'=>'userhr'],function(){
	//Av Schedule
	Route::get('/AvailableSchedule','ScheduleController@showIndex');
	Route::get('/AvailableSchedule/{id_job_vacant}','ScheduleController@getForm');
	Route::get('/AvailableSchedule/Delete/{id_av_schedule}-{id_job_vacant}','ScheduleController@deleteAVS');
	Route::post('/AvailableSchedule/Create/{id_job_vacant}','ScheduleController@createAVS');
});


Route::group(['middleware'=>'web'],function(){
	Route::post('/dologin','UserController@process');
	Route::get('/dologout','UserController@quit');
});