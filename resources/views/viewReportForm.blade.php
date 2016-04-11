@extends('layouts.master')

<?php 
  session_start();
?>
@section('title')
  View Report Form
@endsection

@section('content')
<h1 style="text-align: center"> View Report Form </h1>
<br>
  <div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">  
                  <tbody>
        <tr>
            <td>Job vacancy</td>
            <td>{{ $nama_jv }}</td>
          </tr>
          <tr>
            <td>Business function</td>
            <td>{{ $nama_divisi }}</td>
          </tr>
          <tr>
            <td>Company</td>
            <td>{{ $nama_company }}</td>
          </tr>
                  </tbody>
                </table>
              </div>
        </div>

        <div class="col-md-8">
          <h4>Competency List</h4>
          @foreach($competency as $competency)
            <li>
              {{ $competency }}
            </li>
            @endforeach 
        <div class="vertical-separator"></div>
        <div>
          <button type ="submit" onclick="#" class="btn btn-primary">Update</button>
        </div>
        </div>

          
        
        



@stop



