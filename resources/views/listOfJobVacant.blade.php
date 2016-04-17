<?php 
session_start();
?>
@extends('layouts.master')

@section('title')

@endsection

@section('content')

<h1 style="text-align: center"> List Of Available Position </h1>
<div class="col-md-8">
  <div class="table-responsive">
    <table class="table" style="margin-left:25%; margin-right:15%;">  
      <thead>
        <tr>
          <th>#</th>
          <th>Posisi Ditawarkan</th>              
          <th>Divisi</th>
          <th>Company</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; ?>
        @foreach ($jobVacantList as $jv)
        <?php $i++; ?>
        <tr>
          <td>
            {{ $i }}    
          </td>
          <td>
            <a href="{{ URL::to('/JobVacant/' . $jv->id_job_vacant) }}"> {{ $jv->posisi_ditawarkan }} </a>
          </td>
          <td> 
            {{ $jv->nama_divisi }}
          </td>
          <td>
            {{ $jv->nama_company }}
          </td>
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
    <div class="vertical-separator"></div>
    <a href="{{url('/CreateAvailablePosition')}}"><button type="submit" class="btn btn-primary" style="margin-left:25%; margin-right:15%;">Create Job Vacant</button></a>
  </div>
</div>


@stop