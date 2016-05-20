@extends('layouts.master')
<?php 
  session_start();
?>  

@section('content')

<div class = "container">

<div class="top">
  <h1 class="alignleft">Available Position Detail Information </h1>
  <div class = "alignright"><br>
      <a href="{{ URL::to('/JobVacant/ReportForm/' . $id_job_vacant) }}">
        <button class="btn btn-default"><img src="{{asset('img/Icon - Archive.png')}}">View assessment form</button>
      </a>
      <a href="{{ URL::to('/UpdateAvailablePosition/' . $id_job_vacant) }}">
        <button class="btn btn-success"><img src="{{asset('img/Icon - Edit.png')}}">Update information</button>
      </a>
  </div>
</div>

<div class="desc-group inline">
  <table class="table">
    <tr>
      <td><label>Available Position</label></td>
      <td>{{ $nama_jv }} </td>
    </tr>
    <tr>
      <td><label>Status</label></td>
      <td>{{ $status }}</td>
    </tr> 
    <tr>
      <td><label>Business Unit</label></td>
      <td>{{ $nama_divisi }}</td>
    </tr> 
    <tr>
      <td><label>Company</label></td>
      <td>{{ $nama_company }}</td>
    </tr> 
    <tr>
      <td><label>Number of Needs</label></td>
      <td>{{ $jml_kebutuhan }}</td>
    </tr> 
  </table>
</div>
                  
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
                 
<h3>Job Description</h3>
@foreach($result as $r)
  <li>{{ $r }}</li>
@endforeach
                  
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
                  
<h3>Job Requirement</h3>       
@foreach($result as $r)
  <li>{{ $r }}</li>
@endforeach
                  
<h3>Person In Charge</h3>
@foreach($users_involved as $user)
  <li>{{ $user->email_users }}</li>
@endforeach
                

                 <div>
                  <h3>Registered Applicant</h3>
                  <div class="table-responsive">
                    <table class="table"s>
                      <thead>
                        <tr>
                          <th>Applicant's Name</th>
                          <th>Major</th>
                          <th>University</th>
                          <th>Graduation Year</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($applicant_list as $applicant)
                        <tr>
                          <td><a href="{{ URL::to('applicant/profile/' . $applicant->id_applicant) }}">{{ $applicant->nama_applicant }}</a></td>
                          <td>{{ $applicant->jurusan }}</td>
                          <td>{{ $applicant->universitas }}</td>
                          <td>{{ $applicant->thn_lulus }}</td>
                        </tr>
                         @endforeach
                      </tbody>
                      </table>
                      {!! $applicant_list->links() !!}
                </div>
              </div>
        </div>
      </div> 
@stop