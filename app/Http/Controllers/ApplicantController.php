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

class ApplicantController extends Controller
{
    public function getListOfApplicant(){
        // METHOD INI UNTUK ME-RETRIEVE SEMUA DAFTAR APPLICANT YANG ME-APPLY JOB VACANT

        // Retrieve List of Applicant dari database untuk mengambil atribut yang dibutuhkan untuk di tampilkan pada UI, seperti NAMA applicant, POSISI atau job vacant apa yang applicant apply, dan COMPANY mana yang membuka job vacant tsb. Retrieve ini menampilkan tabel dengan fungsi pagination. 

        $jobs = DB::select('select posisi_ditawarkan from job_vacant');

        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->paginate(15);


        $count = DB::table('applicant')->count();

        // Melempar data yang dibutuhkan ke VIEW/UI
        return view('applicants')->with('applicants',$applicants)->with('jobs',$jobs)->with('count',$count)->with('page','applicants');
    }

    public function getListOfApplicantChoosen(){
        // TODO: METHOD INI UNTUK ME-RETRIEVE SEMUA DAFTAR APPLICANT YANG BERADA PADA STATUS RECRUITMENT TERTENTU YANG AKAN DIGUNAKAN UNTUK DI UPDATE STATUS NYA (ACCEPT UTK TAHAP SELANJUTNYA / REJECT / TIDAK ADA PERUBAHAN).
        
        $input = Input::all(); 

        // Mengambil input STATUS dari dropdown yang ada pada UI applicants.blade.php. Value yang diterima digenerate ke id_status yang disesuaikan dengan atribut di database 
        $status = $input['status'];

        $statusFor = '';

        if($status == 1) {
            $statusFor = 'INTERVIEW 1';
        } elseif ($status == 3) {
            $statusFor = 'INTERVIEW 2';
        } elseif ($status == 4) {
            $statusFor = 'INTERVIEW 3';
        } elseif ($status == 5) {
            $statusFor = 'OFFERING LETTER';
        } else {
            $statusFor = 'HIRE';
        }


        // Retrieve List of Applicant dari database untuk mengambil atribut yang dibutuhkan untuk di tampilkan pada UI, seperti NAMA applicant, POSISI atau job vacant apa yang applicant apply, dan COMPANY mana yang membuka job vacant tsb.
        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.status_ter_update', '=', $status)
                                ->get();

        
        if($applicants == null){
            return view('applicantChooseNotFound')->with('statusFor', $statusFor);
        }
        else{
            // Melempar data yang dibutuhkan ke VIEW/UI
            return view('chooseApplicant')->with('applicants',$applicants)->with('status',$status)->with('statusFor', $statusFor)->with('page','chooseApplicant');
        }
    }

