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
use App\Users;
use App\Status_applicant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;

class ApplicantController extends Controller
{
    public function getListOfApplicant(){
        // METHOD INI UNTUK ME-RETRIEVE SEMUA DAFTAR APPLICANT YANG ME-APPLY JOB VACANT

        // Retrieve List of Applicant dari database untuk mengambil atribut yang dibutuhkan untuk di tampilkan pada UI, seperti NAMA applicant, POSISI atau job vacant apa yang applicant apply, dan COMPANY mana yang membuka job vacant tsb. Retrieve ini menampilkan tabel dengan fungsi pagination. 
        
        $jobs = DB::select('select posisi_ditawarkan from job_vacant');
        $company = DB::select('select nama_company from company');

        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.is_active', '=', '1')
                                ->paginate(15);

        $count = DB::table('applicant')->count();
        $from = 'Home';

        // Melempar data yang dibutuhkan ke VIEW/UI
        return view('applicants')->with('applicants',$applicants)->with('jobs',$jobs)->with('company', $company)->with('count',$count)->with('page','applicants')->with('from',$from);
    }


    /*  writter  : Ferri Saputra
        function : untuk menampilkan list of applicant yang akan di choose berdasarkan status yang dipilih 
        caller   : dari halaman applicants.blade.php ketika user menekan tombol 'choose'
        input    : mengambil value dari dropdown choose status yang dipilih
        output   : list of applicant yang akan di choose dan juga status yang akan dipilih untuk di simpan ke DB
    */  
    public function getListOfApplicantChoosen(){
        // TODO: METHOD INI UNTUK ME-RETRIEVE SEMUA DAFTAR APPLICANT YANG BERADA PADA STATUS RECRUITMENT TERTENTU YANG AKAN DIGUNAKAN UNTUK DI UPDATE STATUS NYA (ACCEPT UTK TAHAP SELANJUTNYA / REJECT / TIDAK ADA PERUBAHAN).
        
        $input = Input::all(); // menerima inputan dari dropdown

        // Mengambil input STATUS dari dropdown yang ada pada UI applicants.blade.php. Value yang diterima digenerate ke id_status yang disesuaikan dengan atribut di database 
        $status = $input['status'];

        $statusFor = ''; 

        // me-generate status dari value dropdown
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
        // Terdapat dua kondisi role, yaitu untuk HR dan non-HR
        $applicants;
        if($_SESSION["booleanRole"] == '0'){ // role untuk HR (menampilkan semua applicant)
            $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.status_ter_update', '=', $status)
                                ->where('applicant.is_active', '=', '1')
                                ->get();
        }
        else{ // role untuk non-HR (menampilkan applicant yang dimana users terdaftar pada involved_job_vacant)
            $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')   
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->join('involved_job_vacant', 'job_vacant.id_job_vacant', '=', 'involved_job_vacant.id_job_vacant')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('involved_job_vacant.email_users', '=', $_SESSION["email"])
                                ->where('applicant.status_ter_update', '=', $status)
                                ->where('applicant.is_active', '=', '1')
                                ->get();
        }

        $jobs = DB::select('select posisi_ditawarkan from job_vacant');
        $company = DB::select('select nama_company from company');

        // Jika applicant yang di pilih ada / tidak ada
        if($applicants == null){ // tidak ada satu applicant yang dapat di choose
            return view('applicantChooseNotFound')->with('statusFor', $statusFor)->with('jobs',$jobs); //  menampilkan pesan
        }
        else{
            // Melempar data yang dibutuhkan ke VIEW/UI
            return view('chooseApplicant')->with('applicants',$applicants)->with('status',$status)->with('company', $company)->with('statusFor', $statusFor)->with('page','chooseApplicant')->with('jobs',$jobs)   ;
        }
    }



    /*  writter  : Ferri Saputra
        function : untuk melakukan choose applicant dan melakukan UPDATE dan CREATE pada status applicant 
        caller   : dari halaman chooseApplicant.blade.php ketika user menekan tombol 'choose' dan melakukan konfirmasi
        input    : mengambil value dari dropdown choose status yang dipilih  untuk setiap applicant
        output   : list of applicant yang berhasil di choose akan ditampilkan preview dari list of applicants tersebut
    */  
    public function choose() {
        $input = Input::all(); // Menerima masukan input dari user dari UI (chooseApplicant.blade.php)

        $status = $input['status']; // mengambil value dari UI selection dropdown choose status

        $statusFor = '';

        // me-generate status dari value dropdown
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

        $slaAccept = ''; // variabel untuk menentukan status SLA yang diterima (accept)
        $slaReject = ''; // variabel untuk menentukan status SLA yang ditolak (reject)

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
        $applicants;
        if($_SESSION["booleanRole"] == '0'){ // role untuk HR
            $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.id_job_vacant')
                                ->where('applicant.status_ter_update', '=', $status)
                                ->where('applicant.is_active', '=', '1')
                                ->get();
        }
        else{
            $applicants = DB::table('applicant') // role untuk non-HR
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')   
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->join('involved_job_vacant', 'job_vacant.id_job_vacant', '=', 'involved_job_vacant.id_job_vacant')
                                ->select('applicant.id_applicant', 'applicant.id_job_vacant')
                                ->where('involved_job_vacant.email_users', '=', $_SESSION["email"])
                                ->where('applicant.status_ter_update', '=', $status)
                                ->where('applicant.is_active', '=', '1')
                                ->get();
        }
                            
        $array_app = [];  // array applicant yang di pilih

        $array_result = [];  // array applicant hasil dari choose

        // Memasukan status (accept/reject/null) untuk setiap applicant ke array
        foreach ($applicants as $applicant) {
            $id_applicant = $applicant->id_applicant; // get id applicant
            $status_choosen = $input[$id_applicant]; // status yang dipilih dr dropdown dgn name=id_applicant
            $jv = $applicant->id_job_vacant; // mengambil job vacant yang diambil utk setiap applicant

            $obj_app = array ('id_applicant' => $id_applicant, 'status_choosen' => $status_choosen, 'id_job_vacant' => $jv);
            $applicant = (object) $obj_app;
            array_push($array_app, $applicant);  // memasukan data-data yang dibutuhkan ke $array_app

            // Memasukan data applicant yang statusnya di ACCEPT atau REJECT
            if($status_choosen == 1 || $status_choosen == 2) {
                $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.id_applicant', '=', $id_applicant)
                                ->where('applicant.is_active', '=', '1')
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
                array_push($array_result, $choosen); // memasukan data2 applicant ke $array_result
            }
        }


        //looping sebanyak applicants
        while ($array_app != null) {
            $app = array_pop($array_app); // mengambil data-data $array_app satu per satu
            if($app->status_choosen == '2'){
                // JIKA STATUS "REJECT"

                // UPDATE atribut 'status_terupdate' di tabel applicant, id_status 2 = 'Reject'
                Applicant::where('id_applicant', $app->id_applicant)
                            ->update(['status_ter_update' => 2]);

                // CREATE atau memasukan tupple baru pada tabel status_applicant 
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

                    // CREATE atau memasukan tupple baru pada tabel status_applicant
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

                    // CREATE atau memasukan tupple baru pada tabel status_applicant
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

                    // CREATE atau memasukan tupple baru pada tabel status_applicant
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

                    // CREATE atau memasukan tupple baru pada tabel status_applicant
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

                    // CREATE atau memasukan tupple baru pada tabel status_applicant
                    $status_app = new Status_applicant;
                    $status_app->id_sla = $slaAccept;
                    $status_app->id_status = 7; // INTERVIEW 2
                    $status_app->id_applicant = $app->id_applicant;
                    $status_app->id_job_vacant = $app->id_job_vacant;
                    $status_app->save();
                }
            }
        }

