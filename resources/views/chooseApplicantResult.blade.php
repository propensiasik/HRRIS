<?php 
	session_start();
?>
@extends('layouts.master')

@section('title')
	Preview - Choose Applicant
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
         		</thead>
         	</table>
        </div>

	</div>

</section>


<div class="container">
	
	<div class="col-md-8">
		<h4> Choose Applicant Preview - {{ $statusFor}}</h4> <br>
		<div class="table-responsive">
			<table id="searchTable" class="table" style="margin-left:25%; margin-right:15%;">	
				<thead>	
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
			        	@if(count($array_result) == 0)
			        		<tr> 
			        			<td colspan="4"> <p style="text-align: center;"><strong>{{ 'No applicant is choosed' }}</strong></p> </td> 
			        		</tr>
			        	@else
					        @foreach ($array_result as $result)
							<tr class="app">
								<td>
									{{{ $result['name'] }}}		
								</td>
								<td> 
									{{{ $result['posisi'] }}}
								</td>
								<td>
									{{{ $result['company'] }}}
								</td>
								<td>
									@if($result['status_choosen'] == 1) 
										{{ 'ACCEPT' }}
									@else
										{{ 'REJECT'	 }}
									@endif
								</td>
							</tr>
							@endforeach
						@endif
						<tr>
							<td colspan="2"></td>
							<td colspan="2">
								<br>	 
								<a href="{{ URL::to('Applicants')}}"> 
									<button style="align-items: center;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Back to List of Applicants</button>
								</a>
							</td>
						</tr>

            		</form>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection