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
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Applicant;
use App\Status_applicant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
	public function viewReport($id_applicant){
		$data = DB::table('report')->join('users','users.email_users','=','report.email_users')->join('report_form','report_form.id_report_form','=','report.id_report_form')->where('id_applicant',$id_applicant)->get();
		$applicant = \App\Applicant::where('id_applicant','=',$id_applicant)->first();
		$data2=$data;

		// $pecah2 = array();
		// 		foreach ($data2 as $key) {
		// 			$pecah = explode(',', $key->nilai_kompetensi);
		// 			for($i=0;$i<count($pecah);$i++){
		// 				$temp = explode('=', $pecah[$i]);
		// 				array_push($pecah2, $temp);
		// 			}
		// 		}
		// //dd($pecah2);
		return view('\viewReport')->with('data',$data)->with('applicant',$applicant)->with('data2',$data2);
	}

	public function create($id_applicant){ 
		$applicant = \App\Applicant::where('id_applicant','=',$id_applicant)->first()->toArray();
		$status = \App\Status::where('id_status','=',$applicant['status_ter_update'])->first()->toArray();
		$report_form = \App\Report_form::where('id_job_vacant','=',$applicant['id_job_vacant'])->first()->toArray();
		$involved_user = DB::table('users')->join('involved_job_vacant','involved_job_vacant.email_users','=','users.email_users')->where('involved_job_vacant.id_job_vacant','=',$applicant['id_job_vacant'])->get();
    	//dd($report_form);
		if($status['nama_status'] == 'Apply'){
			return view('\ReportError');
		}
		else{
			foreach ($involved_user as $iu) {
				DB::table('report')->insert(['isi_report'=>'','id_applicant'=>$id_applicant,'id_report_form'=>$report_form['id_report_form'],'email_users'=>$iu->email_users,'nilai_kompetensi'=>'']);
			}
			return Redirect::to('/applicant/profile/report/'.$id_applicant);
		}
	}
	public function getReport($id_applicant){
		$applicant = \App\Applicant::where('id_applicant','=',$id_applicant)->first();
		$report = DB::table('report')
		->join('report_form','report_form.id_report_form','=','report.id_report_form')
		->join('users','users.email_users','=','report.email_users')
		->where('report.email_users','=',$_SESSION['email'])
		->where('id_applicant','=',$id_applicant)
		->first();
		$competency = DB::table('competency')
		->join('competency_used', 'competency_used.id_kompetensi', '=', 'competency.id_kompetensi')
		->join('report_form', 'report_form.id_report_form', '=', 'competency_used.id_report_form')
		->join('report', 'report.id_report_form', '=', 'report_form.id_report_form')
		->join('applicant', 'applicant.id_applicant', '=', 'report.id_applicant')
		->select('competency.nama_kompetensi')->distinct()
		->where('applicant.id_applicant', '=', $id_applicant)
		->get();
		//dd($report);
		return view('fillReport')->with('applicant',$applicant)->with('report',$report)->with('competency',$competency);
	}
	public function saveReport(){
		$masukan = Input::all();
		$nilai = array($masukan['nilai']);
		$kompetensi = array($masukan['competency']);
		$comment = $masukan['comment'];
		$count = count($kompetensi['0']);		
		$nilai_kompetensi = array();
		$nilai_report ='';
		for($i=0; $i<1;$i++){
			for($y=0; $y<$count;$y++){
				if( $y == $count-1)
					$temp = $kompetensi[$i][$y].'='.$nilai[$i][$y];
				else
					$temp = $kompetensi[$i][$y].'='.$nilai[$i][$y].',';
				
				array_push($nilai_kompetensi, $temp);
			}
		}
		for($i=0;$i<$count;$i++){
			$nilai_report .= $nilai_kompetensi[$i];
		}
		$report = \App\Report::where('id_applicant','=',$masukan['id_applicant'])->where('email_users','=',$masukan['user'])->update(['isi_report'=>$comment,'nilai_kompetensi'=>$nilai_report]);
		return Redirect::to('/applicant/profile/report/'.$masukan['id_applicant']);
	}

}
