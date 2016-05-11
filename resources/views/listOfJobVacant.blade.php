<?php 
session_start();
?>
@extends('layouts.master')
@section('content')

<div class = "container">

<div class="top">
<h1 class="alignleft">List Of Available Position</h1>
<br>
<a href="{{url('/CreateAvailablePosition')}}" class="alignright">
  <button type="submit" class="btn btn-secondary">
    <img src="img/Icon - Add - White.png">
      Create Available Position</button>
</a>
</div>

  
    <div class="table-responsive">
      <table class="table">  
        <thead>
          <tr>
            <th>No.</th>
            <th>Available Position</th>              
            <th>Business Unit</th>
            <th>Company</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($jobVacantList as $jv)
        <?php $i++; ?>
          <tr>
            <td>{{ $i }}</td>
            <td><a href="{{ URL::to('/JobVacant/' . $jv->id_job_vacant) }}"> {{ $jv->posisi_ditawarkan }}</a></td>
            <td>{{ $jv->nama_divisi }}</td>
            <td>{{ $jv->nama_company }}</td>
            <td>
              <?php 
                if($jv->is_open == 0 )
                  $status = "Not Published";
                else
                  $status = "Published";
              ?>
              {{ $status }}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    
  </div>
</div>

@stop