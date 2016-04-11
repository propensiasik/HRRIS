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
      
      $jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant);
    //  dd($jv);

      //mengambil tuple job vacant yang dimaksud
      // $jv = job_vacant::all()->where('id_job_vacant', $id_job_vacant);
      // dd($jv);

      //mengambil posisi job vacant yang ditawarkan
      $nama_jv = $jv->value('posisi_ditawarkan'); //1
    //  dd($nama_jv);

      //mengambil id_divisi untuk digunakan pada pencarian nama divisi
      $id_divisi = $jv->value('id_divisi');
     // dd($id_divisi);
   //   $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

      //mengembalikan tuple dari divisi yang dimaksud
   //   $div = divisi::all()->where('id_divisi', $id_divisi);
      $div = DB::table('divisi')->where('id_divisi', $id_divisi);

      $nama_divisi = $div->value('nama_divisi'); //2
     // dd($nama_divisi);

      $id_company = $div->value('id_company');
     // dd($id_company);

    //  $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

      // $com = company::all()->where('id_company', $id_company);

      $com = DB::table('company')->where('id_company', $id_company);

       $nama_company = $com->value('nama_company'); //3
    //   dd($nama_company);

      //$id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

     // $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

       
      $jml_kebutuhan = $jv->value('jml_kebutuhan'); //4
      $requirement = $jv->value('requirement'); //5
      $status_job = $jv->value('is_open'); //6
      //dd($status);

      $status = "";
      echo ($status);

      if($status_job == 1){
         $status = 'Published';
        // echo ($tatus);
       }else{
         $status = 'Not published';
       }

      //return view('jobVacantInformation', ['idJobVacant' => $id_job_vacant]); 

      return view('jobVacantInformation', ['id_job_vacant' => $id_job_vacant, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'nama_jv' => $nama_jv, 'jml_kebutuhan' => $jml_kebutuhan, 
     'requirement' => $requirement, 'status' => $status]); 
   
    }
    //PUNYA KHALILA SAMPAI SINI YA


}
