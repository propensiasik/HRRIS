<?php
$countSchedule = count($schedule);
?>
@extends('layouts.master')
@section('content')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>


<h1>Interview Schedule</h1>
@if($countSchedule > 0)
<table style="width:50%" class="table">
	<thead>
		<th>Date</th>
		<th>Time</th>
		<th>Type</th>
		<th>Applicant</th>
		<th>Available Position</th>
	</thead>

	@foreach ($schedule as $sc)
		<!-- <tr>
			<td>{{$sc->posisi_ditawarkan}}</td>
		</tr> -->
		@if($_SESSION['booleanRole']=='0'&& $sc->keterangan ==1)
		<tr>
			<td>
				{{$sc -> available_date}}
			</td>

			<td>
				{{$sc -> available_time}}
			</td>

			<td>
				{{$sc -> cara_wawancara}}
			</td>

			<td>
				{{$sc -> nama_applicant}}
			</td>
			<td>
				{{$sc -> posisi_ditawarkan}}
			</td>
		</tr>
		@elseif($_SESSION['email']===$sc->email_users)
		<tr>
			<td>
				{{$sc -> available_date}}
			</td>

			<td>
				{{$sc -> available_time}}
			</td>

			<td>
				{{$sc -> cara_wawancara}}
			</td>

			<td>
				{{$sc -> nama_applicant}}
			</td>
			<td>
				{{$sc -> posisi_ditawarkan}}
			</td>
		</tr>
		
		@endif
		@endforeach
	</table>
	@else
	<h4>There are no interview schedule for you </h4>
	@endif

	<div class="vertical-separator"></div>
	@if($_SESSION['booleanRole']=='0')
	<a href="{{url('/CreateInterview')}}"><button type="submit" class="btn btn-primary" id="HR">Create Interview Schedule</button></a>
	<a href="{{url('/UpdateInterview')}}"><button type="submit" class="btn btn-primary" id="HR">Update Interview Schedule</button></a>
	@else
	<a href="{{url('/AvailableSchedule')}}"><button type="submit" class="btn btn-primary" id="R">Create Available Schedule</button></a>
	@endif
	@stop