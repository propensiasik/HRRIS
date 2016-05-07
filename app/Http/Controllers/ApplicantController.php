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


    /*  writter  : Khalila Hunafa
        function : untuk menampilkan form registrasi applicant 
        caller   : dari halaman jobVacancyOffered ketika applicant memilih menu apply pada salah satu job vacancy
        input    : menerima input id_job_vacant yang dipilih oleh applicant 
        output   : melempar id_job_vacant ke halaman applicantRegistrationForm
    */  
    public function showRegistrationForm()
    {
        $job_vacant = DB::table('job_vacant')->where('is_open', '=', 1 )->get(); 
        $id_job_vacant = Input::all();
        $id_job_vacant = array_flip($id_job_vacant);
        $id_job_vacant = $id_job_vacant["Apply"];
        return view('applicantRegistrationForm', ['id_job_vacant' => $id_job_vacant]);
    }


    /*  writter  : Khalila Hunafa
        function : untuk memvalidasi input dari applicant dan menyimpannya pada database
        caller   : dari halaman applicantRegistrationForm setelah applicant klik button save
        input    : isi dari form dan id_job_vacant yang di apply
        output   : akan menampilkan pesan berhasil dengan memanggil halaman registrationSuccess
    */  
    public function storeApplicant()
    {
        $input = Input::all();
        //dd($input);
        $nama = Input::get('nama');
        $universitas = Input::get('universitas');
        $id_job_vacant = Input::get('id_job_vacant');
        $email = Input::get('email');

        $posisi = DB::table('job_vacant')->where('id_job_vacant', '=', $id_job_vacant)->select('posisi_ditawarkan')->value('posisi_ditawarkan');

        $error = false; //flag

        //validasi nama applicant    
        if (empty($input['nama'])){
             $error = true;
             dd('Name is required');
             session()->flash('nameErr', 'Name is required');
        }
        else if (!preg_match("/^[a-zA-Z ]*$/", $input['nama'])) {
             $error = true;
             dd('Only letters and white space allowed');
        }

        //validasi email applicant
        if (empty($input['email'])){
            $error = true;
            dd('Email is required');
            session()->flash('emailErr', 'Email is required');
        }
        else if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            dd('Invalid email format');
            session('Invalid email format')->flash('emailErr', 'Invalid email format');
        }

        //validasi gender applicant
        if (empty($input['gender'])){
            $error = true;
            dd('Please select your gender as male or female');
            session()->flash('genderErr', 'Please select your gender as male or female');
        }

        //validasi alamat
        if (empty($input['alamat'])){
            $error = true;
            dd('Address is required');
            session()->flash('addressErr', 'Address is required');
        }

        //validasi telp
        if (empty($input['phone'])){
            $error = true;
            dd('Phone number is required');
            session()->flash('phoneErr', 'Phone number is required');
        }

        //validasi jurusan
        if (empty($input['jurusan'])){
            $error = true;
            dd( 'Major is required');
            session()->flash('jurusanErr', 'Major is required');
        }

        //validasi universitas
        if (empty($input['universitas'])){
            $error = true;
            dd('University is required');
            session()->flash('universitasErr', 'University is required');
        }

        //validasi tahunLulus
        if (empty($input['tahunLulus'])){
            $error = true;
            dd('Graduation Year is required');
            session()->flash('tahunLulusErr', 'Graduation Year is required');
        }

        //validasi IPK
        if (empty($input['ipk'])){
            $error = true;
            dd('GPA is required');
            session()->flash('ipkErr', 'GPA is required');
        }

        //validasi portofolio
        $is_portofolio_null = false;
        if(!empty($input['portofolio'])){
            $destinationPathPortofolio = 'uploads/portofolio'; // destination path
            $extension = $input['portofolio']->getClientOriginalExtension(); // ambil extension
            $firstNameFile = 'Portofolio - '.$nama.' - '.$universitas; // nama depan
            $fileNamePortofolio = $firstNameFile.'.'.$extension;
            if($extension == "pdf"){
                $input['portofolio']->move($destinationPathPortofolio, $fileNamePortofolio);
            }
            else{
                $error = true;
                dd('Only pdf allowed');
                session()->flash('portofolioErr', 'Only pdf allowed, please upload your portofolio as pdf');
            }
        }else{
            $is_portofolio_null = true;
        }

        //validasi CV
        if(!empty($input['cv'])){
            $destinationPathCV = 'uploads/cv'; // destination path
            $extension = $input['cv']->getClientOriginalExtension(); // ambil extension
            $firstNameFile = 'CV - '.$nama.' - '.$universitas; // nama depan
            $fileNameCV = $firstNameFile.'.'.$extension;
            if($extension == "pdf"){
                $input['cv']->move($destinationPathCV, $fileNameCV);
            }
            else{
                $error = true;
                dd('Only pdf allowed');
                session()->flash('cvErr', 'Only pdf allowed, please upload your CV as pdf');
            }
        }else{
            $error = true;
            dd('CV is required');
            session()->flash('cvErr', 'CV is required');
        }

        //cek input work experience
        $work_exp_list = []; 
        for ($i=1; $i <= 10 ; $i++) { 
            if(!empty($input['posisi'.$i]) || !empty($input['perusahaan'.$i]) || !empty($input['start'.$i]) || !empty($input['end'.$i])){
                //berarti dia berniat diisi
                if(empty($input['posisi'.$i])){
                    $error = true;
                    dd('Please make sure that you fill in all the position of your work experience');
                    session()->flash('posisiErr', 'Please make sure that you fill in all the position of your work experience');
                }else if(empty($input['perusahaan'.$i])){
                    $error = true;
                    dd('Please make sure that you fill in all the company name');
                    session()->flash('perusahaanErr', 'Please make sure that you fill in all the company name');
                }else if (empty($input['start'.$i])) {
                    $error = true;
                    dd('Please make sure you have entered all your start period of your experience');
                    session()->flash('startErr', 'Please make sure you have entered all your start period of your experience');
                }else if (empty($input['end'.$i])) {
                    $error = true;
                    dd('Please make sure you have entered all your end period of your experience');
                    session()->flash('endErr', 'Please make sure you have entered all your end period of your experience');
                }else if(!empty($input['posisi'.$i]) && !empty($input['perusahaan'.$i]) && !empty($input['start'.$i]) && !empty($input['end'.$i])){
                    $date_start = date_create($input['start'.$i]);
                    $date_end = date_create( $input['end'.$i]);
                    $difference = date_diff($date_start, $date_end); //untuk ngecek start dan end
                    $range = $difference->format("%R%a");
                    $get_today_date = getdate();
                    $temp = $get_today_date['year']."-".$get_today_date['mon']."-".$get_today_date["mday"];
                    $today = date_create($temp);
                    $today_start = date_diff($date_start, $today);
                    $today_end = date_diff($date_end, $today);
                    $range_start_today = $today_start->format("%R%a");
                    $range_end_today = $today_end->format("%R%a");
                    if($range_start_today < 0 || $range_end_today < 0){ //berarti dia ngisi tanggal lewat dari hari ini
                        $error = true;
                        dd('You can not choose a date greater than today\'s date');
                        session()->flash('dateErr', 'You can not choose a date greater than todays date');  
                    }else{
                        if( $range > 0){
                            $work_exp = array('posisi' => $input['posisi'.$i], 
                                'perusahaan' => $input['perusahaan'.$i], 
                                'start' => $input['start'.$i], 
                                'end' => $input['end'.$i]);
                            $work_exp_obj = (object) $work_exp;
                            array_push($work_exp_list, $work_exp_obj);
                        }else{
                            $error = true;
                            dd('Please make sure that all your end period of work have a bigger date than the start period');
                            session()->flash('endErr', 'Please make sure that all your end period of work have a bigger date than the start period');
                        }
                    } 
                }
            }
        }

        //menyimpan data applicant ke table applicant
        if($error == false){
            if($is_portofolio_null == false){
                $id_applicant = DB::table('applicant')->insertGetId(['nama_applicant' => $input['nama'],
                                                                    'email_applicant' => $input['email'], 
                                                                    'alamat' => $input['alamat'],
                                                                    'gender' =>  $input['gender'],
                                                                    'no_hp' => $input['phone'],
                                                                    'universitas' => $input['universitas'],
                                                                    'jurusan' => $input['jurusan'],
                                                                    'ipk' => $input['ipk'],
                                                                    'thn_lulus' => $input['tahunLulus'], 
                                                                    'cv' => $destinationPathCV.'/'.$fileNameCV,
                                                                    'portofolio' => $destinationPathPortofolio.'/'.$fileNamePortofolio,
                                                                    'text' => $input['pesan'],
                                                                    'status_ter_update' => 1,
                                                                    'id_job_vacant' => $id_job_vacant,
                                                                    'is_active' => 1]);
            }else{ //kalo portofolio tidak null
                $id_applicant = DB::table('applicant')->insertGetId(['nama_applicant' => $input['nama'],
                                                                    'email_applicant' => $input['email'], 
                                                                    'alamat' => $input['alamat'],
                                                                    'gender' =>  $input['gender'],
                                                                    'no_hp' => $input['phone'],
                                                                    'universitas' => $input['universitas'],
                                                                    'jurusan' => $input['jurusan'],
                                                                    'ipk' => $input['ipk'],
                                                                    'thn_lulus' => $input['tahunLulus'], 
                                                                    'cv' => $destinationPathCV.'/'.$fileNameCV,
                                                                    'status_ter_update' => 1,
                                                                    'text' => $input['pesan'],
                                                                    'id_job_vacant' => $id_job_vacant,
                                                                    'is_active' => 1]);
            }

        //menyimpan data work experience 
            foreach ($work_exp_list as $w) {
                $id_worl_exp = DB::table('work_experience')->insertGetId(['position' => $w->posisi,
                                                                        'company' => $w->perusahaan, 
                                                                        'start' => $w->start,
                                                                        'end' => $w->end,
                                                                        'id_applicant' => $id_applicant]);
            }

            //mengirim email konfirmasi ke email applicant dan hr
            // Mail::send('emails.toSend', ['nama' => $nama, 'posisi' => $posisi], function($message) {
            //   $message->to('khalila9616@gmail.com', 'Khalila Hunafa')->subject('Definite Confirmation');
            // });

             return view('registrationSuccess', ['nama' => $nama, 'posisi' => $posisi]);
        }else{ //ketika error ditemukan dia akan melempar error message ke form

        }   

    }

}
