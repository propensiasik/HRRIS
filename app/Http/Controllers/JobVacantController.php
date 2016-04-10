<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
//use Request;

//use Input;

use App\Applicant;

use App\Http\Controllers\Controller;

use DB;

class JobVacantController extends Controller
{

    public function form() {

        $jobs = DB::select('select * from job_vacant') ;
        return view('pages.jobvacant' , ['jobs' => $jobs]);

       // return view('pages.jobvacant');

    }
    public function store() {

        $input = Input::all();
        
        $post = new Applicant;

        $post->id_applicant = Input::get('id_applicant'); //ini untuk ambil dari dropdown
        $post->nama_applicant = Input::get('nama_applicant'); //ini untuk ambil dari dropdown
        $post->emai_applicant = Input::get('email_applicant');
        $post->alamat = Input::get('alamat');
        $post->gender = Input::get('gender');
        $post->no_hp = Input::get('no_hp');
        $post->universitas = Input::get('universitas');
        $post->jurusan = Input::get('jurusan');
        $post->ipk = Input::get('ipk');
        $post->thn_lulus = Input::get('thn_lulus');
        $post->CV = Input::get('image');


        $post->save();
        return $input;
    }

    public function regis(){
        $jobs = DB::select('select * from job_vacant') ;
        return view('pages.job' , ['jobs' => $jobs]);
       

    }

    public function reg(){

        return view('pages.registrasi');
    }

}
