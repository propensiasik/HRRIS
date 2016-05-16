
@extends('layouts.master')


@section('content')

<section id="content">
	<div class = "container">
		
		<div class="table-responsive">
        	<table class="table">
            	<thead>
                    <tr>
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

<br>
<div class="container">
	<div class="col-md-8">
		<div class="table-responsive">
			<table id="searchTable" class="table" style="margin-left:25%; margin-right:15%;">	
				<thead>	
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="3"> 
							<br>
							<p style="text-align: center;"> <strong>{{ 'Search not found' }}</strong> </p>
						</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection