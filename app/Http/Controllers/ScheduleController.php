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

class ScheduleController extends Controller
{
	public function getListSchedule(){

		$temp = DB::table('interview')->join('applicant', 'interview.id_applicant','=','applicant.id_applicant')->join('available_schedule','available_schedule.id_av_schedule','=','interview.id_av_schedule')->get();
        //dd($temp);
		return view('\schedule' , ['schedule' => $temp, 'page' =>'test']);

	}
	public function create_interview(){

		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->get(); 
		//dd($a);
		$page='interview';
		return view('\createInterview')->with('jobvacant',$jv)->with('page',$page);
	}
	public function getInfo($id_job_vacant,$interviewKe){
		if($interviewKe=='1'){
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','!=','COO')->get();
		}
		else{
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','=','COO')->get();
		}
		
		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->where('job_vacant.id_job_vacant','=',$id_job_vacant)->first();
		if($interviewKe ==1){
		$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant, ap.id_job_vacant from apply as ap , applicant as a, status as s,status_applicant as sa where ap.id_applicant = a.id_applicant and sa.id_applicant=a.id_applicant and sa.id_status=s.id_status and ap.id_job_vacant ="'.$id_job_vacant.'"and s.nama_status="Apply"and a.id_applicant not in(select id_applicant from interview)');
		}
		else{
		$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant, ap.id_job_vacant from apply as ap , applicant as a, status as s,status_applicant as sa where ap.id_applicant = a.id_applicant and sa.id_applicant=a.id_applicant and sa.id_status=s.id_status and ap.id_job_vacant ="'.$id_job_vacant.'"and s.nama_status="Interview 1"and a.id_applicant not in(select id_applicant from interview)');	
		}
		$arrayApplicant= (array)$namaApplicant;
		//dd($array1);
		return view('\createInterview2')->with('jobvacant',$jv)->with('interviewer',$interviewer)->with('applicant',$arrayApplicant)->with('interviewke',$interviewKe);
	}
	public function setApplicant($id_applicant,$id_job_vacant,$interviewKe){
		if($interviewKe=='1'){
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.waktu from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and d.nama_divisi != "HR" and u.posisi != "COO" and av.is_used="0"');
		}
		else{
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.waktu from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and u.posisi = "COO" and av.is_used="0"');
		}
		$namaApplicant = DB::table('applicant')->where('id_applicant','=',$id_applicant)->first();
		//dd($available_schedule);
		return view('\assignApplicant')->with('dataApplicant',$namaApplicant)->with('available_schedule',$available_schedule)->with('interviewke',$interviewKe)->with('jobvacant',$id_job_vacant);
	}
	public function saveNewInterview($id_av_schedule,$type,$id_applicant,$id_job_vacant,$interviewKe){
		//dd($id_av_schedule,$type,$id_applicant,$id_job_vacant,$interviewKe);
		$id_wawancara = DB::select('select id_wawancara from interview order by id_wawancara desc limit 1');
		foreach ($id_wawancara as $idw ) {
			$newId = (int)substr($idw->id_wawancara, 1);
			if($newId === 0){
				$newId = (int)substr($idw->id_wawancara, 2);
				$newId +=1;	
				$newId_wawancara ='IN0'.$newId;
			}
			else{
				$newId +=1;	
				$newId_wawancara ='IN'.$newId;
			}
		}
		$emailUsers = DB::table('available_schedule')->where('id_av_schedule','=',$id_av_schedule)->first();
		if($interviewKe==1){
			$emailHR= DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','=','HR')->first();
			DB::table('interview')->insert(['id_wawancara'=>$newId_wawancara,'cara_wawancara'=>$type,'notes'=>'','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe  ]);	
			DB::table('involved_interview')->insert([
				['id_wawancara'=>$newId_wawancara,'email_users'=>$emailUsers->email_users],
				['id_wawancara'=>$newId_wawancara,'email_users'=>$emailHR->email_users]
				]);
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
			$_SESSION['a']='true';
		}
		else{
			DB::table('interview')->insert(['id_wawancara'=>$newId_wawancara,'cara_wawancara'=>$type,'notes'=>'asasa','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe  ]);	
			DB::table('involved_interview')->insert(['id_wawancara'=>$newId_wawancara,'email_users'=>$emailUsers->email_users]);
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
			$_SESSION['a']='true';	
		}
		//dd($_SESSION['successSave']);
		return Redirect::to('/CreateInterview/'.$id_job_vacant.'-'.$interviewKe);
	}
}
