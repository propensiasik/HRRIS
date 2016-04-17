<?php 
	session_start();
?>
@extends('layouts.master')

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
		                      <th>
		                      	<!--Choose-->
		                      	<div class="form-group">
								<button type="button" class="btn btn-secondary">Choose</button>
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
						<!-- <th>Choose</th> -->
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
							<a href="{{ URL::to('applicant/profile/' . $applicant->id_applicant) }}">
								{{ $applicant->nama_applicant }}
							</a>		
						</td>
						<td> 
							{{ $applicant->posisi_ditawarkan }}
						</td>
						<td>
							{{ $applicant->nama_company }}
						</td>
						<!-- <td>
							<div class="checkbox" id="show">
            					<label>
              						<input type="checkbox" />
              						<span class="lbl padding-8">Yes</span>
            					</label>
            					<label>
              						<input type="checkbox" />
              						<span class="lbl padding-8">No</span>
            					</label>
          					</div>
						</td> -->
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
	// $(document).ready(function() {
	// 	$('#search').keyup(function() {
	// 		searchTable($(this).val());
	// 	});
	// });
	// function searchTable(inputVal) {
	// 	var table = $('#searchTable');
	// 	table.find('tr').each(function(index, row) {
	// 		var allCells = $(row).find('td');
	// 		if (allCells.length > 0) {
	// 			var found = false;
	// 			allCells.each(function(index, td) {
	// 				var regExp = new RegExp(inputVal, 'i');
	// 				if (regExp.test($(td).text())) {
	// 					found = true;
	// 				}
	// 			});
	// 			if (found == true)
	// 				$(row).show();
	// 			else
	// 				$(row).hide();
	// 		}
	// 	});
	// }
	// // source: http://www.a2ztechguide.com/2011/11/jquery-to-search-text-in-html-table.html
</script>

@endsection