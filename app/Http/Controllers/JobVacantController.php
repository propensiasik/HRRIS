  <?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Validator;
  use Session;
  use Auth;
  use App\Http\Requests;
  use Illuminate\Support\Facades\Input;

  //use Request;

  //use Input;

  use App\Applicant;
  use App\Jobvacant;

  use App\Http\Controllers\Controller;

  use DB;

  class JobVacantController extends Controller
  {
	
	public function create()
    {
        return view('\createAVP')->with('page','avp');
    }


    public function process() {

        $post = new Jobvacant;
         
         $input = Input::all();
         
         $post->id_divisi=  $input['divisi'];
         $post->id_job_vacant = $input['id']; //ini untuk ambil dari dropdown
         $post->posisi_ditawarkan = $input['jobname']; //ini untuk ambil dari dropdown
         $post->jml_kebutuhan = $input['capacity'];
         $post->requirement = $input['requirement'];
        

        $post->save();
       // return $input;

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
      public function getListOfJobVacant()
      {
        $jobVacantList = DB::table('job_vacant')
                            ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                            ->join('company', 'divisi.id_company', '=', 'company.id_company')
                            ->select('job_vacant.posisi_ditawarkan', 'divisi.nama_divisi', 'company.nama_company', 'job_vacant.is_open', 'job_vacant.id_job_vacant')->get();
      
       return view('listOfJobVacant', ['jobVacantList' => $jobVacantList]);
      }

     public function showJobVacantInformation($id_job_vacant)
      {
        
        $jv = DB::table('job_vacant')->where('id_job_vacant',$id_job_vacant);
   
        //mengambil posisi job vacant yang ditawarkan
        $nama_jv = $jv->value('posisi_ditawarkan'); //1

        //mengambil id_divisi untuk digunakan pada pencarian nama divisi
        $id_divisi = $jv->value('id_divisi');

        $div = DB::table('divisi')->where('id_divisi', $id_divisi);

        $nama_divisi = $div->value('nama_divisi'); //2
       // dd($nama_divisi);

        $id_company = $div->value('id_company');
      
        $com = DB::table('company')->where('id_company', $id_company);

        $nama_company = $com->value('nama_company'); //3

        $jml_kebutuhan = $jv->value('jml_kebutuhan'); //4
        $requirement = $jv->value('requirement'); //5
        $status_job = $jv->value('is_open'); //6
        //dd($status);

        $status = "";
        echo ($status);

        if($status_job == 1){
           $status = 'Published';
          // echo ($tatus);
         }else{
           $status = 'Not published';
         }

        return view('jobVacantInformation', ['id_job_vacant' => $id_job_vacant, 'nama_divisi' => $nama_divisi, 'nama_company' => $nama_company, 'nama_jv' => $nama_jv, 'jml_kebutuhan' => $jml_kebutuhan, 
       'requirement' => $requirement, 'status' => $status]); 
     
      }
  }
