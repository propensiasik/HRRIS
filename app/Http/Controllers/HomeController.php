<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
    	session_start();
    	//dd($_SESSION['username']);
    	if($_SESSION['booleanRole']=='2'){
    		return view('/recruiter')->with('page','recruiter');
    	}
        elseif ($_SESSION['booleanRole']=='1') {
            return view('/admin')->with('page','admin');
        }
    	else{
    		return view('/hr')->with('page','hr');	
    	}
    }
}
