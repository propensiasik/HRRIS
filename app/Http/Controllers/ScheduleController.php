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
use App\Job_vacant;

class ScheduleController extends Controller
{	
	//Method mengambil data schedule
	public function getListSchedule(){

		$temp = DB::table('interview')->join('applicant', 'interview.id_applicant','=','applicant.id_applicant')->join('available_schedule','available_schedule.id_av_schedule','=','interview.id_av_schedule')->join('job_vacant','job_vacant.id_job_vacant','=','available_schedule.id_job_vacant')->orderBy('available_schedule.id_job_vacant')->get();
        //dd($temp);
		return view('\schedule' , ['schedule' => $temp, 'page' =>'test']);

	}
	//Create Interview Schedule
	public function create_interview(){

		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->get(); 
		//dd($a);
		$page='interview';
		return view('\createInterview')->with('jobvacant',$jv)->with('page',$page);
	}
	public function getInfo($id_job_vacant,$interviewKe){ 
		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->where('job_vacant.id_job_vacant','=',$id_job_vacant)->first();
		
		if($interviewKe=='1'){
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','!=','COO')->get();
			$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant from applicant as a, status as s where a.id_job_vacant ="'.$id_job_vacant.'"and s.id_status = a.status_ter_update and s.nama_status="Interview 1" and a.id_applicant not in(select id_applicant from interview)');
		}
		else{
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','=','COO')->get();
			$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant from applicant as a, status as s where a.id_job_vacant ="'.$id_job_vacant.'"and s.id_status = a.status_ter_update and s.nama_status="Interview 2" and a.id_applicant not in(select id_applicant from interview)');
		}
		$arrayApplicant= (array)$namaApplicant;
		//dd($array1);
		//dd($namaApplicant);
		return view('\createInterview2')->with('jobvacant',$jv)->with('interviewer',$interviewer)->with('applicant',$arrayApplicant)->with('interviewke',$interviewKe);
	}

