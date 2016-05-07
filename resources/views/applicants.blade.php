<?php 
	session_start();
?>
@extends('layouts.master')

@section('title')
	List of Applicants
@endsection

@section('content')

<section id="content">
	<div class = "container">
		
		<div class="table-responsive">
        	<table class="table">
            	<thead>
                      <th width="420px">
                      	<!--Judul-->
                      	<div class="form-group"><h1>Applicants</h1></div>
                      </th>

                      <!-- Choose Applicant -->
                      <th>
                      	{!!  Form::open(array('action' => 'ApplicantController@getListOfApplicantChoosen')) !!}
                      		<div class="form-group">
					            <select class="selectpicker" id='valuestatus' class="status" name="status">
					                <option value="1">Interview 1</option>
					                <option value="3">Interview 2</option>
					                <option value="4">Interview 3</option>
					                <option value="5">Offering Letter</option>
					                <option value="6">Hire</option>
					            </select>
	           						<button type="submit" class="btn btn-secondary">Choose</button> 
   							</div>  
                      	{!! Form::close() !!}
                      </th>


                      <!-- Search -->
                      <th>
                      	{!!  Form::open(array('action' => 'ApplicantController@getSearch')) !!}
							<div class="form-group">
	            				<div class="input-group">
	            					{!!  Form::text('keyword') !!}
	                				<button class="btn-search" type="submit"><img src="{{asset('img/search.png')}}"></button>
	            				</div>
	        				</div>
        				{!! Form::close() !!}
        			  </th>
         		</thead>
         	</table>
        </div>

	</div>

</section>

{!!  Form::open(array('action' => 'ApplicantController@filter')) !!}
<form method="POST">
	{{ csrf_field() }}
	<div class="form-group">
         
            <select class = "selectpicker" name="ambilposisi" id="selection">  
					<option value="none">None</option>
				@foreach ($jobs as $job)
					<option value="{{$job->posisi_ditawarkan}}">{{$job->posisi_ditawarkan}}</option>
					{{ Form::label('ambilposisi', $job->posisi_ditawarkan) }}<br>
				@endforeach
			</select> 

			<select class="selectpicker" name="ambilgender" id="selection">
					<option value="none">None</option>
		            <option value="M">Male</option>
		            <option value="F">Female</option>
		    </select>

         <input class ="btn btn-secondary" type="submit" value="Filter">

     </div>

    </form>
{!! Form::close() !!}

<br>
<div class="container">
	<div class="col-md-8">
		<div class="table-responsive">
			<table border="0" id="searchTable" class="table" style="margin-left:25%; margin-right:15%;">	
				<thead>	
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
					</tr>
				</thead>
				<tbody>
			       
			        @foreach ($applicants as $applicant)
			       
					<tr>

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
					</tr>
					@endforeach
					<tr>
						<td colspan="3"> <br> <p> Total Applicants: {{ $count }} </p></td>
					</tr>
			</table>
			<table id="searchTable" style="margin-left:55%; margin-right:10%; ">	
					<tr>
						<td> 
							 <p> {!! $applicants->render() !!} </p>
						</td>
					</tr>

			</table>
		</div>
	</div>
</div>

@endsection