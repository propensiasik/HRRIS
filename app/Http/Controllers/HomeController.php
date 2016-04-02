<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class HomeController extends Controller
{
    public function index(){
    	$applicant = DB::select( 'select * from applicant');
    	//var_dump($applicant);die();
    	return view('test', ['applicant' => $applicant]);
    }
    
}
