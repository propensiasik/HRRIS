@extends('layouts.master')
<?php

$countApp = count($applicant);
$countInterview = count($list_interview);
?>
@section('content')
<h1>Update Interview Schedule</h1>
<div class="container">
	<div class="col-md-8">
		<div class="form-group">
			<label for="jobvacant">Job Vacant</label><br/>
			<input id='ijv' value="{{$jobvacant->posisi_ditawarkan}} - {{$jobvacant->nama_company}}"class="form-control" readonly></input>
		</div>
		<div class="form-group">
			<label>Interview Ke </label><br/>
			<input id='invk' value="{{$interviewke}}"class="form-control" readonly></input>  
		</div>
		<div class="form-group">
			<label for="jobvacant">Interviewer</label><br/>
			@foreach($interviewer as $iv)
			<input value="{{$iv->nama_users}}"class="form-control" readonly></input><br/>
			@endforeach
		</div>
		@if($countInterview >0)
		<div class="table-responsive">
			<table class="table">  
				<thead>
					<tr>
						<th>Applicant Name</th>              
						<th>Date</th>
						<th>Time</th>
						<th>Type</th>
					</tr>
				</thead>
		@foreach ($list_interview as $li)
		
				<tbody>
					<tr>
						<td><a href="{{ URL::to('ChangeInterview/' . $li->id_applicant.'-'.$jobvacant->id_job_vacant.'-'. $interviewke)}}">
							{{$li->nama_applicant}}</a>
						</td>
						<td>
							{{$li->available_date}}
						</td>
						<td>
							{{$li->available_time}}
						</td>
						<td>
							{{$li->cara_wawancara}}
						</td>
					</tr>
				</tbody>
			
			@endforeach
			@else
			<h3>There are no interview schedule</h3>
			@endif
			</table>
			<a href="{{url('/UpdateInterview')}}"><input type="button" class = "btn btn-default" value="Back"></a>
		</div>
	</div>
</body>
@stop