        // Melempar hasil data aplicant mana saja yang di ACCEPT atau di REJECT
        return view('chooseApplicantResult')->with('array_result', $array_result)->with('statusFor', $statusFor);
       
    }

    

    /*  writter  : Ferri Saputra
        function : untuk melakukan search applicant berdasarkan nama_applicant, position, dan company yang terdapat pada UI 
        caller   : dari halaman applicants.blade.php ketika user memasukan keyword di kotak pencarian dan melakukan submit
        input    : keyword yang dimasukan oleh user
        output   : list of applicant berdasarkan keyword yang dimasukan oleh user
    */  
    public function getSearch(){
        $input = Input::all(); // menerima inputan
        $keyword = $input['keyword']; // menerima inputan dari kotak pencarian yang diketikan user

        // Retrieve data applicant sesuai keyword + ditampilkan dalam bentuk pagination
        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.is_active', '=', '1')
                                ->where('applicant.nama_applicant', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('job_vacant.posisi_ditawarkan', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('company.nama_company', 'LIKE', '%'.$keyword.'%')
                                ->paginate(15);

        // Menghitung jumlah baris dari data yang di tampilkan
        $count = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('applicant.is_active', '=', '1')
                                ->where('applicant.nama_applicant', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('job_vacant.posisi_ditawarkan', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('company.nama_company', 'LIKE', '%'.$keyword.'%')
                                ->count();
        $jobs = DB::select('select posisi_ditawarkan from job_vacant');
        $company = DB::select('select nama_company from company');


        if($applicants->isEmpty()){ // jika keyword tidak sesuai dengan data di DB
            return view('applicantSearchNotFound')->with('jobs', $jobs);
        }
        else{ // jika keyword sesuai dengan data di DB dan menampilkan hasil pencarian ke applicants.blade.php
            return view('applicants')->with('applicants',$applicants)->with('jobs', $jobs)->with('company', $company)->with('count',$count)->with('page','applicants');
        }
    }


    public function filter(){

        //METHOD INI DIGUNAKAN UNUTK MELAKUKAN FILTERING 2 HAL SEKALIGUS, YAITU POSITION DAN GENDER

        //MENGAMBIL INPUT DARI USER
        $posisi = Input::get('ambilposisi');
        $perusahaan =Input::get('ambilcompany');

        /*APPLICANT DIGUNAKAN UNTUK ME-RETRIEVE DATA DARI DATABASE MENGENAI APPLICANT YANG AKAN DITAMPILKAN DALAM LIST OF
        APPLICANT, DIMANA KETIKA USER MELAKUKAN FITERING, INPUT YANG MASUK DI CEK DENGAN DATA YANG ADA DI DATABASE SEHINGGA
        DAPAT DITAMPILKAN KEMBALI PADA LIST OF APPLICANT. SEDANGKAN JOBS DIGUNAKAN HANYA UNTUK MENAMPILKAN DATA PADA BLADE

        */

         $applicants = DB::table('applicant')
                                         ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                         ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                         ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                         ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                         ->where('applicant.is_active', '=', '1')
                                         ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                        ->where('applicant.gender', '=', $gender)
                                         ->paginate(15);
               
        $jobs = DB::select('select posisi_ditawarkan from job_vacant');
        $company = DB::select('select nama_company from company');
        //$temp = (array)$applicants;
        $count = count($applicants);
        //dd($count);

        //JIKA USER MEMASUKKAN INPUT POSISI KOSONG
        if($posisi == "none"){
            if($gender != "none"){
                 $applicants = DB::table('applicant')
                                 ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                 ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                 ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                 ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                 ->where('applicant.is_active', '=', '1')
                                ->where('applicant.gender', '=', $gender)
                                ->paginate(15);

                  $jobs = DB::select('select posisi_ditawarkan from job_vacant');
                  $company = DB::select('select nama_company from company');
                  //$temp = (array)$applicants;
                  $count = count($applicants);

                  //dd($count);
                return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs)->with('company', $company)->with('count',$count);
            }

        //JIKA USER MEMASUKKAN INPUT GENDER KOSONG
        }elseif ($posisi != "none"){
            if($gender == "none"){
                 $applicants = DB::table('applicant')
                                 ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                 ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                 ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                 ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                 ->where('applicant.is_active', '=', '1')
                                 ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                 ->paginate(15);
                 $jobs = DB::select('select posisi_ditawarkan from job_vacant');
                 $company = DB::select('select nama_company from company');
                $count = count($applicants);
                return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs)->with('company', $company)->with('count',$count);
            }

        }
        
        //JIKA PILIHAN TIDAK ADA YANG SESUAI
        if($applicants == null){
            $applicants = DB::table('applicant')
                                         ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                         ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                         ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                         ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                         ->where('applicant.is_active', '=', '1')
                                         ->where('job_vacant.posisi_ditawarkan', '=', $posisi)
                                        ->where('applicant.gender', '=', $gender)
                                         ->paginate(15);
               
            $jobs = DB::select('select posisi_ditawarkan from job_vacant');
            $company = DB::select('select nama_company from company');
            $count = count($applicants);
            return view('applicantChooseNotFound')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs)->with('company', $company)->with('count',$count);
        }else {
            //JIKA SEMUA PILIHAN SESUAI
            return view('applicants')->with('applicants',$applicants)->with('page','applicants')->with('jobs', $jobs)->with('company', $company)->with('count',$count);
        }

    }


    /*  writter  : Ferri Saputra
        function : untuk menampilkan applicant profile 
        caller   : dari halaman applicants.blade.php ketika user meng-klik nama applicant
        input    : id_applicant
        output   : appllicant profile dan status history dari applicant
    */  
    public function getApplicantProfile($id_applicant){
        // Meretrive data applicant berdasarkan id_applicant yang dipilih
        $applicantProfile = Applicant::where('id_applicant', $id_applicant)->get(); 

        // Meretrive data status applicant
        $applicantStatus = DB::table('status_applicant')
                            ->join('status', 'status_applicant.id_status', '=', 'status.id_status')
                            ->join('job_vacant', 'status_applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                            ->select('job_vacant.posisi_ditawarkan', 'status.nama_status', 'status_applicant.tgl_notifikasi', 
                                'status_applicant.id_sla', 'status_applicant.id_job_vacant')
                            ->where('status_applicant.id_applicant', '=', $id_applicant)
                            ->get();

         // Melempar data applicant profile ke ProfileApplicant.blade.php
         return view('ProfileApplicant', ['applicantProfile' => $applicantProfile, 'applicantStatus' => $applicantStatus, 'page'=>'recruiter']);
    }



    /*  writter  : Ferri Saputra
        function : untuk menampilkan applicant report (nilai kompetensi dan comments dari interviewer) 
        caller   : dari halaman ProfileApplicants.blade.php ketika user meng-klik 'View Report'
        input    : id_applicant
        output   : appllicant profile dan status history dari applicant
    */  
    public function getReport($id_applicant) {
        // Meretrieve data-data interviewer
        $interviewer = DB::table('report')
                                ->join('applicant', 'applicant.id_applicant', '=', 'report.id_applicant')
                                ->join('users', 'users.email_users', '=', 'report.email_users')
                                ->select('report.isi_report', 'applicant.nama_applicant', 'users.nama_users')
                                ->where('applicant.id_applicant', $id_applicant)
                                ->get();

        // Meretrieve list of competency untuk setiap applicant
        $competency = DB::table('competency')
                                ->join('competency_used', 'competency_used.id_kompetensi', '=', 'competency.id_kompetensi')
                                ->join('report_form', 'report_form.id_report_form', '=', 'competency_used.id_report_form')
                                ->join('report', 'report.id_report_form', '=', 'report_form.id_report_form')
                                ->join('applicant', 'applicant.id_applicant', '=', 'report.id_applicant')
                                ->select('competency.nama_kompetensi')->distinct()
                                ->where('applicant.id_applicant', '=', $id_applicant)
                                ->get();

        // mengambil nama applicant
        $nama_applicant = DB::table('applicant')
                            ->select('nama_applicant')
                            ->where('id_applicant', $id_applicant)
                            ->get();
                                
        // Melempar data applicant report assessmentReport.blade.php
        return view('assessmentReport')->with('interviewer',$interviewer)->with('nama_applicant',$nama_applicant)
            ->with('competency',$competency)->with('page','assessmentReport');;
    }

    

    /*  writter  : Ferri Saputra
        function : untuk menampilkan CV applicant dalam bentuk .pdf melalui pdf reader di browser 
        caller   : dari halaman ProfileApplicants.blade.php ketika user meng-klik 'View CV'
        input    : id_applicant
        output   : file CV pdf, dibuka melalui pdf reader di browser atau di download
    */  
    public function getCV($id_applicant) {
        // Meretrieve CV dari applicant
        $applicantCV = DB::table('applicant')
                            ->select('cv')
                            ->where('id_applicant', $id_applicant)
                            ->get();
 
        $cvPath = $applicantCV[0]->cv;   // Mengambil path CV yang di simpan di direktori sistem
        
        return redirect($cvPath); // menampilakan file CV pdf
    }

    

    /*  writter  : Ferri Saputra
        function : untuk menampilkan Portofolio applicant dalam bentuk .pdf melalui pdf reader di browser 
        caller   : dari halaman ProfileApplicants.blade.php ketika user meng-klik 'View Portofolio'
        input    : id_applicant
        output   : file Portofolio pdf, dibuka melalui pdf reader di browser atau di download
    */  
    public function getPortofolio($id_applicant) {
        // Meretrieve CV dari applicant
        $applicantPortofolio = DB::table('applicant')
                            ->select('portofolio')
                            ->where('id_applicant', $id_applicant)
                            ->get();

        $portofofolioPath = $applicantPortofolio[0]->portofolio;  // Mengambil path Portofolio yang di simpan di direktori sistem
        
        return redirect($portofofolioPath);  // menampilakan file Portofolio pdf
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
    
    public function changeStatus(Request $val){

       $id = $val->input('id_applicant');
        $status = $val->input('status');
        $sla = $val->input('sla');
        $id_job = $val->input('id_job');

        $interview = DB::select('select id_applicant from interview');


        Applicant::where('id_applicant', $id)
                            ->update(['status_ter_update' => $status]);

        $cek = DB::table('status_applicant')
                    ->select('id_status as id') 
                    ->where('id_applicant', '=', $id)
                    ->orderBy('tgl_notifikasi', 'desc')
                    ->first();
        $cek2 = $cek->id ;

        $post = new Status_applicant;
        
        if($status != $cek2){
            
            $post->id_status=  $val->input('status');
            $post->id_job_vacant =$val->input('id_job'); //ini untuk ambil dari dropdow       
            $post->id_sla = $val->input('sla'); //ini untuk ambil dari dropdown         
            $post->id_applicant = $val->input('id_applicant');
            $post->save();

        }else{
           return redirect()->back();
        }
         return redirect()->back();
    }


    /*  writter  : Khalila Hunafa
        function : untuk menampilkan form registrasi applicant 
        caller   : dari halaman jobVacancyOffered ketika applicant memilih menu apply pada salah satu job vacancy
        input    : menerima input id_job_vacant yang dipilih oleh applicant 
        output   : melempar id_job_vacant ke halaman applicantRegistrationForm
    */  
    public function showRegistrationForm($id_job_vacant)
    {
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

        $error_message = new MessageBag();
        $error = false;

        //validasi nama applicant    
        if (empty($input['nama'])){
             $error = true;
             $nameErr = "Name is required";
             $error_message->add('nameErr', $nameErr);
        }
        else if (!preg_match("/^[a-zA-Z ]*$/", $input['nama'])) {
             $error = true;
             $nameErr = "Please check your name field. Only letters and white space allowed";
             $error_message->add('nameErr', $nameErr);
        }

        //validasi email applicant
        if (empty($input['email'])){
            $error = true;
            $emailErr = "Email is required";
            $error_message->add('emailErr', $emailErr);
        }
        else if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailErr = "Invalid email format";
            $error_message->add('emailErr', $emailErr);
        }

        //validasi gender applicant
        if ($input['gender'] === "O" || empty($input['gender'])){
            $error = true;
            $genderErr = "Please select your gender as male or female";
            $error_message->add('genderErr', $genderErr);
        }

        //validasi alamat
        if (empty($input['alamat'])){
            $error = true;
            $addressErr = "Address is required";
            $error_message->add('addressErr', $addressErr);
        }

        //validasi telp
        if (empty($input['phone'])){
            $error = true;
            $phoneErr = "Phone number is required";
            $error_message->add('phoneErr', $phoneErr);
        }

        //validasi jurusan
        if (empty($input['jurusan'])){
            $error = true;
            $jurusanErr = "Major is required";
            $error_message->add('jurusanErr', $jurusanErr);
        }

        //validasi universitas
        if (empty($input['universitas'])){
            $error = true;
            $universitasErr = "University is required";
            $error_message->add('universitasErr', $universitasErr);
        }

        //validasi tahunLulus
        if (empty($input['tahunLulus'])){
            $error = true;
            $tahunLulusErr = "Graduation Year is required";
            $error_message->add('tahunLulusErr', $tahunLulusErr);
        }

        //validasi IPK
        if (empty($input['ipk'])){
            $error = true;
            $ipkErr = "GPA is required";
            $error_message->add('ipkErr', $ipkErr);
        }

        //validasi portofolio
        $is_portofolio_null = false;
        if(!empty($input['portofolio'])){
            $portofolio_clone = $input['portofolio'];
            $destinationPathPortofolio = 'uploads/portofolio'; // destination path
            $extension = $input['portofolio']->getClientOriginalExtension(); // ambil extension
            $firstNameFile = 'Portofolio - '.$nama.' - '.$universitas; // nama depan
            $fileNamePortofolio = $firstNameFile.'.'.$extension;
            if($extension == "pdf"){
                $input['portofolio']->move($destinationPathPortofolio, $fileNamePortofolio);
            }
            else{
                $error = true;
                $portofolioErr = "Please check your portofolio. Only pdf allowed.";
                $error_message->add('portofolioErr', $portofolioErr);
            }
        }else{
            $is_portofolio_null = true;
        }

        //validasi CV
        if(!empty($input['cv'])){
            $cv_clone = $input['cv'];
            $destinationPathCV = 'uploads/cv'; // destination path
            $extension = $input['cv']->getClientOriginalExtension(); // ambil extension
            $firstNameFile = 'CV - '.$nama.' - '.$universitas; // nama depan
            $fileNameCV = $firstNameFile.'.'.$extension;
            if($extension == "pdf"){
                $input['cv']->move($destinationPathCV, $fileNameCV);
            }
            else{
                $error = true;
                $cvErr = "Please check your CV. Only pdf allowed.";
                $error_message->add('cvErr', $cvErr);
            }
        }else{
            $error = true;
            $cvErr = "CV is required.";
            $error_message->add('cvErr', $cvErr);
        }

        //cek input work experience
        // 1. dia harus di cek apakah satu tuplennya ada yang diisi atau engga
        // 2. kalo dari yang diisi itu ada bagian yang kosong dia akan nampilin pesan error
        $work_exp_list = []; 
        for ($i=1; $i <= 10 ; $i++) { 
            if(!empty($input['posisi'.$i]) || !empty($input['perusahaan'.$i]) || !empty($input['start'.$i]) || !empty($input['end'.$i])){
                //berarti dia berniat diisi
                if(empty($input['posisi'.$i])){
                    $error = true;
                    $posisiErr = "Please make sure that you fill in all the position of your work experience";
                    $error_message->add('posisiErr', $posisiErr);
                }
                if(empty($input['perusahaan'.$i])){
                    $error = true;
                    $perusahaanErr = "Please make sure that you fill in all the company name";
                    $error_message->add('perusahaanErr', $perusahaanErr);
                }
                if (empty($input['start'.$i])) {
                    $error = true;
                    $startErr = "Please make sure you have entered all your start period of your experience";
                    $error_message->add('startErr', $startErr);
                }
                if (empty($input['end'.$i])) {
                    $error = true;
                    $endErr = "Please make sure you have entered all your end period of your experience";
                    $error_message->add('endErr', $endErr);
                }
                if(!empty($input['posisi'.$i]) && !empty($input['perusahaan'.$i]) && !empty($input['start'.$i]) && !empty($input['end'.$i])){
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
                        $dateErr = "You can not choose a date greater than today's date";
                        $error_message->add('dateErr', $dateErr);
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
                            $endErr = "Please make sure that all your end period of work have a bigger date than the start period";
                            $error_message->add('endErr', $endErr);
                        }
                    } 
                }
               
            }
            if($error_message->has('posisiErr') || $error_message->has('perusahaanErr') || $error_message->has('dateErr') || $error_message->has('startErr') || $error_message->has('endErr')){ //dia cukup ngecek sekali
                break; //keluar dari loop supaya error messagenya ga numpuk isinya sama semua
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

                $id_applicant_status = DB::table('status_applicant')->insertGetId(['id_applicant' => $id_applicant,
                                                                                   'id_status' => 1,
                                                                                   'id_sla' => 1,
                                                                                   'id_job_vacant' => $id_job_vacant]);


            }else{
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

                $id_applicant_status = DB::table('status_applicant')->insertGetId(['id_applicant' => $id_applicant,
                                                                                   'id_status' => 1,
                                                                                   'id_sla' => 1,
                                                                                   'id_job_vacant' => $id_job_vacant]);


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
   //           $message->to('khalila9616@gmail.com', 'Khalila Hunafa')->subject('Definite Confirmation');
            // });

             return view('registrationSuccess', ['nama' => $nama, 'posisi' => $posisi]);
        }else{ //ketika error ditemukan dia akan melempar error message ke form
              $old_input = new MessageBag();
              $old_input->add('nama', $input['nama']);
              $old_input->add('email', $input['email']);
              $old_input->add('gender', $input['gender']);
              $old_input->add('alamat', $input['alamat']);
              $old_input->add('phone', $input['phone']);
              $old_input->add('jurusan', $input['jurusan']);
              $old_input->add('universitas', $input['universitas']);
              $old_input->add('tahunLulus', $input['tahunLulus']);
              $old_input->add('ipk', $input['ipk']);
              if(!empty($cv_clone)){
                $old_input->add('cv', $cv_clone);
              }
              if(!empty($portofolio_clone)){
                $old_input->add('portofolio', $portofolio_clone);
              }
              $old_input->add('pesan', $input['pesan']);
              $old_input->add('id_job_vacant', $input['id_job_vacant']);
              for ($i=1; $i <= 10 ; $i++) { 
                if(!empty($input['posisi'.$i])){
                    $old_input->add('posisi'.$i, $input['posisi'.$i]);
                }
                if(!empty($input['perusahaan'.$i])){
                    $old_input->add('perusahaan'.$i, $input['perusahaan'.$i]);
                }
                if(!empty($input['start'.$i])){
                    $old_input->add('start'.$i, $input['start'.$i]);
                }
                if(!empty($input['end'.$i])){
                    $old_input->add('end'.$i, $input['end'.$i]);
                }
              }
              
              //menyimpan message bag kedalam session
              session()->flash('errors', $error_message);
              session()->flash('old_input', $old_input);
              
              return view('applicantRegistrationForm', ['id_job_vacant' => $id_job_vacant]);
        }
    }   
    
    //Untuk halaman applicant buat admin
    public function getListOfApplicantAdmin(){
    
        $jobs = DB::select('select posisi_ditawarkan from job_vacant');
        $applicants = DB::table('applicant')
                                ->join('job_vacant', 'applicant.id_job_vacant', '=', 'job_vacant.id_job_vacant')
                                ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                                ->join('company', 'divisi.id_company', '=', 'company.id_company')
                                ->select('applicant.id_applicant', 'applicant.nama_applicant', 'job_vacant.posisi_ditawarkan', 'company.nama_company')
                                ->where('is_active','=',1)
                                ->paginate(15);


        $count = DB::table('applicant')->count();

        // Melempar data yang dibutuhkan ke VIEW/UI
        return view('applicants_admin')->with('applicants',$applicants)->with('jobs',$jobs)->with('count',$count)->with('page','applicants_admin');
    }
    
    //Untuk delete applicant
    public function deleteApplicant($id_applicant)
    {
        Applicant::where('id_applicant', '=', $id_applicant)->update(['is_active'=>0]);
        return Redirect::to('ApplicantsAdmin');
    }

}
