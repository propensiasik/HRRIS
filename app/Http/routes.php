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


// ROUTER FERRI 
Route::get('/applicant', 'ApplicantController@getListOfApplicant');
Route::get('/applicant/profile/{id_applicant}', 'ApplicantController@getApplicantProfile');





Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });


});
