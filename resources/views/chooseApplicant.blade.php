<?php 
	session_start();
?>
@extends('layouts.master')

@section('content')

<div class = "container">
	<h1>Choose Applicants</h1>

<br><br>

	<h4> Choose For: {{ $statusFor }} </h4> <br>
		<div class="table-responsive">
			<table class="table">	
				<thead>	
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
						<th>Choose</th>
					</tr>
				</thead>
				<tbody>
			        
			        {!!  Form::open(array('action' => 'ApplicantController@choose')) !!}
			        <!-- <form method="POST"> -->
				        <input type="text" name="status" value="{{ $status }}" style="display: none"></input>
				        @foreach ($applicants as $applicant)
						<tr class="app">
							<td>
								<a href="{{ URL::to('applicant/profile/' . $applicant->id_applicant) }}" target="_blank">
									{{ $applicant->nama_applicant }}
								</a>		
							</td>
							<td> 
								{{ $applicant->posisi_ditawarkan }}
							</td>
							<td>
								{{ $applicant->nama_company }}
							</td>
							<td>
								<select name="{{ $applicant->id_applicant }}" class="form-login">
									<option value="0"> no change </option>
	            					<option value="1"> Accept </option>
	            					<option value="2"> Reject </option>
	            				</select>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="3"></td>
							<td> 
								<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Choose</button>
								<!-- <br> <br> -->
								<a href="{{ URL::to('Applicants')}}"> 
									<button type="button" class="btn-danger">Cancel</button>
								</a>

								<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="gridSystemModalLabel">Confirm choose applicant</h4>
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
												<button type="submit" class="btn btn-secondary">Yes</button>

											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>

            		{!! Form::close() !!}
            		</form>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection