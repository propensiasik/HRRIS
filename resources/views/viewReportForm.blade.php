@extends('layouts.master')

<?php 
  session_start();
?>
@section('title')
@endsection

@section('title')
  View Report Form
@endsection

@section('content')
<h1 style="text-align: center"> View Assessment Form Competency </h1>
<br>
  <div class="col-md-8">
    <div class="table-responsive">
      <table class="table" style="margin-left:25%; margin-right:15%;">  
        <tbody>
          <tr>
            <td>Available Position</td>
            <td>{{ $nama_jv }}</td>
          </tr>
          <tr>
            <td>Business Unit</td>
            <td>{{ $nama_divisi }}</td>
          </tr>
          <tr>
            <td>Company</td>
            <td>{{ $nama_company }}</td>
          </tr>
        </tbody>
      </table>

      <br>

      <table class="table" style="margin-left:25%; margin-right:15%;">
         <h3 style="text-align:center">Competency List</h3>
        <thead>
            <th>#</th>
            <th>Competency</th>              
            <th>Explanation</th>
        </thead> 
        <tbody>
          <?php $i=0; ?>
            @foreach ($competency as $competency)
              <?php $i++; ?>
          <tr>
              <td>
                {{ $i }}
              </td>
              <td>
                {{ $competency->nama_kompetensi}}
              </td>
              <td>
                {{ $competency->penjelasan_kompetensi }}
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

     <div>
          <button type ="submit" onclick="window.location='{{url("/JobVacant/ReportForm/CheckReportForm/". $id_job_vacant)}}'">Update</button>
        </div>
    
  </div>
@stop



