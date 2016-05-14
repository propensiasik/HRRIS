@extends('layouts.master_admin')

@section('title')
@endsection

@section('content')

	<div class = "container">

	<div class="top">			
		<!--Judul-->
		<div class="col-md-9">
			<h1 class="alignleft">Applicants</h1>
		</div>
		<!--Search-->
		<div class="col-md-3">
			<div class="alignright">
			<br>
			{!!  Form::open(array('action' => 'ApplicantController@getSearch')) !!}
			<div class="form-group">
		    	<div class="input-group">
		       		{!!  Form::text('keyword',null, ['class'=>'form-control', 'placeholder' => 'Search for...']) !!}
		       		<span class="input-group-btn">          
		        		<button class="btn-search" type="submit"><img src="{{asset('img/search.png')}}"></button>
		        	</span>
		    	</div>
			</div>
	   		{!! Form::close() !!}
    	</div>
    	</div>
    </div>

    <div class="col-md-3">

        <!--Filter--> 
        <h4>Filter</h4>          
		{!!  Form::open(array('action' => 'ApplicantController@filter')) !!}
			<form method="POST">
				{{ csrf_field() }}
				<div class="form-group"> 
					<h5>Position : </h5>
		            <select class = "selectpicker" name="ambilposisi" id="selection">  
							<option value="none">None</option>
						@foreach ($jobs as $job)
							<option value="{{$job->posisi_ditawarkan}}">{{$job->posisi_ditawarkan}}</option>
							{{ Form::label('ambilposisi', $job->posisi_ditawarkan) }}<br>
						@endforeach
					</select> 

					<br><br>

					<h5>Gender : </h5>
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
		
		<div class="table-responsive">
			<table class = "table">	
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
                                <button class="btn btn-default"><img src="{{asset('img/Icon - Delete.png')}}">Delete</button>
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