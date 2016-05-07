<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Report_Form;
use App\Competency;
use App\Competency_Used;
use App\job_vacant;
use DB;

class ReportFormController extends Controller
{
  /*  writter  : Khalila Hunafa
      function : untuk memeriksa apakah seuatu report form sudah pernah dibuat sebelumnya atau belum 
      caller   : 
      input    : 
      output   : 
  */  
  public function cekApakahReportFormUdahDibuat($id_job_vacant){
        //mencari report form dari job vacant yang dimaksud
    $id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');
         //cek apakah report form exist
        if($id_report_form==null){ //report form belum dibuat
            //ke halaman pemberitahuan
          return view('reportFormNotExist', ['id_job_vacant' => $id_job_vacant]); 
       }else{ //report form sudah pernah dibuat

        return redirect()->action('ReportFormController@viewReportForm', $id_job_vacant);
      }

    }


  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function createReportForm($id_job_vacant){ //untuk menampilkan form pengisisan report form

      $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

      $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

      $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

      $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

      $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

      $competency = DB::table('competency')->get();

      return view('createReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant]); 
    }



  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function saveCreatedForm(){ //untuk menyimpan data dari form ke database

      $id_job_vacant = Input::get('id_job_vacant');

      $input = Input::get('array_id');

      $array_id = json_decode($input);

      if(empty($array_id)){
        dd('There is no competency choosen');
      }else{       
      //memasukan data report form pada table report form
      $id_report_form = DB::table('report_form')->insertGetId(['id_job_vacant' => $id_job_vacant]);      

      foreach ($array_id as $id) {
        DB::table('competency_used')->insert(
          ['id_kompetensi' => $id, 'id_report_form' => $id_report_form]);
      }

      return redirect()->action('ReportFormController@viewReportForm', $id_job_vacant);

      }

    }



  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function saveUpdatedForm(){

      $id_job_vacant = Input::get('id_job_vacant');

      //dd($id_job_vacant);
      $input = Input::get('array_id');

      $array_id = json_decode($input);

      if(empty($array_id)){
        dd('There is no competency choosen');
      }else{

      $id_report_form = Input::get('id_report_form');

     //mengambil data competency yang sudah ada pada report form
     $competency_used = Competency_Used::where('id_report_form', $id_report_form)->get()->toArray();
    
     $temp = [];
     //membandingkan isi yang ada pada array_id dan competency_used
     foreach ($competency_used as $comp) {
       foreach ($array_id as $id) {
          if($id === $comp['id_kompetensi']){ //suatu element pada database terdapat juga pada array
             echo("ada:".$id." ");
              array_push($temp, $id); //kumpulan element yang ada pada keduanya
              break;
            }
          }
        }

        foreach ($competency_used as $comp) {
         if(!in_array($comp['id_kompetensi'], $temp)){
        // echo("akan_didelete:".$comp['id_kompetensi']." "); //element yang harus di delete pada database
          DB::table('competency_used')->where('id_report_form', $id_report_form)->where('id_kompetensi', $comp['id_kompetensi'])->delete();
          
          }
       }

       foreach ($array_id as $id) {
         if(!in_array($id, $temp)){
        //element yang harus ditambahkan pada database
          DB::table('competency_used')->insert(['id_kompetensi' => $id, 'id_report_form' => $id_report_form]);
        }
      }
      return redirect()->action('ReportFormController@viewReportForm', $id_job_vacant);
    } 

    }


  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function viewReportForm($id_job_vacant){ 

            //mengembalikan id report form
      $id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');

            //mencari data list competency
      $competency = DB::table('competency_used')
      ->join('competency', 'competency.id_kompetensi', '=', 'competency_used.id_kompetensi')
      ->where('competency_used.id_report_form', '=', $id_report_form)
      ->select('competency.nama_kompetensi', 'competency.id_kompetensi', 'competency.penjelasan_kompetensi')->get();   

      $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

      $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

      $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

      $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

      $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

      return view('viewReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant, 'id_report_form' => $id_report_form]);      
    }



  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function updateReportForm($id_job_vacant){
      $id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');

      $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

      $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

      $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

      $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

      $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

      $competency_used = DB::table('competency_used')
      ->join('report_form', 'competency_used.id_report_form', '=', 'report_form.id_report_form')
      ->join('Competency', 'competency_used.id_kompetensi', '=', 'competency.id_kompetensi')
      ->select('competency.nama_kompetensi', 'competency.id_kompetensi')
      ->where('competency_used.id_report_form', $id_report_form)->get();

      $competency = DB::table('competency')->get();

     // $competency_hide = DB::table('competency')->get();

      return view('updateReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant, 'id_report_form' => $id_report_form, 'competency_used' => $competency_used]); 
    }




  /*  writter  : Khalila Hunafa
      function : 
      caller   : 
      input    :
      output   :
  */  
    public function cekApakahReportFormUdahAdaYangGunain($id_job_vacant){
       $id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');
       $report_pengguna = DB::table('report')->where('id_report_form', $id_report_form)->get();
       if($report_pengguna==null){ //belum ada yang gunain
           return redirect()->action('ReportFormController@updateReportForm', $id_job_vacant);
       }else{//udah ada yang gunain, ga bisa di update
           return view('reportFormHasBeenUsed', ['id_job_vacant' => $id_job_vacant]);   
       }
    } 
}




