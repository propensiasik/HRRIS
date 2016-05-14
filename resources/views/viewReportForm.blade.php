@extends('layouts.master')

@section('content')

<div class = "container">

<div class="top">
  <h1 class="alignleft"> View Assessment Form Competency </h1>
  <br>
  <button class = "btn btn-success alignright" type ="submit" onclick="window.location='{{url("/JobVacant/ReportForm/CheckReportForm/". $id_job_vacant)}}'">
    <img src="{{asset('img/Icon - Edit.png')}}">Update
  </button>
</div>
  
    <div class="desc-group inline">
      <table class="table">  
        <tbody>
          <tr>
            <td><label>Available Position</label></td>
            <td>{{ $nama_jv }}</td>
          </tr>
          <tr>
            <td><label>Business Unit</label></td>
            <td>{{ $nama_divisi }}</td>
          </tr>
          <tr>
            <td><label>Company</label></td>
            <td>{{ $nama_company }}</td>
          </tr>
        </tbody>
      </table>

      <table class="table">
         <h3>Competency List</h3>
        <thead>
            <th>No.</th>
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

     
          
        
    
  </div>
@stop



