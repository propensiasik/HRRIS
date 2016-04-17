@extends('layouts.master')
<?php
session_start();
?>
<script type="text/javascript">
	function save(){
		var e = document.getElementById("datetime");
		var f = document.getElementById("type");
		id_app = document.getElementById("id_app").value;
		id_jv = document.getElementById("id_jv").value;
		interviewKe = document.getElementById("invk").value;
		type = f.options[f.selectedIndex].value;
		dt = e.options[e.selectedIndex].value;
		//alert(id_app);
		alert('Do you really want to save this schedule?');
		window.location = 'SaveNewInterview/'+dt+'-'+type+'-'+id_app+'-'+id_jv+'-'+interviewKe;
	}
</script>
<div class="container">
	<div style="display:none">
	<input id='id_app' value='{{$dataApplicant->id_applicant}}' >
	<input id='id_jv' value='{{$jobvacant}}' >
	<input id='invk' value='{{$interviewke}}' >
	</input>
	</div>
	<h1> {{ $dataApplicant->nama_applicant }} </h1>
	<div class="col-md-6">
	<form>
		<h4>Date and Time</h4>
		<select id='datetime' class="form-control">
			<option value="">Select Date / Time</option>
			@foreach ($available_schedule as $av)
			<option id = "opt" value="{{$av->id_av_schedule}}" >{{$av->id_av_schedule}} - {{$av->available_date}} - {{$av->waktu}}</option>
			@endforeach
		</select>
		<br/>
		<h4>Interview Type</h4>

		<select id = 'type' class="form-control" >
			<option value="">Select Interview Type</option>
			<option>Skype</option>
			<option>Meet</option>
			<option>Phone Call</option>
		</select>
		<div class="vertical-separator"></div>
		<button type="button" class="btn btn-primary" onclick="save()">Save</button>
	</form>
	</div>
</div>
@section('content')
@stop
