@extends('layouts.master')


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

        <div>
          <h4>Competency List</h4>
          @foreach($competency as $competency)
            <li>
              {{ $competency }}
            </li>
            @endforeach 
          </div>

          
        
        <div>
          <button type ="submit" onclick="window.location='{{url("/JobVacant/update")}}'">Update</button>
        </div>



@stop



