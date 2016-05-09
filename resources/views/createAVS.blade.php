@extends('layouts.master')

@section('content')
<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript">
	function getForm(val){
		window.location = 'AvailableSchedule/'+val;
	}
</script>
<?php
	$temp = count($jobvacant);
?>
<h1>Create Available Schedule</h1>
<div class="form-group">
	<div class="col-md-8">
	@if($temp==0)
		<h4>You are not involved in any job vacant</h4>
	@else
		<h4>Please Choose a Job Vacant</h4>
		<div class="table-responsive">
			<table class="table">  
				<thead>
					<tr>
						<th>Job Vacant</th>              
						<th>Division</th>
						<th>Company</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jobvacant as $jv)
					<tr>
						<td>
							<label>
							<option id = 'ijv' value='{{$jv->id_job_vacant}}' onclick="getForm(this.value)">{{$jv->posisi_ditawarkan}}</option>
							</label>
						</td>					
						<td>{{ $jv->nama_divisi }}</td>
						<td>{{ $jv->nama_company }}</td>
						@endforeach
					</tr>
				</tbody>
			</table>
		</div>
	@endif
	<a href="{{url('/Schedule')}}"><input type="button" class = "btn btn-default" value="Back"></a>
	</div>
</div>

@stop