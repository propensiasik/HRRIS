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
		invk = document.getElementById("invk").value;
		type = f.options[f.selectedIndex].value;
		dt = e.options[e.selectedIndex].value;
		window.location = 'SaveNewInterview/'+dt+'-'+type+'-'+id_app+'-'+id_jv+'-'+invk;
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
			<option value="">Select Date - Time</option>
			@foreach ($available_schedule as $av)
			<option id = "opt" value="{{$av->id_av_schedule}}" >{{$av->available_date}} - {{$av->available_time}}</option>
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
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Save</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-cancel">Cancel</button>

		<!-- Pop Up -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">Confirm Schedule</h4>
					</div>

					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								Are you sure want to save this?
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<button type="button" class="btn btn-secondary" onclick="save()">Yes</button>
					</div>

				</div>
			</div>
		</div>

		<div class="modal fade bs-example-modal-cancel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">Cancel Change</h4>
					</div>

					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								Are you sure want to go back?
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<a href="{{URL::to('/CreateInterview/'.$jobvacant.'-'.$interviewke)}}"> <button type="button" class="btn btn-secondary">Yes</button></a>
					</div>

				</div>
			</div>
		</div>

		<!-- <button type="button" class="btn btn-primary" onclick="save()">Save</button> -->
		<!-- <a href="{{url('/CreateInterview/'.$jobvacant.'-'.$interviewke)}}"><button class='btn btn-primary' style='margin-left: 2%'>Cancel</button></a>
	--></form>
</div>
</div>
@section('content')
@stop
