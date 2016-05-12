	@extends('layouts.master')

	@section('content')
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datetimepicker.css')}}">
	</head>
	<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript">
		
	</script>
	<h1>Create Available Schedule</h1>

	<div class="col-md-8">
		<div class="form-group">
			<label>Job Vacant</label><br/>
			<input class='form-control' readonly value="{{$detail->posisi_ditawarkan}}">
		</div>
		<div class="form-group">
			<label>Total Applicant</label><br/>
			<input class='form-control' readonly value="{{$jumlah}}">
		</div>
		@if($jumlah === 0)
		<h4>There are no Applicant yet.</h4>
		<a href="{{url('/AvailableSchedule')}}"><input type="button" class = "btn btn-default" value="Back"></a>
		@else
		<div class="form-group">
			@if($jmlh_schedule === 0)
			<h4>You don't have any available schedule yet.</h4>
			<button class="btn btn-secondary"data-toggle="modal" data-target=".bs-example-modal-avg">Create New</button>
			<a href="{{url('/AvailableSchedule')}}"><input type="button" class = "btn btn-default" value="Back"></a>
			@else
			<div class="table-responsive">
				<table class="table">  
					<thead>
						<tr>
							<th>Date</th>              
							<th>Time (24 Hour Format)</th>
							<th>Used for Interview</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>@foreach($avs as $av)
							<td>{{$av->available_date}}</td>
							<td>{{$av->available_time}}</td>
							<td>
								@if($av->is_used=='1')
								<p>Yes</p>
							</td>
							<td></td>
							@else
							No
						</td>
						<td>
							<a href="{{URL::to('AvailableSchedule/Delete/' . $av->id_av_schedule.'-'.$detail->id_job_vacant) }}">
								<button type="button"  class="btn btn-default"><img src="{{asset('img/Icon - Delete.png')}}"> Delete</button>
								</a>
							</td>
							@endif

						</tr>
					</tbody>
					@endforeach
				</table>
				@if($jmlh_schedule >= $jumlah)
				<h5>You have already enough schedule for this job vacant, need more?</h5>
				<button class="btn btn-secondary" data-toggle="modal" data-target=".bs-example-modal-avg">Create New</button>
				<a href="{{url('/AvailableSchedule')}}"><input type="button" class = "btn btn-default" value="Back"></a>
				@else
				<h5>Need more schedule for this job vacant</h5>
				<button class="btn btn-secondary" data-toggle="modal" data-target=".bs-example-modal-avg">Create New</button>
				<a href="{{url('/AvailableSchedule')}}"><input type="button" class = "btn btn-default" value="Back"></a>
				@endif

				@endif
			</div>
		</div>
		@endif	
	</div>
	<!-- PopUp New -->
	<div class="modal fade bs-example-modal-avg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-avg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="gridSystemModalLabel">New Available Schedule</h4>
				</div>

				<div class="modal-body">
					<form action = "{{url('/AvailableSchedule/Create/'.$detail->id_job_vacant)}}" method="POST">
						<div class="container-fluid">
							<div class="row">
								<div class='input-group date'>
									<span class="input-group-addon">
										<button class="btn btn-default" type="button">
											<img src="{{asset('/img/Icon - Calendar.png')}}"> Pick a Date & Time
										</button>	
									</span>
									<input type='text' class="form-control" name='date' placeholder="Date & Time" required />
								</div>
								<h5>Note for this schedule :</h5>
								<input type='textarea' class="form-control" name='note' placeholder="Write a note" />
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-secondary"> Yes</button>
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					</div>
				</form>
			</div>

		</div>
	</div>
	@stop
