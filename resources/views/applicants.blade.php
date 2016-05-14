
@extends('layouts.master')

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

    	<!--Choose-->
    	<h4>Choose Applicant for :</h4>               
        {!!  Form::open(array('action' => 'ApplicantController@getListOfApplicantChoosen')) !!}
            <div class="form-group">
				<select class="selectpicker" id='valuestatus' class="status" name="status">
					@if($_SESSION["booleanRole"] == '0')
						<option value="1">Interview 1</option>
						<option value="3">Interview 2</option>
						<option value="4">Interview 3</option>
						<option value="5">Offering Letter</option>
						<option value="6">Hire</option>
					@else
						<option value="1">Interview 1</option>
						<option value="3">Interview 2</option>
						<option value="4">Interview 3</option>
					@endif
				</select>
				<br><br>
	         	<button type="submit" class="btn btn-secondary">Choose</button> 
   			</div>  
        {!! Form::close() !!}

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
		<table class="table">	
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
			</tbody>
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