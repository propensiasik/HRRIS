@extends('master')

@section('title')
  Job Vacant Information
@endsection

@section('content')

<h1 style="text-align: center"> Available Position Detail Infromation </h1>
  
   <div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">  
              
                  <tbody>
                  <tr>
                    <td>Available Position</td>
                    <td>{{ $nama_jv }} </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>{{ $status }}</td>
                  </tr> 
                  <tr>
                    <td>Business Unit</td>
                    <td>{{ $nama_divisi }}</td>
                  </tr> 
                  <tr>
                    <td>Company</td>
                    <td>{{ $nama_company }}</td>
                  </tr> 
                   <tr>
                    <td>Number of Needs</td>
                    <td>{{ $jml_kebutuhan }}</td>
                  </tr> 
                  </tbody>
                </table>
                <div>
                  <?php 
                    $result = explode("\r\n", $description); //membagi enter
                    $temp="";
                     foreach ($result as $r) {
                      $temp = $temp.$r;
                    }
                    $result = explode("o>", $temp);
                    if($result[0] === ""){
                      array_shift($result); //membuang element kosong pertama
                    }
                  ?>
                  <div style="text-align: center"><h3>Job Description</h3></div>
                  <div>
                    @foreach($result as $r)
                      <li>{{ $r }}</li>
                    @endforeach
                  </div>
                </div>
                <div>
                 <?php 
                    $result = explode("\r\n", $requirement); //membagi enter
                    $temp="";
                     foreach ($result as $r) {
                      $temp = $temp.$r;
                    }
                    $result = explode("o>", $temp);
                    if($result[0] === ""){
                      array_shift($result); //membuang element kosong pertama
                    }
                  ?>
                  <div style="text-align: center"><h3>Job Requirement</h3></div>
                  <div>
                    @foreach($result as $r)
                      <li>{{ $r }}</li>
                    @endforeach
                  </div>
                </div>

                <div style="text-align: center"><h3>Person In Charge</h3></div>
                  <div>
                    @foreach($users_involved as $user)
                      <li>{{ $user->email_users }}</li>
                    @endforeach
                  </div>
                </div>

                 <div>
                  <div class="col-md-8" style="text-align: center"><h3>Registered Applicant</h3></div>
                  <div class="table-responsive">
                    <table class="table" style="margin-left:25%; margin-right:15%;">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Applicant's Name</th>
                          <th>Major</th>
                          <th>University</th>
                          <th>Graduation Year</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; ?>
                        @foreach($applicant_list as $applicant)
                        <?php $i++; ?>
                        <tr>
                          <td>{{ $i }}</td>
                          <td><a href="{{ URL::to('applicant/profile/' . $applicant->id_applicant) }}">{{ $applicant->nama_applicant }}</a></td>
                          <td>{{ $applicant->jurusan }}</td>
                          <td>{{ $applicant->universitas }}</td>
                          <td>{{ $applicant->thn_lulus }}</td>
                        </tr>
                         @endforeach
                      </tbody>
                      </table>
                  </div>
                </div>
              </div>
        </div>
      </div> 

  <div>
    <a href="{{ URL::to('/JobVacant/ReportForm/' . $id_job_vacant) }}"><button>View assessment form</button></a>
    <a href="{{ URL::to('/UpdateAvailablePosition/' . $id_job_vacant) }}"><button>Update information</button></a>
    </div>
 

@stop