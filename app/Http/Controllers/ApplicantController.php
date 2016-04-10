<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Applicant;

class ApplicantController extends Controller
{
    public function getListOfApplicant(){
        // $temp1 = Job_vacant::all()->id_job_vacant;

    	$applicants = DB::select('select app.id_applicant, app.nama_applicant, j.posisi_ditawarkan, c.nama_company, app.ipk
    	 						from applicant app, job_vacant j, apply a, company c, divisi d
    	 						where app.id_applicant=a.id_applicant and a.id_job_vacant=j.id_job_vacant and j.id_divisi=d.id_divisi and d.id_company=c.id_company');
    	
        // var_dump($applicants);die();

        return view('applicants')->with('applicants',$applicants)->with('page','applicants');
    }

    public function getApplicantProfile($id_applicant){
    	$applicantProfile = Applicant::where('id_applicant', $id_applicant)->get();

        $applicantStatus = DB::select('select s.nama_status, jv.posisi_ditawarkan, sa.tgl_konfirmasi
            from applicant app, apply a, job_vacant jv, status s, status_applicant sa 
            where sa.id_status=s.id_status and sa.id_job_vacant=jv.id_job_vacant and app.id_applicant=sa.id_applicant and app.id_applicant=a.id_applicant and jv.id_job_vacant=a.id_job_vacant and app.id_applicant=?', [$id_applicant]);
        
        $applicantCV = DB::select('select id_applicant, cv from applicant where id_applicant=?', [$id_applicant]);

    	return view('ProfileApplicant', ['applicantProfile' => $applicantProfile, 'applicantStatus' => $applicantStatus, 'applicantCV' => $applicantCV, 'page'=>'recruiter']);
    }

    public function getCV($id_applicant) {
    	$applicantCV2 = DB::select('select cv from applicant where id_applicant=?', [$id_applicant]);
        return $applicantCV2;
    }

    public function getPortofolio() {
    	return 'ini Portofolio coy';
    }

}
