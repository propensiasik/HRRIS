<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Report_Form;

use App\Competency;

use App\Competency_Used;

use App\job_vacant;

use DB;

class ReportFormController extends Controller
{
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



    public function createReportForm($id_job_vacant){ //untuk menampilkan form pengisisan report form
            
        //$id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');

        $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

        $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

        $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

        $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

        $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

        $competency = DB::table('competency')->get();

    //  return view('createReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant]);
      return view('createReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant]); 
    }



    public function saveCreatedForm($id_job_vacant){ //untuk menyimpan data dari form ke database
      $input = Input::all();
      dd($input);

    }

    public function saveUpdatedForm($id_report_form){

    }

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


    public function updateReportForm($id_job_vacant){
        $id_report_form = DB::table('report_form')->where('id_job_vacant',$id_job_vacant)->value('id_report_form');

        $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

        $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

        $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

        $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

        $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

        $competency_used = DB::table('report_form')
                          ->join('competency_used', 'competency_used.id_report_form', '=', 'report_form.id_report_form')
                          ->join('competency', 'competency.id_kompetensi', '=', 'competency_used.id_kompetensi')
                          ->select('competency.nama_kompetensi', 'competency.id_kompetensi', 'competency.penjelasan_kompetensi')->get();

        $competency = DB::table('competency')->get();

       return view('updateReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency, 'id_job_vacant' => $id_job_vacant, 'id_report_form' => $id_report_form, 'competency_used' => $competency_used]); 
    }

}


 

