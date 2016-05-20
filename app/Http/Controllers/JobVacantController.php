<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;  
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Applicant;
use App\Jobvacant;
use App\Http\Controllers\Controller;
use DB;
use App\job_vacant;
use App\divisi;
use App\company;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;

class JobVacantController extends Controller
{

  public function create()
  {
    $id_job_vacant = DB::select('select id_job_vacant from job_vacant order by id_job_vacant desc limit 1');
    foreach ($id_job_vacant as $ijv ) {
      $newId = (int)substr($ijv->id_job_vacant, 1);
      if($newId === 0){
        $newId = (int)substr($ijv->id_job_vacant, 2);
        $newId +=1; 
        $newId_jv ='JV0'.$newId;
      }
      else{
        $newId +=1; 
        $newId_jv ='JV'.$newId;
      }
      //dd($newId_jv);
      return view('\createAVP')->with('page','avp')->with('newID',$newId_jv);
    }
  }

  public function process() {

    $post = new Jobvacant;
    $postIJV = new \App\Involved_Job_Vacant;
    $postIJV2 = new \App\Involved_Job_Vacant;
    $postIJV3 = new \App\Involved_Job_Vacant;
    $input = Input::all();
    
    

    $post->id_divisi=  $input['divisi'];
    $post->id_job_vacant = $input['id']; //ini untuk ambil dari dropdown
    $post->posisi_ditawarkan = $input['jobname']; //ini untuk ambil dari dropdown
    $post->jml_kebutuhan = $input['capacity'];
    $post->requirement = $input['requirement'];
    $post->save();

    DB::table('involved_job_vacant')->insert([
      ['id_job_vacant'=>$input['id'],'email_users'=>$input['author_terkait0']],
      ['id_job_vacant'=>$input['id'],'email_users'=>$input['author_terkait1']],
      ['id_job_vacant'=>$input['id'],'email_users'=>$input['author']]]);
    return redirect('/JobVacant');
  }

  public function form() {

    $jobs = DB::select('select * from job_vacant') ;
    return view('pages.jobvacant' , ['jobs' => $jobs]);

         // return view('jobvacant');

  }
  public function store() {

    $input = Input::all();

    $post = new Applicant;

          $post->id_applicant = Input::get('id_applicant'); //ini untuk ambil dari dropdown
          $post->nama_applicant = Input::get('nama_applicant'); //ini untuk ambil dari dropdown
          $post->emai_applicant = Input::get('email_applicant');
          $post->alamat = Input::get('alamat');
          $post->gender = Input::get('gender');
          $post->no_hp = Input::get('no_hp');
          $post->universitas = Input::get('universitas');
          $post->jurusan = Input::get('jurusan');
          $post->ipk = Input::get('ipk');
          $post->thn_lulus = Input::get('thn_lulus');
          $post->CV = Input::get('image');


          $post->save();
          return $input;
        }

        public function regis(){
          $jobs = DB::select('select * from job_vacant') ;
          return view('job' , ['jobs' => $jobs]);


        }

        public function gantiNama(){

          return view('/registrasi');
        }


    /*  writter  : Khalila Hunafa
        function : untuk menampilkan list available position yang telah dibuat
        caller   : akan muncul ketika user memilih menu available position pada home
        input    : -
        output   : akan menampilkan list available position
    */  
    public function getListOfJobVacant()
    {
      $jobVacantList = DB::table('job_vacant')
                          ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                          ->join('company', 'divisi.id_company', '=', 'company.id_company')
                          ->select('job_vacant.posisi_ditawarkan', 'divisi.nama_divisi', 'company.nama_company', 'job_vacant.is_open', 'job_vacant.id_job_vacant')->get();
    return view('listOfJobVacant', ['jobVacantList' => $jobVacantList]);
          
    }




    /*  writter  : Khalila Hunafa
        function : untuk melihat detil informasi dari suatu available position yang dipilih
        caller   : ketika user memilih salah satu nama available position dari halaman list of available position 
        input    : id_job_vacant yang dimaksud
        output   : akan menampilkan informasi-penting yang ada
    */  
    public function showJobVacantInformation($id_job_vacant)
    {
      
      $jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant);
   
