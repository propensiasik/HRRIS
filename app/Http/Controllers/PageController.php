<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
//use Request;

//use Input;

use App\About;

use App\Http\Controllers\Controller;

use DB;

class PageController extends Controller
{

   

    public function about(){

    	$firstname = 'Dini';
    	$lastname = 'Seprilia';
    	return view('about', compact('firstname', 'lastname')); 
    }

    public function form(){
        return view('create'); 
    }

    public function store() {

        $input = Input::all();
        
        $post = new About;

        $post->anak = Input::get('subsidiary'); //ini untuk ambil dari dropdown
        $post->jobname = Input::get('jobname'); //ini untuk ambil dari dropdown
        $post->capacity = Input::get('capacity');
        $post->Requirement = Input::get('requirement');

        $post->save();
        //return view('jobvacant');
        return $input;
    }

    /*public function insert(){
        $users = DB::table('users')->insert(
        array(
          'email_users' => 'john',
          'nama_users' => 'doe',
          'posisi' => 'jdoe@example.com',
          'is_admin' => 0,
          'id_divisi' = 'DIV01')
            );
        return $users;
    }
    */
    public function contact(){
    	return view('registrasi');
    }

    public function create()
    {
        return view('create');
    }

    
    //
}
