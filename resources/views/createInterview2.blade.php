@extends('layouts.master')
<?php
$countApp = count($applicant);
?>
@section('content')
<h1>Create Interview Schedule</h1>
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
		<h3>Set Applicant</h3>
		<div class="desc-group inline">
			@if($countApp !='0')
			<h4>There are {{$countApp}} applicants need to be assign :</h4>
			<div class='col md 12'>
				<table border="0" class="table">	
					<thead>
						<tr>
							<th>Applicant Name</th>              
						</tr>
					</thead>
					<tbody>
						@foreach ($applicant as $a)
						<tr>
							<td>
								<a href="{{ URL::to('SetApplicant/' . $a->id_applicant.'-'.$jobvacant->id_job_vacant.'-'. $interviewke)}}">
									<h5 id="applicant">{{ $a->nama_applicant }}</h5>
								</a>	
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<h4>All Applicants have assigned</h4>
				@endif
			</div>
		</div>
	</div>
	<a href="{{url('/CreateInterview')}}"><input type="button" class = "btn btn-default" value="Back"></a>
</div>
</body>
@stop