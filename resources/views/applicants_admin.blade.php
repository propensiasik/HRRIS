<?php 
	session_start();
?>
@extends('layouts.master_admin')

@section('title')
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
                      	<div class="form-group"><h1>Applicants</h1></div>
                      </th>
                      	<!-- <form action="" method="POST"> -->
                      	{!! Form::open(['url' => 'Applicants']) !!}
                      		<th>
		                      	<!--Filter-->
		                      	<div class="form-group" name="status">
		            				<select class="selectpicker" name="status" id="selection">
		                				<option value="Interview 1">Interview 1</option>
		                				<option value="Interview  2">Interview 2</option>
		                				<option value="Offering Letter">Offering Letter</option>
		                				<option value="Hire">Hire</option>
		            				</select>
		          				</div>
	                      	</th>
                      	<!-- </form> -->
                      	{!! Form::close() !!}

                      <th>
                      	<!--Search-->
                      	{!!  Form::open(array('action' => 'ApplicantController@getSearch')) !!}
                      	<!-- <form name="myform" action="{{URL::action('ApplicantController@getSearch')}}" method="post"> -->
							<div class="form-group">
	            				<div class="input-group">
	            					{!!  Form::text('keyword') !!}
	              					<!-- <input type="text" class="form-control" id="search" name="search" placeholder="Search for...">
	            					}
 -->	              				<span class="input-group-btn">
 									<!-- {!! Form::submit('submit') !!} -->
	                				<button class="btn-search" type="submit"><img src="{{asset('img/search.png')}}"></button>
	              					</span>
	            				</div><!-- /input-group -->
	        				</div>
        				<!-- </form> -->
        				{!! Form::close() !!}
        			  </th>
         			</tr>
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
						<th>No.</th>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
						<th colspan="1"></th>
					</tr>
				</thead>
				<tbody>
			        <?php $i = 0; ?>
			        @foreach ($applicants as $applicant)
			        <?php $i++; ?>
					<tr>
						<td>
							{{ $i }}		
						</td>
						<td>
						
								{{ $applicant->nama_applicant }}
									
						</td>
						<td> 
							{{ $applicant->posisi_ditawarkan }}
						</td>
						<td>
							{{ $applicant->nama_company }}
						</td>
						<td align="right">
							<a href="{{ url('Applicants/delete/'.$applicant->id_applicant.'') }}" onclick="return confirm('Are you sure you want to delete?')">
                                <button class = "btn btn-danger">Delete</button>
                            </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>



 <!-- Pop Up -->

<!-- <div id="modal-from-dom" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="gridSystemModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            Are you sure want to delete this?
                    	</div>
                	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal">No</button>
                    <a class = "btn btn-default" action="{{ url('Applicants/delete/'.$applicant->id_applicant.'') }}">Yes</a>
                </div>
        	</div>
    	</div>
	</div> -->  

@endsection