    public function choose() {
        $input = Input::all(); // Menerima masukan input dari user dari UI (chooseApplicant.blade.php)

        $status = $input['status']; // mengambil value dari UI selection dropdown choose status

        $statusFor = '';

        if($status == 1) {
            $statusFor = 'INTERVIEW 1';
        } elseif ($status == 3) {
            $statusFor = 'INTERVIEW 2';
        } elseif ($status == 4) {
            $statusFor = 'INTERVIEW 3';
        } elseif ($status == 5) {
            $statusFor = 'OFFERING LETTER';
        } else {
            $statusFor = 'HIRE';
        }

        $slaAccept = ''; // variabel untuk menentukan status SLA yang sesuai
        $slaReject = '';

        // $sApply=1; $sReject=2; $sInterview1=3; $sInterview2=4; $sInterview3=5; $sOffering=6; $sHire=7;

        // Menentukan status SLA yang ACCEPT yang disesuaikan dengan choose status applicant yang dipilih untuk salah satu proses recruitment
        if($status == '1') { // APPLY
            $slaAccept = 1; // Apply ==> notify
        } elseif ($status == '3') { // INTERVIEW 1
            $slaAccept = 2; // notify ==> interview 1
        } elseif ($status == '4') { // INTERVIEW 2
            $slaAccept = 3; // interview 1 ==> interview 2
        } elseif ($status == '5') { // INTERVIEW 3
            $slaAccept = 4; // interview 2 ==> interview 3 
        } else { // OFFERING LETTER (S06)
            $slaAccept = 5; // interview 2 ==> offering letter
        }


        // Menentukan status SLA yang REJECT yang disesuaikan dengan choose status applicant yang dipilih untuk salah satu proses recruitment
        if($status == '1') { // APPLY
            $slaReject = 1; // Reject Interview 1
        } elseif ($status == '3') { // INTERVIEW 1
            $slaReject = 1; // Reject Interview 2
        } elseif ($status == '4') { // INTERVIEW 2
            $slaReject = 2; // Reject Interview 3
        } elseif ($status == '5') { // INTERVIEW 3
            $slaReject = 3; // Reject Offering Letter
        } else { // OFFERING LETTER (S06)
            $slaReject = 4; // Reject Hire
        }

        // Mengambil data-data applicant dari table APPLICANT yang sesuai proses recruitment terplih
        $applicants = Applicant::where('status_ter_update', $status)->get();
                            
        $array_app = [];  // array applicant yang di pilih

        $array_result = [];

        // Memasukan status (accept/reject/null) untuk setiap applicant ke array
        foreach ($applicants as $applicant) {
            $id_applicant = $applicant->id_applicant; // get id applicant
            $status_choosen = $input[$id_applicant]; // status yang dipilih dr dropdown dgn name=id_applicant
            $jv = $applicant->id_job_vacant; 
            // dd($status_choosen);
            $obj_app = array ('id_applicant' => $id_applicant, 'status_choosen' => $status_choosen, 'id_job_vacant' => $jv);
            $applicant = (object) $obj_app;
            array_push($array_app, $applicant);

            if($status_choosen == 1 || $status_choosen == 2) {
                $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.id_applicant', '=', $id_applicant)
                                ->get();
                $name;
                $posisi;
                $company;

                foreach ($applicants as $app) {
                    $name = $app->nama_applicant;
                    $posisi = $app->posisi_ditawarkan;
                    $company = $app->nama_company;
                }
                $choosen = array ('name' => $name, 'posisi' => $posisi, 'company' => $company, 'status_choosen' => $status_choosen);
                array_push($array_result, $choosen);
            }
        }

       // dd($array_app);

        //looping sebanyak applicants
        while ($array_app != null) {
            $app = array_pop($array_app);
            if($app->status_choosen == '2'){
                // JIKA STATUS "REJECT"

                // Update atribut 'status_terupdate' di tabel applicant, id_status 2 = 'Reject'
                Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 2]);

                $status_app = new Status_applicant;
                $status_app->id_sla = $slaReject;
                $status_app->id_status = 2; // REJECT
                $status_app->id_applicant = $app->id_applicant;
                $status_app->id_job_vacant = $app->id_job_vacant;
                $status_app->save();
            }
            else if($app->status_choosen == '1'){
                // JIKA STATUS "ACCEPT"
                if($status == 1){
                    //Status Di ubah dari APPLY ==> INTERVIEW 1
                    Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 3]);

                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 3; // INTERVIEW 1
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();

                }elseif($status == 3){
                    //Status Di ubah dari INTERVIEW 1 ==> INTERVIEW 2
                    Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 4]);

                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 4; // INTERVIEW 2
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();

                }elseif ($status == 4) {
                    //Status Di ubah dari INTERVIEW 2 ==> INTERVIEW 3
                    Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 5]);

                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 5; // INTERVIEW 3
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();

                } elseif ($status == 5) {
                    //Status Di ubah dari INTERVIEW 3 ==> OFFERING LETTER 
                    Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 6]);

                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 6; // OFFERING LETTER
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();

                }elseif ($status == 6) {
                    // Status Di ubah dari OFFERING LETTER ==> HIRE
                    Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 7]);

                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 7; // INTERVIEW 2
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();
                }
            }
        }

        
        return view('chooseApplicantResult')->with('array_result', $array_result)->with('statusFor', $statusFor);
       
    }

    public function getSearch(){
        $input = Input::all();
        $keyword = $input['keyword'];
        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.nama_applicant', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('job_vacant.posisi_ditawarkan', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('company.nama_company', 'LIKE', '%'.$keyword.'%')
                                ->paginate(15);

        $count = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.nama_applicant', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('job_vacant.posisi_ditawarkan', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('company.nama_company', 'LIKE', '%'.$keyword.'%')
                                ->count();

        if($applicants->isEmpty()){
            return view('applicantSearchNotFound');
        }
        else{
            return view('applicants')->with('applicants',$applicants)->with('count',$count)->with('page','applicants');
        }
    }


    public function filter(){

        //METHOD INI DIGUNAKAN UNUTK MELAKUKAN FILTERING 2 HAL SEKALIGUS, YAITU POSITION DAN GENDER

        //MENGAMBIL INPUT DARI USER
        $posisi = Input::get('ambilposisi');
        $gender = Input::get('ambilgender');

        /*APPLICANT DIGUNAKAN UNTUK ME-RETRIEVE DATA DARI DATABASE MENGENAI APPLICANT YANG AKAN DITAMPILKAN DALAM LIST OF
        APPLICANT, DIMANA KETIKA USER MELAKUKAN FITERING, INPUT YANG MASUK DI CEK DENGAN DATA YANG ADA DI DATABASE SEHINGGA
        DAPAT DITAMPILKAN KEMBALI PADA LIST OF APPLICANT. SEDANGKAN JOBS DIGUNAKAN HANYA UNTUK MENAMPILKAN DATA PADA BLADE

        */

         $applicants = DB::table('applicant')
                                         ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                         ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                         ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                         ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                         ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                        ->where('applicant.gender', '=', $gender)
                                         ->get();
               
         $jobs = DB::select('select posisi_ditawarkan from job_vacant');


        //JIKA USER MEMASUKKAN INPUT POSISI KOSONG
        if($posisi == "none"){
            if($gender != "none"){
                 $applicants = DB::table('applicant')
                                 ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                 ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                 ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                 ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.gender', '=', $gender)
                                 ->get();

                  $jobs = DB::select('select posisi_ditawarkan from job_vacant');
                return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs);
            }

        //JIKA USER MEMASUKKAN INPUT GENDER KOSONG
        }elseif ($posisi != "none"){
            if($gender == "none"){
                 $applicants = DB::table('applicant')
                                 ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                 ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                 ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                 ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                 ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                 ->get();
                 $jobs = DB::select('select posisi_ditawarkan from job_vacant');
                return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs);
            }

        }
        
        //JIKA PILIHAN TIDAK ADA YANG SESUAI
        if($applicants == null){
            $applicants = DB::table('applicant')
                                         ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                         ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                         ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                         ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                         ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                        ->where('applicant.gender', '=', $gender)
                                         ->get();
               
            $jobs = DB::select('select posisi_ditawarkan from job_vacant');
            return view('applicantChooseNotFound')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs);
        }else {
            //JIKA SEMUA PILIHAN SESUAI
            return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs);
        }

    }

    public function getApplicantProfile($id_applicant){
        $applicantProfile = Applicant::where('id_applicant', $id_applicant)->get();

        $applicantStatus = DB::table('status_applicant')
                            ->join('status', 'status_applicant.id_status', '=', 'status.id_status')
                            ->join('job_vacant', 'status_applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                            ->select('job_vacant.posisi_ditawarkan', 'status.nama_status', 'status_applicant.tgl_notifikasi', 
                                'status_applicant.id_sla', 'status_applicant.id_job_vacant')
                            ->where('status_applicant.id_applicant', '=', $id_applicant)
                            ->get();

         return view('ProfileApplicant', ['applicantProfile' => $applicantProfile, 'applicantStatus' => $applicantStatus, 'page'=>'recruiter']);
    }

    public function getReport($id_applicant) {
        $interviewer = DB::table('report')
                                ->join('applicant', 'applicant.id_applicant', '=', 'report.id_applicant')
                                ->join('users', 'users.email_users', '=', 'report.email_users')
                                ->select('report.isi_report', 'applicant.nama_applicant', 'users.nama_users')
                                ->where('applicant.id_applicant', $id_applicant)
                                ->get();

        $competency = DB::table('competency')
                                ->join('competency_used', 'competency_used.id_kompetensi', '=', 'competency.id_kompetensi')
                                ->join('report_form', 'report_form.id_report_form', '=', 'competency_used.id_report_form')
                                ->join('report', 'report.id_report_form', '=', 'report_form.id_report_form')
                                ->join('applicant', 'applicant.id_applicant', '=', 'report.id_applicant')
                                ->select('competency.nama_kompetensi')->distinct()
                                ->where('applicant.id_applicant', '=', $id_applicant)
                                ->get();

        $nama_applicant = DB::table('applicant')
                            ->select('nama_applicant')
                            ->where('id_applicant', $id_applicant)
                            ->get();
                                
        return view('assessmentReport')->with('interviewer',$interviewer)->with('nama_applicant',$nama_applicant)
            ->with('competency',$competency)->with('page','assessmentReport');;
    }

    public function getCV($id_applicant) {
        $applicantCV = DB::table('applicant')
                            ->select('cv')
                            ->where('id_applicant', $id_applicant)
                            ->get();

        $cvPath = $applicantCV[0]->cv;
        
        return redirect($cvPath);
    }

    public function getPortofolio($id_applicant) {
        $applicantPortofolio = DB::table('applicant')
                            ->select('portofolio')
                            ->where('id_applicant', $id_applicant)
                            ->get();

        $portofofolioPath = $applicantPortofolio[0]->portofolio;
        
        return redirect($portofofolioPath);
        
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
