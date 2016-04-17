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
use App\Status_applicant;
use Input;

class ApplicantController extends Controller
{
    public function getListOfApplicant(){
        $applicants = DB::select('select app.id_applicant, app.nama_applicant, j.posisi_ditawarkan, c.nama_company, app.ipk
                                from applicant app, job_vacant j, apply a, company c, divisi d
                                where app.id_applicant=a.id_applicant and a.id_job_vacant=j.id_job_vacant and j.id_divisi=d.id_divisi and d.id_company=c.id_company');

        return view('applicants')->with('applicants',$applicants)->with('page','applicants');
    }

    public function getApplicantProfile($id_applicant){
        $applicantProfile = Applicant::where('id_applicant', $id_applicant)->get();

        $applicantStatus = DB::select('select s.nama_status, jv.posisi_ditawarkan, sa.tgl_konfirmasi,sa.id_sla
            ,jv.id_job_vacant from applicant app, apply a, job_vacant jv, status s, status_applicant sa 
            where sa.id_status=s.id_status and sa.id_job_vacant=jv.id_job_vacant and app.id_applicant=sa.id_applicant and app.id_applicant=a.id_applicant and jv.id_job_vacant=a.id_job_vacant and app.id_applicant=?', [$id_applicant]);
        
        $applicantCV = DB::select('select id_applicant, cv from applicant where id_applicant=?', [$id_applicant]);
        //dd($applicantStatus);
        return view('ProfileApplicant', ['applicantProfile' => $applicantProfile, 'applicantStatus' => $applicantStatus, 'applicantCV' => $applicantCV, 'page'=>'recruiter']);
    }

    public function getSearch(Request $request){
        $keyword = $request->input('keyword');

        $applicants = DB::select('select app.id_applicant, app.nama_applicant, j.posisi_ditawarkan, c.nama_company, app.ipk
                                from applicant app, job_vacant j, apply a, company c, divisi d 
                                where app.id_applicant=a.id_applicant and a.id_job_vacant=j.id_job_vacant and j.id_divisi=d.id_divisi and d.id_company=c.id_company and app.nama_applicant LIKE "%'.$keyword.'%" ');

        if($applicants==null){
            return view('applicantSearchNotFound');
        }
        else {
            return view('applicants', ['applicants' => $applicants]);
        }
    }



    public function uploadCV() {
        $file = Input::file('file');
        $path = 'uploads/';
        $file_name = $file->getClientOriginalName();
        
    }

    public function getCV($id_applicant) {
        $applicantCV2 = DB::select('select cv from applicant where id_applicant=?', [$id_applicant]);
        return $applicantCV2;
    }

    public function getPortofolio() {
        return 'ini Portofolio';
    }

    public function getStatus(){
        $post = new Applicant;

        $status = Input::get('status');

        dd($status);

        $applicants = DB::select('select app.id_applicant, app.nama_applicant, j.posisi_ditawarkan, c.nama_company, app.ipk
                                from applicant app, job_vacant j, apply a, company c, divisi d, status_applicant sa, status s
                                where app.id_applicant=a.id_applicant and a.id_job_vacant=j.id_job_vacant and j.id_divisi=d.id_divisi and d.id_company=c.id_company and app.id_applicant=sa.id_applicant and sa.id_status=s.id_status and s.nama_status=?', [$status]);

         return view('applicants')->with('applicants',$applicants)->with('page','applicants');
    }
    
    public function process(Request $val){

        $id = $val->input('id_applicant');
       $status = $val->input('status');
       $sla = $val->input('sla');
       $id_job = $val->input('id_job');

    $applicantProfile = Applicant::where('id_applicant', $id)->get();

       $id = $val->input('id_applicant');
       $status = $val->input('status');
       $sla = $val->input('sla');
       $id_job = $val->input('id_job');

        $post = new Status_applicant;
         
        
        $post->id_status=  $val->input('status');
        $post->id_job_vacant =$val->input('id_job'); //ini untuk ambil dari dropdow       
        $post->id_sla = $val->input('sla'); //ini untuk ambil dari dropdown         
        $post->id_applicant = $val->input('id_applicant');
        //$post->tgl_konfirmasi = Carbon::now();
        

         $post->save();
        //return redirect('/Applicants')->with('status', 'Profile updated!');
         //return redirect()->route('/applicant/profile/{id_applicant}', ['id_applicant' => $val->input('id_applicant')]);
         return redirect()->back();
       
       
    }

}