      //mengambil posisi job vacant yang ditawarkan
      $nama_jv = $jv->value('posisi_ditawarkan'); //1

      //mengambil id_divisi untuk digunakan pada pencarian nama divisi
      $id_divisi = $jv->value('id_divisi');
  
      //mengembalikan tuple dari divisi yang dimaksud
      $div = DB::table('divisi')->where('id_divisi', $id_divisi);

      $nama_divisi = $div->value('nama_divisi'); //2

      $id_company = $div->value('id_company');

      $com = DB::table('company')->where('id_company', $id_company);

      $nama_company = $com->value('nama_company'); //3
       
      $jml_kebutuhan = $jv->value('jml_kebutuhan'); //4
      $requirement = $jv->value('requirement'); //5
      $description = $jv->value('description');
      $status_job = $jv->value('is_open'); //6
      
      $status = "";
      echo ($status);

      if($status_job == 1){
         $status = 'Published';
       }else{
         $status = 'Not published';
       }

       $applicant_list = DB::table('applicant')->where('id_job_vacant', $id_job_vacant)->where('is_active', 1)->simplePaginate(10);

       $users_involved = DB::table('involved_job_vacant')->where('id_job_vacant', '=', $id_job_vacant)->get();
  
      return view('jobVacantInformation', ['id_job_vacant' => $id_job_vacant, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'nama_jv' => $nama_jv, 'jml_kebutuhan' => $jml_kebutuhan, 
     'requirement' => $requirement, 'description' => $description, 'status' => $status, 'applicant_list' => $applicant_list, 'users_involved' => $users_involved]); 
    }





    /*  writter  : Khalila Hunafa
        function : untuk menampilkan available position yang publish dan dapat diapply oleh applicant
        caller   : ketika url /career maka akan muncul list available position
        input    : -
        output   : menampilkan halaman jobVacancyOffered
    */  
    //untuk dipilih oleh applicant
    public function showAvailablePosition(){
      $jv = DB::table('job_vacant')->where('is_open', '=', 1 )->get(); 
      return view('jobVacancyOffered', ['list_job_vacant' => $jv]);
    }





    /*  writter  : Khalila Hunafa
        function : untuk menampilkan form create job vacant
        caller   : ketika user memilih menu create available position pada halaman listOfJobVacant
        input    : -
        output   : menampilkan halaman createJobVacant
    */  
    public function showCreateJobVacantForm(){
       return view('createJobVacant'); 
    }





    /*  writter  : Khalila Hunafa
        function : untuk memvalidasi input dari user dan menyimpan ke dalam database
        caller   : dari halaman createJobVacant
        input    : input form dari user
        output   : akan menampilkan halaman jobVacantInformation
    */  
    public function saveCreatedJobVacant(){
      $input = input::all();
      //dd($input);
      $error_message = new MessageBag();
      
      $error = false;
      $id_company = $input['company']; //mengembalikan value 0,1,2,3,4
      //validasi company
      if($id_company == 0){//dia kosong
          //throw pesan kesalahan bahwa compamy harus dipilih
           $error = true;
           $comErr = "Please choose the company.";
           $error_message->add('comErr', $comErr);
      }

      if(empty($input['posisi'])){
        $error = true;
        $posisiErr = "Available position is required";
        $error_message->add('posisiErr', $posisiErr);
      }
      if(empty($input['jml_kebutuhan'])){
        $error = true;
        $jml_kebutuhanErr = "Number of needs is required";
        $error_message->add('jml_kebutuhanErr', $jml_kebutuhanErr);
      }
      if(empty($input['description'])){
        $error = true;
        $descriptionErr = "Description is required";
        $error_message->add('descriptionErr', $descriptionErr);
      }
      if(empty($input['requirement'])){
        $error = true;
        $requirementErr = "Requirement is required";
        $error_message->add('requirementErr', $requirementErr);
      }
      if(empty($input['pic'])){
        $error = true;
        $picErr = "Person in charge is required";
        $error_message->add('picErr', $picErr);
      }else{
        //validasi pic
        $pic = $input['pic'];
        $result = explode("\r\n", $pic);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp." ".$r;
        }
        $result = explode("\n", $temp);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp."".$r;
        }
        $result = explode(" ", $temp);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp."".$r;
        }
        $pic = explode(",", $temp); //$pic berbentuk array yang mengembalikan list username pic yang diinput     

        //memeriksa apakah semua username yang ada pada array PIC merupakan username yang terdaftar
        foreach ($pic as $p) {
          $involved = DB::table('users')->where('email_users', '=', $p)->get();
          if($involved == null && $p != ""){ //dia tidak ada di table users
            $error = true;
            $picErr = $p." is not a valid username";
            $error_message->add('picErr', $picErr);
            //dd($picErr);
          }
        }   
      }

      //validasi kesesuaian company dan divisi
      $divisi = $input['divisi']; //mengembalikan value 0,1,2,.., 9, 10
      $nama_divisi = "";
      if($divisi == 0){//dia kosong
        $error = true;
        $divErr = "Please choose the business unit";
        $error_message->add('divErr', $divErr);
        //dd($divErr);
      }elseif($divisi == 1){ //
        $nama_divisi = "Project Manager";
      }elseif($divisi == 2) { //
        $nama_divisi = "Web Developer";
      }elseif($divisi == 3) { //
        $nama_divisi = "Design";
      }elseif($divisi == 4){ //
        $nama_divisi = "UI/UX";
      }elseif($divisi == 5){ //
        $nama_divisi = "Account Manager";
      }elseif($divisi == 6){ //
        $nama_divisi = "Quality Assurance";
      }elseif($divisi == 7){ //
        $nama_divisi = "Mobile Developer";
      }elseif($divisi == 8){ //
        $nama_divisi = "Human Resource";
      }elseif($divisi == 9){ //
        $nama_divisi = "Analyst";
      }elseif($divisi == 10){ //
        $nama_divisi = "Produser";
      }


      if($divisi != 0){
      //mendapatkan divisi mana
        $id_divisi = DB::table('divisi')->where('id_company', '=', $id_company)
        ->where('nama_divisi', '=', $nama_divisi)
        ->value('id_divisi');

        if($id_divisi == null){//kalo kosong berarti company dan divisi yang dipilih ga sesuai
          $error = true;
          $divErr = "There is no such business unit in the selected company";
          $error_message->add('divErr', $divErr);
          //dd($divErr);
        }
      }

      if($error == false){
        //input database job_vacant
        $id_job_vacant = DB::table('job_vacant')->insertGetId(['posisi_ditawarkan' => $input['posisi'], 
                                                               'jml_kebutuhan' => $input['jml_kebutuhan'] , 
                                                               'requirement' => $input['requirement'], 
                                                               'description' => $input['description'],
                                                               'is_open' => $input['status'], 
                                                               'id_divisi' => $id_divisi]);
        //input user involved ke table involved job vacant
        foreach ($pic as $p) {
          if($p != ""){
            DB::table('involved_job_vacant')->insert(['id_job_vacant' => $id_job_vacant, 'email_users' => $p]);    
        }
      }
        return redirect()->action('JobVacantController@showJobVacantInformation', $id_job_vacant);
    }else{ //ditemukan error

      $old_input = new MessageBag();
      $old_input->add('posisi', $input['posisi']);
      $old_input->add('status', $input['status']);
      $old_input->add('company', $input['company']);
      $old_input->add('divisi', $input['divisi']);
      $old_input->add('jml_kebutuhan', $input['jml_kebutuhan']);
      $old_input->add('description', $input['description']);
      $old_input->add('requirement', $input['requirement']);
      $old_input->add('pic', $input['pic']);

      //menyimpan message bag kedalam session
      session()->flash('errors', $error_message);
      session()->flash('old_input', $old_input);
      //lempar session ke halaman form

      return redirect()->route('FormCreateAvailablePosition');

    }
  }








    /*  writter  : Khalila Hunafa
        function : untuk memvalidasi input dari user dan menyimpan ke dalam database
        caller   : dari halaman updateJobVacantInformation
        input    : input form dari user
        output   : akan menampilkan halaman jobVacantInformation
    */  
    public function saveUpdatedJobVacant(){
      $input = input::all();
      //dd($input);
      $error = false;
      $error_message = new MessageBag();
      $id_job_vacant = $input['id_job_vacant'];
      $id_company = $input['company']; //mengembalikan value 0,1,2,3,4
      //validasi company
      if($id_company == 0){//dia kosong
          //throw pesan kesalahan bahwa compamy harus dipilih
          $error = true;
          $comErr = "Please choose the company";
          //dd($comErr);
          $error_message->add('comErr', $comErr);
      }

      if(empty($input['posisi'])){
        $error = true;
        $posisiErr = "Available position is required";
        $error_message->add('posisiErr', $posisiErr);
      }
      if(empty($input['jml_kebutuhan'])){
        $error = true;
        $jml_kebutuhanErr = "Number of needs is required";
        $error_message->add('jml_kebutuhanErr', $jml_kebutuhanErr);
      }
      if(empty($input['description'])){
        $error = true;
        $descriptionErr = "Description is required";
        $error_message->add('descriptionErr', $descriptionErr);
      }
      if(empty($input['requirement'])){
        $error = true;
        $requirementErr = "Requirement is required";
        $error_message->add('requirementErr', $requirementErr);
      }

      $id_report_form = DB::table('report_form')->where('id_job_vacant', '=', $id_job_vacant)->value('id_report_form');
      //dd($id_report_form);
      $list_pic_has_report = DB::table('report')->where('id_report_form', '=', $id_report_form)->get();
      //dd($list_pic_has_report);
      $list_pic_has_av_schd = DB::table('available_schedule')->where('id_job_vacant', '=', $id_job_vacant)->get(); 

      if(empty($input['pic']) && empty($list_pic_has_report) && empty($list_pic_has_av_schd)){
        $error = true;
        $picErr = "Person in charge is required";
        $error_message->add('picErr', $picErr);
      }else{
        //validasi pic
        $pic = $input['pic'];
        $result = explode("\r\n", $pic);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp." ".$r;
        }
        $result = explode("\n", $temp);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp."".$r;
        }
        $result = explode(" ", $temp);
        $temp = "";
        foreach ($result as $r) {
          $temp = $temp."".$r;
        }
            $pic = explode(",", $temp); //$pic berbentuk array yang mengembalikan list username pic yang diinput    
            //dd($pic);


            //menambahkan list pic yang terhapus saat view
            foreach ($list_pic_has_report as $key) {
              array_push($pic, $key->email_users);
            }

            foreach ($list_pic_has_av_schd as $key) {
              array_push($pic, $key->email_users);
            }

            $pic = array_unique($pic); //untuk membuang yang duplikat
            

            //memeriksa apakah semua username yang ada pada array PIC merupakan username yang terdaftar
            if(!$error_message->has('picErr')){
              foreach ($pic as $p) {
                $involved = DB::table('users')->where('email_users', '=', $p)->get();
              if($involved == null && $p != ""){ //dia tidak ada di table users
                $error = true;
                $picErr = $p." is not a valid username";
                  //dd($picErr);
                $error_message->add('picErr', $picErr);
              }
            }
          }
        }

      //validasi kesesuaian company dan divisi
      
      $divisi = $input['divisi']; //mengembalikan value 0,1,2,.., 9, 10
      $nama_divisi = "";
      if($divisi == 0){//dia kosong
          //throw pesan kesalahan bahwa compamy harus dipilih
          $error = true;
          $divErr = "Please choose the business unit";
          $error_message->add('divErr', $divErr);
          //dd($divErr);
      }elseif($divisi == 1){ //
        $nama_divisi = "Project Manager";
      }elseif($divisi == 2) { //
        $nama_divisi = "Web Developer";
      }elseif($divisi == 3) { //
        $nama_divisi = "Design";
      }elseif($divisi == 4){ //
        $nama_divisi = "UI/UX";
      }elseif($divisi == 5){ //
        $nama_divisi = "Account Manager";
      }elseif($divisi == 6){ //
        $nama_divisi = "Quality Assurance";
      }elseif($divisi == 7){ //
        $nama_divisi = "Mobile Developer";
      }elseif($divisi == 8){ //
        $nama_divisi = "Human Resource";
      }elseif($divisi == 9){ //
        $nama_divisi = "Analyst";
      }elseif($divisi == 10){ //
        $nama_divisi = "Produser";
      }


      if($divisi != 0){
      //mendapatkan divisi mana
        $id_divisi = DB::table('divisi')->where('id_company', '=', $id_company)
        ->where('nama_divisi', '=', $nama_divisi)
        ->value('id_divisi');

        if($id_divisi == null){//kalo kosong berarti company dan divisi yang dipilih ga sesuai
          $error = true;
          $divErr = "There is no such business unit in the selected company";
          $error_message->add('divErr', $divErr);
            //dd($divErr);
        }
      }

         if($error == false){
          //me-update isi table job vacant
          DB::table('job_vacant')->where('id_job_vacant', '=', $id_job_vacant)
                                 ->update(['posisi_ditawarkan' => $input['posisi'], 
                                           'jml_kebutuhan' => $input['jml_kebutuhan'] , 
                                           'requirement' => $input['requirement'], 
                                           'description' => $input['description'],
                                           'is_open' => $input['status'], 
                                           'id_divisi' => $id_divisi]);                      
      
     
       //me-update table involved job vacant      
       $old_users_involved = DB::table('involved_job_vacant')->where('id_job_vacant', '=', $id_job_vacant)->get();
       $to_delete = [];
       $temp = "";
       //membandingkan isi array 
       foreach ($old_users_involved as $old) {
         $exist = false;
         foreach ($pic as $p) {
           if ($old->email_users === $p) {
             $exist = true;
             break;
           }
         }
         if($exist == false){
          array_push($to_delete, $old->email_users);
        }
      }

      //menghapus email user yang tidak ada di yang baru
      foreach ($to_delete as $del) {
        DB::table('involved_job_vacant')->where('email_users', '=', $del)->delete(); 
      }

      //mau menginput yang belum ada di database
      foreach ($pic as $p) {
        $old_exist = DB::table('involved_job_vacant')->where('id_job_vacant', '=', $id_job_vacant)->where('email_users', '=', $p)->value('email_users'); 
          if(empty($old_exist) && $p != ""){ //dia belum ada
            DB::table('involved_job_vacant')->insert(['id_job_vacant' => $id_job_vacant, 'email_users' => $p]);
          }
      } 

        return redirect()->action('JobVacantController@showJobVacantInformation', $id_job_vacant);
     }else{ //terdapat error
        $old_input = new MessageBag();
        $old_input->add('posisi', $input['posisi']);
        $old_input->add('status', $input['status']);
        $old_input->add('company', $input['company']);
        $old_input->add('divisi', $input['divisi']);
        $old_input->add('jml_kebutuhan', $input['jml_kebutuhan']);
        $old_input->add('description', $input['description']);
        $old_input->add('requirement', $input['requirement']);
        $old_input->add('pic', $input['pic']);
        $old_input->add('id_job_vacant', $input['id_job_vacant']);

        //menyimpan message bag kedalam session
        session()->flash('errors', $error_message);
        session()->flash('old_input', $old_input);
        //lempar session ke halaman form

       // return redirect()->action('JobVacantController@updateFormWrongInput', $id_job_vacant);
        //return redirect()->route('updateError', ['id_job_vacant' => $id_job_vacant]);
       return view('updateJobVacantInformation',  ['id_job_vacant' => $id_job_vacant]);
     }
  }




     /* writter  : Khalila Hunafa
        function : untuk menampilkan form update job vacant
        caller   : ketika user memilih menu update pada halaman jobVacantInformation
        input    : id_job_vacant
        output   : menampilkan halaman updateJobVacantInformation
    */  
    public function showUpdateJobVacantForm($id_job_vacant){
      //mendapatkan atribut job vacant
      $jv = DB::table('job_vacant')->where('id_job_vacant', '=', $id_job_vacant);
      $posisi = $jv->value('posisi_ditawarkan'); //nama posisi
      $status = $jv->value('is_open'); //status publish atau not publish (0/1)
      //dd($status);
      $id_divisi = $jv->value('id_divisi');
      $company = DB::table('divisi')->where('id_divisi', '=', $id_divisi)->value('id_company');

      $nama_divisi = DB::table('divisi')->where('id_divisi', '=', $id_divisi)->value('nama_divisi');
      //dd($nama_divisi);
      $divisi = "";
      if($nama_divisi === "Project Manager"){ //
        $divisi = 1;
      }elseif($nama_divisi === "Web Developer") { //
        $divisi = 2;
      }elseif($nama_divisi === "Design") { //
        $divisi = 3;
      }elseif($nama_divisi === "UI/UX"){ //
        $divisi = 4;
      }elseif($nama_divisi === "Account Manager"){ //
        $divisi = 5;
      }elseif($nama_divisi === "Quality Assurance"){ //
        $divisi = 6;
      }elseif($nama_divisi === "Mobile Developer"){ //
        $divisi = 7;
      }elseif($nama_divisi === "Human Resource"){ //
        $divisi = 8;
      }elseif($nama_divisi === "Analyst"){ //
        $divisi = 9;
      }elseif($nama_divisi === "Produser"){ //
        $divisi = 10;
      }

      $jml_kebutuhan = $jv->value('jml_kebutuhan');//kebutuhan int
    // $description = $jv->value('description');
      $requirement = $jv->value('requirement');
      $description = $jv->value('description');


      //PIC yang ditampilkan harus PIC yang belum mengisi report form atau available interview schedule
      $list_pic_involved = DB::table('involved_job_vacant')->where('id_job_vacant', '=', $id_job_vacant)->get();
      //dd($list_pic);
      $id_report_form = DB::table('report_form')->where('id_job_vacant', '=', $id_job_vacant)->value('id_report_form');
      //dd($id_report_form);
      $list_pic_has_report = DB::table('report')->where('id_report_form', '=', $id_report_form)->get();
      //dd($list_pic_has_report);
      $list_pic_has_av_schd = DB::table('available_schedule')->where('id_job_vacant', '=', $id_job_vacant)->get();
      //dd($list_pic_has_av_schd);

      //akan memindahkan semua email_users yang ada di $list_pic kedalam suatu array
      $list_pic = [];
      foreach ($list_pic_involved as $lpi) {
        array_push($list_pic, $lpi->email_users);
      }
      //dd($list_pic);

      
      //menghapus pic yang sudah ada di $list_pic_has_report
      foreach ($list_pic_has_report as $lphr) {
        foreach ($list_pic as $lp) {
          if($lp === $lphr->email_users){ //dia akan dihapus
              $key_to_delete = array_search($lp, $list_pic);
              unset($list_pic[$key_to_delete]);
            break;
          }
        }
      }

      //menghapus pic yang sudah ada di $list_pic_has_report
      foreach ($list_pic_has_av_schd as $lphas) {
        foreach ($list_pic as $lp) {
          if($lp === $lphas->email_users){ //dia akan dihapus
              $key_to_delete = array_search($lp, $list_pic);
              unset($list_pic[$key_to_delete]);
            break;
          }
        }
      }
      

      $pic = ""; //dalam bentuk string yang udah di konket
      foreach ($list_pic as $p) {
       //$username = $p->email_users;
        if($p == end($list_pic)){
          // $pic = $username.$pic;
           $pic = $p.$pic;
        }else{
          // $pic = $pic.", ".$username;
           $pic = $pic.", ".$p;
        }
      }


        $old_input = new MessageBag();
        $old_input->add('posisi', $posisi);
        $old_input->add('status', $status);
        $old_input->add('company', $company);
        $old_input->add('divisi', $divisi);
        $old_input->add('jml_kebutuhan', $jml_kebutuhan);
        $old_input->add('description', $description);
        $old_input->add('requirement', $requirement);
        $old_input->add('pic', $pic);
        $old_input->add('id_job_vacant', $id_job_vacant);

        session()->flash('old_input', $old_input);


      return view('updateJobVacantInformation',  ['id_job_vacant' => $id_job_vacant]); 
    }
   }
