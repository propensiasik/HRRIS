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
<div class="note"><b>You can not change this assessment form, since this form is being used.</b></div>
</div>
<br>

<div>
	<a href="{{url('/JobVacant/ReportForm/' . $id_job_vacant) }}"><button type ="button" class="btn btn-primary">Back to view assessment form</button></a>

</div>

	


@stop