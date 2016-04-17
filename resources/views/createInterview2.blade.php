@extends('layouts.master')
<?php
session_start();
$countApp = count($applicant);
?>

@section('content')
<h1>Create Interview Schedule</h1>
<?php 
// if(isset($_SESSION['a'])&& ($_SESSION['a'])=='true') {
// 	echo 'masuk if';
// 	echo '<label>You have assign an Applicant</label>';
// }
?>
<div class="container">
	<div class="col-md-8">
		<div class="form-group">
			<label for="jobvacant">Job Vacant</label>
			<input id='ijv' value="{{$jobvacant->posisi_ditawarkan}} - {{$jobvacant->nama_company}}"class="form-control" readonly></input>
		</div>
		<div class="form-group">
			<label>Interview Ke </label>
			<input id='invk' value="{{$interviewke}}"class="form-control" readonly></input>  
		</div>
		<div class="form-group">
			<label for="jobvacant">Interviewer</label>
			@foreach($interviewer as $iv)
			<input value="{{$iv->nama_users}}"class="form-control" readonly></input>
			@endforeach
		</div>
		@if(isset($_SESSION['a']))
			<h4>You have assign an Applicant</h4>
		@endif
		<h3>Set Applicant</h3>
		<div class="desc-group inline">
			@if($countApp !='0')
			<h4>There are {{$countApp}} applicants need to be assign :</h4>
			<table border="0">	
				
				<tbody>
					@foreach ($applicant as $a)
					<tr>
						<td>
							<a href="{{ URL::to('SetApplicant/' . $a->id_applicant.'-'.$jobvacant->id_job_vacant.'-'. $interviewke)}}">
								<h5>{{ $a->nama_applicant }}</h5> 
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

</body>
@stop