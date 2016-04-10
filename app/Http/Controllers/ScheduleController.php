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

class ScheduleController extends Controller
{
	public function getListSchedule(){

        $temp = DB::table('interview')->join('applicant', 'interview.id_applicant','=','applicant.id_applicant')->join('involved_interview','involved_interview.id_wawancara','=','interview.id_wawancara')->get();
        //dd($temp);
        return view('\schedule' , ['schedule' => $temp]);

    }
	public function create_interview(){

		$jv = DB::table('job_vacant')->join('divisi','divisi.id_divisi','=','job_vacant.id_divisi')->join('company','company.id_company','=','divisi.id_company')->get(); 
		//dd($a);
		$page='interview';
		return view('\interview')->with('jobvacant',$jv)->with('page',$page);
	}
	public function info(Request $val){
		$interviewer = DB::table('involved_job_vacant')->join('users','users.email_users','=','involved_job_vacant.email_users')->where('id_job_vacant','=',$val->id_job_vacant)->get(); 
		$optionHTML = '<label>Interviewer</label>  <input type="text" class="form-control" value ="';
		foreach ($interviewer as $k) {
		 	$optionHTML .= $k->nama_users;
			$optionHTML .= ' ';
		}
		$optionHTML .= '"readonly></input>';
		return $optionHTML;
	}

}
