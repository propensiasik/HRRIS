@extends('master')


@section('title')
	Create Report Form
@endsection

@section('content')
<h1 style="text-align: center"> Create Report Form </h1>
<br>
	<div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">	
                  <tbody>
					<tr>
						<td>Job vacancy</td>
						<td>{{ $nama_jv}}</td>
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

        	@foreach($competency as $competency)
        			{{ $competency }}
        			<br>
        		@endforeach


        {{--	<!-- 	{{ Form::open(array('url' => 'foo/bar')) }}

        	<?php 
        		$all_data = array();
        		foreach($competencies as $competency){
        			all_data[] = $competency->id_kompetensi;
        		}
        	?>

        	@foreach ($competencies as $competency)
        		{{ Form::checkbox('competency[]', $competency->id_kompetensi, in_array($competency->id_kompetensi)) }}
        		{{ Form::label('competency', $competency->nama_kompetemsi) }}<br>
        	@endforeach

        	{{ Form::submit('Save') }}
        
        {{ Form::close() }} --> --}}



        	
        </div>

        <div>
        	<button type ="submit" onclick="window.location='{{url("/JobVacant/ReportForm/SaveReportForm/" .$id_job_vacant)}}'">Save</button>
        </div>
      



@stop



