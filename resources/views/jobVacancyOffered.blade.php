@extends('master')

@section('title')
Job Vacant List
@endsection

@section('content')

@if($list_job_vacant != null)

<h1 style="text-align: center"> Offered Available Position </h1>
@foreach($list_job_vacant as $jv)
  <div>
    <div><h3><b>{{ $jv->posisi_ditawarkan }}</b></h3></div><br> 
    <div><h4><b>Description</b></h4></div>
    <?php 
          $result = explode("\r\n", $jv->description); //membagi enter
          $temp="";
          foreach ($result as $r) {
            $temp = $temp.$r;
          }
          $result = explode("o>", $temp);
            if($result[0] === ""){
                array_shift($result); //membuang element kosong pertama
            }
          ?>
    <div>
       @foreach($result as $r)
                <li>{{ $r }}</li>
             @endforeach
    </div><br>
    <div><h4><b>Requirement</b></h4></div>
    <?php 
          $result = explode("\r\n", $jv->requirement); //membagi enter
          $temp="";
          foreach ($result as $r) {
            $temp = $temp.$r;
          }
          $result = explode("o>", $temp);
            if($result[0] === ""){
                array_shift($result); //membuang element kosong pertama
            }
          ?>
    <div>
      @foreach($result as $r)
                <li>{{ $r }}</li>
             @endforeach
    </div>
    <br>
    <div>
      <form action="applicant/registration" method="post">
        <input type="submit" class="btn btn-primary" name="{{ $jv->id_job_vacant }}" value= "Apply">
      </form>
    </div>
  </div>
  <br>
@endforeach
@else
<h3>Sorry there is no available position right now</h3>
@endif
	

@stop

