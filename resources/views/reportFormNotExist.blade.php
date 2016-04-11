@extends('layouts.master')
<?php  
session_start();
?>


@section('title')
	Report Form
@endsection


@section('content')

<div>
	<p>Job Vacancy berikut belum memiliki report form.
	 Untuk membuat report form silahkan pilih menu dibawah ini.</p>
</div>

<div>
	<a href="{{url('/JobVacant/ReportForm/CreateReportForm/' . $id_job_vacant) }}"><button type ="button" class="btn btn-primary">Create report form</button></a>


</div>

	


@stop