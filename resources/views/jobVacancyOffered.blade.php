@extends('layouts.master_applicant')
<?php 
  session_start();
?>


@section('content')

@if($list_job_vacant != null)

<h1> Offered Available Position </h1>

<br><br>

@foreach($list_job_vacant as $jv)
<div class="kotak">
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
      <button type="button" class="btn btn-primary"><a href="{{ URL::to('/Apply/' . $jv->id_job_vacant) }}"><b style="color:white;">Apply</b></a></button>
    </div>
  </div>
  <br>
</div>
@endforeach
@else
<h3>Sorry there is no available position right now</h3>
@endif
  

@stop

