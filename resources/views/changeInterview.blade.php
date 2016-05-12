@extends('layouts.master')
<?php

$cara = array('Skype','Meet','Phone Call');
?>
<script type="text/javascript">
	function save(){
		var e = document.getElementById("datetime");
		var f = document.getElementById("type");
		id_app = document.getElementById("id_app").value;
		id_jv = document.getElementById("id_jv").value;
		invk = document.getElementById("invk").value;
		jadwal_lama = document.getElementById("id_jadwal_lama").value;
		type = f.options[f.selectedIndex].value;
		dt = e.options[e.selectedIndex].value;
		//alert(type);
		window.location = 'Change/'+dt+'-'+type+'-'+id_app+'-'+id_jv+'-'+invk+'-'+jadwal_lama;
	}
</script>
<div class="container">
	<div style="display:none">
		<input id='id_app' value='{{$dataApplicant->id_applicant}}' >
		<input id='id_jv' value='{{$jobvacant}}' >
		<input id='invk' value='{{$interviewke}}' >
		<input id='id_jadwal_lama' value='{{$jadwal_lama->id_av_schedule}}' >
	</input>
</div>
<h1> {{ $dataApplicant->nama_applicant }} </h1>
<div class="col-md-6">
	<form>
		<h4>Date and Time</h4>
		<select id='datetime' class="form-control">
			<option value="">Select new schedule</option>
			@foreach ($available_schedule as $av)
			<option id = "opt" value="{{$av->id_av_schedule}}" >{{$av->available_date}} - {{$av->available_time}}</option>
			@endforeach
		</select>
		<br/>
		<h4>Interview Type</h4>

		<select id = 'type' class="form-control" >
			<option value="">Select new interview type</option>
			@foreach($cara as $a)
			@if($jadwal_lama->cara_wawancara != $a)
			<option value="{{$a}}">{{$a}}</option>
			@endif
			@endforeach
		</select>
		<div class="vertical-separator"></div>
		
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Change</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-cancel">Cancel</button>
		<!-- Pop Up -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">Confirm change</h4>
					</div>

					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
							Are you sure want to change this?
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
		<!-- Pop Up -->
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
						<a href="{{URL::to('/UpdateInterview/'.$jobvacant.'-'.$interviewke)}}"> <button type="button" class="btn btn-secondary">Yes</button></a>
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
