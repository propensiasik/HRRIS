<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
    	session_start();
    	//dd($_SESSION['booleanRole']);
    	if($_SESSION['booleanRole']!=='0'){
    		return view('/recruiter')->with('page','recruiter');
    	}
    	else{
    		return view('/hr')->with('page','hr');	
    	}
    }
}
