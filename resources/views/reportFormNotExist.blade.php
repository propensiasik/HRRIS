@extends('layouts.master')
<?php  
session_start();
?>


@section('title')
	Report Form
@endsection

<style type="text/css">
.note {
	text-align: center;
	font-size: 20px;
}
</style>


@section('content')

<div>
<div class="note"><b>This available vacancy, not having an assessment form yet. 
		To create the assessment form, please choose this menu below.</b></div>
</div>
<br>

<div>
	<a href="{{url('/JobVacant/ReportForm/CreateReportForm/' . $id_job_vacant) }}"><button type ="button" class="btn btn-primary">Create assessment form</button></a>

</div>

	


@stop