	public function setApplicant($id_applicant,$id_job_vacant,$interviewKe){
		$namaApplicant = DB::table('applicant')->where('id_applicant','=',$id_applicant)->first();
		if($interviewKe=='1'){
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.available_time from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and d.nama_divisi != "HR" and u.posisi != "COO" and av.is_used="0"');
		}
		else{
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.av.available_time from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and u.posisi = "COO" and av.is_used="0"');
		}
		//dd($available_schedule);
		return view('\assignApplicant')->with('dataApplicant',$namaApplicant)->with('available_schedule',$available_schedule)->with('interviewke',$interviewKe)->with('jobvacant',$id_job_vacant);
	}
	public function createInterview($id_av_schedule,$type,$id_applicant,$id_job_vacant,$interviewKe){
		//dd($id_av_schedule,$type,$id_applicant,$id_job_vacant,$interviewKe);
		$emailUsers = DB::table('available_schedule')->where('id_av_schedule','=',$id_av_schedule)->first();
		if($interviewKe==1){
			$emailHR= \App\Users::where('role','=','hr')->first();
			//dd($emailHR->email_users); 
			DB::table('interview')->insertGetId(['cara_wawancara'=>$type,'notes'=>'','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe ]);
			$id_wawancara = DB::select('select id_wawancara from interview order by id_wawancara desc limit 1');	
			foreach ($id_wawancara as $temp) {
				DB::table('involved_interview')->insert([
					['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailUsers->email_users],
					['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailHR->email_users]
					]);	
			}
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
		}
		else{
			DB::table('interview')->insert(['cara_wawancara'=>$type,'notes'=>'asasa','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe]);
			$id_wawancara = DB::select('select id_wawancara from interview order by id_wawancara desc limit 1');	
			foreach ($id_wawancara as $temp) {
				DB::table('involved_interview')->insert(['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailUsers->email_users]);	
			}
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
		}
		//dd($_SESSION['successSave']);
		return Redirect::to('/CreateInterview/'.$id_job_vacant.'-'.$interviewKe);
	}
	//Update Interview
	public function update_interview(){
		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->get(); 
		//dd($a);
		$page='interview';
		return view('\updateInterview')->with('jobvacant',$jv)->with('page',$page);
	}

	public function updateInfo($id_job_vacant, $interviewKe){ 
		$list_jadwal_interview = DB::table('interview')->join('applicant','applicant.id_applicant','=','interview.id_applicant')->join('available_schedule','available_schedule.id_av_schedule','=','interview.id_av_schedule')->where('keterangan','=',$interviewKe)->get();
		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->where('job_vacant.id_job_vacant','=',$id_job_vacant)->first();
		//dd($list_jadwal_interview);
		if($interviewKe=='1'){
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','!=','COO')->get();
			$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant from applicant as a, status as s where a.id_job_vacant ="'.$id_job_vacant.'"and s.id_status = a.status_ter_update and s.nama_status="Interview 1" and a.id_applicant not in(select id_applicant from interview)');
		}
		else{
			$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->join('divisi','users.id_divisi','=','divisi.id_divisi')->where('id_job_vacant','=',$id_job_vacant)->where('divisi.nama_divisi','=','COO')->get();
			$namaApplicant =  DB::select('select a.id_applicant, a.nama_applicant from applicant as a, status as s where a.id_job_vacant ="'.$id_job_vacant.'"and s.id_status = a.status_ter_update and s.nama_status="Interview 1" and a.id_applicant not in(select id_applicant from interview)');
		}
		$arrayApplicant= (array)$namaApplicant;
		//dd($array1);
		return view('\updateInterview2')->with('jobvacant',$jv)->with('interviewer',$interviewer)->with('applicant',$arrayApplicant)->with('interviewke',$interviewKe)->with('list_interview',$list_jadwal_interview);
	}

	public function setUpdate($id_applicant,$id_job_vacant,$interviewKe){
		$jadwal_lama = DB::table('interview')->join('available_schedule','available_schedule.id_av_schedule','=','interview.id_av_schedule')->where('keterangan','=',$interviewKe)->where('id_applicant','=',$id_applicant)->first();
		//dd($jadwal_lama);
		$namaApplicant = DB::table('applicant')->where('id_applicant','=',$id_applicant)->first();
		if($interviewKe=='1'){
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.available_time from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and d.nama_divisi != "HR" and u.posisi != "COO" and av.is_used="0"');
			//dd($available_schedule);
		}
		else{
			$available_schedule= DB::select('select distinct av.id_av_schedule, av.available_date, av.av.available_time from available_schedule as av, users as u, divisi as d where u.email_users = av.email_users and av.id_job_vacant ="'.$id_job_vacant.'" and u.posisi = "COO" and av.is_used="0"');
		}
		//dd($available_schedule);
		return view('\changeInterview')->with('dataApplicant',$namaApplicant)->with('available_schedule',$available_schedule)->with('interviewke',$interviewKe)->with('jobvacant',$id_job_vacant)->with('jadwal_lama',$jadwal_lama);
	}

	public function saveChanges($id_av_schedule,$type,$id_applicant,$id_job_vacant,$interviewKe,$jadwal_lama){
		$emailUsers = DB::table('available_schedule')->where('id_av_schedule','=',$id_av_schedule)->first();
		$id_wawancara_lama = DB::table('interview')->where('id_av_schedule','=',$jadwal_lama)->first();
		//dd($id_wawancara_lama->id_wawancara);
		$del1 = DB::table('involved_interview')->where('id_wawancara','=',$id_wawancara_lama->id_wawancara)->delete();
		$del2 = DB::table('interview')->where('id_wawancara','=',$id_wawancara_lama->id_wawancara)->delete();
		DB::table('available_schedule')->where('id_av_schedule','=',$id_wawancara_lama->id_av_schedule)->update(['is_used' => 0]);
		if($interviewKe==1){
			$emailHR= \App\Users::where('role','=','hr')->first();
			DB::table('interview')->insertGetId(['cara_wawancara'=>$type,'notes'=>'','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe ]);
			$id_wawancara = DB::select('select id_wawancara from interview order by id_wawancara desc limit 1');	
			foreach ($id_wawancara as $temp) {
				DB::table('involved_interview')->insert([
					['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailUsers->email_users],
					['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailHR->email_users]
					]);	
			}
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
		}
		else{
			DB::table('interview')->insert(['cara_wawancara'=>$type,'notes'=>'asasa','id_applicant'=>$id_applicant,'id_av_schedule'=>$id_av_schedule,'keterangan'=>$interviewKe]);
			$id_wawancara = DB::select('select id_wawancara from interview order by id_wawancara desc limit 1');	
			foreach ($id_wawancara as $temp) {
				DB::table('involved_interview')->insert(['id_wawancara'=>$temp->id_wawancara,'email_users'=>$emailUsers->email_users]);	
			}
			DB::table('available_schedule')->where('id_av_schedule', $id_av_schedule)->update(['is_Used' => 1]);
		}
		//dd($_SESSION['successSave']);
		return Redirect::to('/UpdateInterview/'.$id_job_vacant.'-'.$interviewKe);
	}

	//Create Available Schedule
	public function showIndex(){
		$listJobVacant = DB::table('involved_job_vacant')
		->join('job_vacant', 'job_vacant.id_job_vacant','=','involved_job_vacant.id_job_vacant')
		->join('divisi', 'divisi.id_divisi','=','job_vacant.id_divisi')
		->join('company', 'company.id_company','=','divisi.id_company')
		->where('involved_job_vacant.email_users','=',$_SESSION['email'])
		->where('job_vacant.is_open','=',1)	
		->orderBy('divisi.nama_divisi')->get();
		return view('createAVS')->with('jobvacant',$listJobVacant);
	}

	public function getForm($id_job_vacant){
		$total_applicant = DB::table('applicant')
		->join('involved_job_vacant','involved_job_vacant.id_job_vacant','=','applicant.id_job_vacant')
		->where('involved_job_vacant.id_job_vacant','=',$id_job_vacant)
		->where('involved_job_vacant.email_users','=',$_SESSION['email'])->count();
		$job_vacant = Job_vacant::where('id_job_vacant','=',$id_job_vacant)->first();
		$avs = DB::table('available_schedule')->where('id_job_vacant','=',$id_job_vacant)
		->where('email_users','=',$_SESSION['email'])
		->get();
		$temp = (array)$avs;
		$count_schedule = count($temp);
		//dd($job_vacant->posisi_ditawarkan);
		//dd($count_schedule);
		return view('formAVS')->with('detail',$job_vacant)->with('jumlah',$total_applicant)
		->with('jmlh_schedule',$count_schedule)->with('avs',$avs);
	}

	public function deleteAVS($id_av_schedule,$id_job_vacant){
		//dd($id_av_schedule);
		$del = DB::table('available_schedule')->where('id_av_schedule','=',$id_av_schedule)->delete();
		return Redirect::to('/AvailableSchedule/'.$id_job_vacant);
	}

	public function createAVS(Request $val, $id_job_vacant){
		//dd($val->date);
		//proses input user
		$pisah = explode(" ", $val->date);
		$temp_date = explode("/", $pisah[0]);
		$date_avs = $temp_date[2].'-'.$temp_date[0].'-'.$temp_date[1];
		
		$temp_time = explode(":", $pisah[1]);
		if($pisah[2]==='PM'){
			$temp = (int)$temp_time[0];
			$temp += 12;
			$temp_time[0] = $temp; 
			$time_avs = $temp_time[0].':'.$temp_time[1].':00';
		}

		else{
			$time_avs = $temp_time[0].':'.$temp_time[1].':00';
		}
		//validasi data input kedalam database
		$available_schedule = \App\Available_Schedule::where('email_users','=',$_SESSION['email'])->where('id_job_vacant','=',$id_job_vacant)->get();
		$counter = count($available_schedule);
		if($counter != 0){
			foreach ($available_schedule as $avs) {
				if($date_avs == $avs->available_date || $time_avs==$avs->$available_time){
					Session::flash('message', 'There are already same date or time!'); 
					Session::flash('alert-class', 'alert-danger'); 
				}
			}

		}
		//dd($date_avs);
		DB::table('available_schedule')
		->insert(['available_date'=>$date_avs,'notes'=>$val->note,'email_users'=>$_SESSION['email'],'is_Used'=>0,'id_job_vacant'=>$id_job_vacant,'available_time'=>$time_avs]);
		return Redirect::to('/AvailableSchedule/'.$id_job_vacant);
	}
}
