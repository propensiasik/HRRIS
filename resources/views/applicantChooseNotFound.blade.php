@extends('layouts.master')

@section('content')

<div class = "container">
		
    <!--Judul-->
        <h1>Choose Applicants</h1>

        <br><br>
                      
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

<div class="col-md-3"> 
<h4>Filter</h4>
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

			<br><br>

			<select class="selectpicker" name="ambilgender" id="selection">
					<option value="none">None</option>
		            <option value="M">Male</option>
		            <option value="F">Female</option>
		    </select>

		   <br><br>
         <input class ="btn btn-secondary" type="submit" value="Filter">

     </div>

    </form>
{!! Form::close() !!}
</div>

<div class="col-md-9">
		<h4> Choose For: {{ $statusFor }} </h4> <br>
		<div class="table-responsive">
			<table id="searchTable" class="table">	
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