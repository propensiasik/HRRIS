<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;

use App\Http\Requests;

use App\Report_Form;

use App\Competency;

use App\Competency_Used;

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
            //return view('reportFormNotExist');
 		 }else{ //report form sudah pernah dibuat
             $competencyUsed = DB::table('competency')
                                ->join('competency_used', 'competency_used.id_kompetensi', '=' , 'competency.id_kompetensi')
                                ->where('competency_used.id_report_form', '=', $id_report_form)->value('competency.nama_kompetensi'); //masih salah, dia ngembaliinnya cuma 1, harusnya banyak

                          //   dd($competencyUsed);

            //menampilkan data pendukung
            $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

            $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

            $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

            $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

            $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');


        return view('viewReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competencyUsed, 'id_job_vacant' => $id_job_vacant]); 
 		     
 		 }

    }



    public function openReportForm($id_job_vacant){ //untuk menampilkan form pengisisan report form
            $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan');

            $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

            $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

            $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

            $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');

            $competency = competency::all('nama_kompetensi');
            //dd($competency);


    	return view('createReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency]);
    }


    public function createReportForm(){





    }

    public function viewReportForm($id_job_vacant, $id_report_form){
            //me-load data dari report form yang sudah pernah dibuat
            //load competency yamg sudah dipilih untuk ditampilkan
            $competency = DB::table('competency')
                                ->join('competency_used', 'competency_used.id_kompetensi', '=' , 'competency.id_kompetensi')
                                ->where('competency_used.id_report_form', '=', $id_report_form)->value('competency.nama_kompetensi'); //masih salah, dia ngembaliinnya cuma 1, harusnya banyak

                             dd($competency);

            //menampilkan data pendukung

            $nama_jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('posisi_ditawarkan')->first();


            // $id_divisi = DB::select('select id_divisi
            //                      from job_vacant
            //                      where id_job_vacant=?',[$id_job_vacant]); //belum berbentuk single value

            $id_divisi = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant)->value('id_divisi');

            // $nama_divisi = DB::select('select nama_divisi
            //                      from divisi
            //                      where id_divisi=?',[$id_divisi]); //belum berbentuk single value

            $nama_divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->value('nama_divisi');

            // $id_company = DB::select('select id_company
            //                      from divisi
            //                      where id_divisi=?',[$id_divisi]); //belum berbentuk single value

            $id_company = DB::table('divisi')->where('id_divisi',$id_divisi)->value('id_company');

            // $nama_company = DB::select('select nama_company
            //                      from company
            //                      where id_company=?',[$id_company]); //belum berbentuk single value

            $nama_company = DB::table('company')->where('id_company',$id_company)->value('nama_company');


        return view('viewReportForm', ['nama_jv' => $nama_jv, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'competency' => $competency]); 
    }

}
