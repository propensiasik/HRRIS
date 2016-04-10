<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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

       // return view('jobvacant');

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
        return view('job' , ['jobs' => $jobs]);
       

    }

    public function reg(){

        return view('registrasi');
    }
    public function getListOfJobVacant()
    {
    //$jobVacantList = Job_vacant::all(); //mendapatkan semua objek job vacant
     $jobVacantList = DB::table('job_vacant')->get();   
     return view('/listOfJobVacant', ['jobVacantList' => $jobVacantList]);
    }

    public function showJobVacantInformation($id_job_vacant)
    {
      
      $tuple_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->first();
     // dd($tuple_jv);

      $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

      $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

      $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

      $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

      // $posisi = $tuple_jv->value('posisi_ditawarkan');
      // $jml_kebutuhan = $tuple_jv->value('jml_kebutuhan');
      // $requirement = $tuple_jv->value('requirement');
      // $status = $tuple_jv->value('is_open');

      // if($status == 1){
      //   $status = 'published';
      // }else if($status == 0){
      //   $status = 'not published';
      // }

        return view('jobVacantInformation', ['idJobVacant' => $id_job_vacant]); 

       // return view('jobVacantInformation', ['idJobVacant' => $id_job_vacant, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'posisi' => $posisi, 'jml_kebutuhan' => $jml_kebutuhan, 
    //   'requirement' => $requirement, 'status' => $status]); 
   
    }

    public function updateJobVacant()
    {

    }

    //PUNYA KHALILA SAMPAI SINI YA


}
