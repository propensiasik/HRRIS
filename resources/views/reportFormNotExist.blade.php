@extends('layouts.master')

@section('content')

<div class = "container">

<h1>Assessment Form</h1>

<br>

<h4>This available vacancy, not having an assessment form yet.To create the assessment form, please choose this menu below.</h4>

<br>

<a href="{{url('/JobVacant/ReportForm/CreateReportForm/' . $id_job_vacant) }}">
	<button type ="button" class="btn btn-secondary"><img src="{{asset('img/Icon - Add - White.png')}}">Create assessment form</button>
</a>

	
</div>

@stop