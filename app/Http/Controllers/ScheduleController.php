<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
//use Request;

//use Input;

use App\Schedule;

use App\Http\Controllers\Controller;

use DB;

class ScheduleController extends Controller
{
    public function getListSchedule(){

       // $schedule = DB::select('select interview.tgl_wawancara, interview.waktu_wawancara, intervew.cara_wawancara, applicant.nama_applicant 
       //                          from interview, applicant, involved_interview , users 
       //                          where interview.id_applicant = applicant.id_applicant and interview.id_wawancara = involved_interview.id_wawancara and 
       //                          involved_interview.email_users = users.email_users') ;
        $temp = DB::table('interview')->join('applicant', 'interview.id_applicant','=','applicant.id_applicant')->join('involved_interview','involved_interview.id_wawancara','=','interview.id_wawancara')->get();
        //dd($temp);
       //$schedule = DB::select('select * from interview') ;

       /* $schedule = DB::table('interview', 'users', 'involved_interview', 'applicant') 
                        ->where('interview.id_wawancara','=', 'involved_interview.id_wawancara')
                        ->where('interview.id_applicant','=', 'applicant.id_applicant')
                        ->select('interview.tgl_wawancara', 'interview.waktu_wawancara', 'interview.cara_wawancara', 'applicant.nama_applicant')
                       // ->where('users.email_users','=', 'involved_interview.email_users')
                        ->get();
        */

       /*schedule = DB::table('interview')
                        ->join('applicant', 'interview.id_applicant', '=' ,'applicant.id_applicant')
                        ->join('involved_interview', 'interview.id_wawancara' , '=' , 'involved_interview.id_wawancara' )
                        //->join('users', 'users.email_users' , '=', 'involved_interview.email_users')
                        ->select('interview.tgl_wawancara', 'interview.waktu_wawancara', 'interview.cara_wawancara', 'applicant.nama_applicant')
                        ->get();
        */
        return view('pages.schedule' , ['schedule' => $temp]);

    }
    

}

