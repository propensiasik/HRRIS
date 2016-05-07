<?php 
	session_start();
?>
@extends('layouts.master')

@section('title')
	Choose Applicant
@endsection

@section('content')

<section id="content">
	<div class = "container">
		
		<div class="table-responsive">
        	<table class="table">
            	<thead>
                    <tr>
                      <th width="420px">
                      	<!--Judul-->
                      	<div class="form-group"><h1>Choose Applicants</h1></div>
                      </th>

                      <!-- Choose Applicant -->
                      <!-- <th>
                      	{!!  Form::open(array('action' => 'ApplicantController@getListOfApplicantChoosen')) !!}
                      		{{ csrf_field() }}
                      		<div class="form-group">
					            <select class="selectpicker" id='valuestatus' class="status" name="status">
					                <option value="S01">Interview 1</option>
					                <option value="S03">Interview 2</option>
					                <option value="S04">Offering Letter</option>
					                <option value="S06">Hire</option>
					            </select>
	           				<th> 
	           					<div class="form-group">
	           						<button type="submit" class="btn btn-secondary">Choose</button> 
	           					</div>
	           				</th>
   							</div>  
                      	{!! Form::close() !!}
                      </th> -->


                      <!-- Search -->
<!--                       <th>
                      	{!!  Form::open(array('action' => 'ApplicantController@getSearch')) !!}
							<div class="form-group">
	            				<div class="input-group">
	            					{!!  Form::text('keyword') !!}
	              					<span class="input-group-btn">
	                				<button class="btn-search" type="submit"><img src="{{asset('img/search.png')}}"></button>
	              					</span>
	            				</div>
	        				</div>
        				{!! Form::close() !!}
        			  </th> -->

         			</tr>
         		</thead>
         	</table>
        </div>

	</div>

</section>

<div class="container">
	<div class="col-md-8">
		<h4> Choose For: {{ $statusFor }} </h4> <br>
		<div class="table-responsive">
			<table id="searchTable" class="table" style="margin-left:25%; margin-right:15%;">	
				<thead>	
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
						<th>Choose</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5"> 
							<br>
							<p style="text-align: center;"> <strong>{{ 'No applicant can be choose status' }}</strong> </p>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
			
		</div>
	</div>
</div>

@endsection