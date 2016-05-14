@extends('layouts.master')

@section('content')

<div class="container">
	
<div class="top">
	<div class="alignleft">
	@foreach ($applicantProfile as $ap)
		<h1> {{ $ap->nama_applicant }} </h1>
	@endforeach
	</div>
	<br>
	<div class="alignright">
		@foreach ($applicantProfile as $ap)

		<a href="{{ URL::to('applicant/profile/report/' . $ap->id_applicant) }}">
			<button type="button" class="btn btn-warning"> View Report </button>
		</a>

		<a href="{{ URL::to('applicant/profile/cv/' . $ap->id_applicant) }}"> 
			<button type="button" class="btn btn-default">View CV</button>
		</a>
		
		@if($ap->portofolio !== null)
		<a href="{{ URL::to('applicant/profile/portofolio/' . $ap->id_applicant) }}">
			<button type="button" class="btn btn-success"> View Portofolio</button>
		</a>
		@endif	

		@endforeach
	</div>
	
</div>
	
<div class="col-md-5">
<div class="well">
	<table border="0">
		<div class="form-group"><label> Status Applicant History: </label></div>
		@foreach ($applicantStatus as $as)
		<tr>
			<td> <p style="color: white;"> spc </p></td>
			<td> 
				<h5> {{ $as->posisi_ditawarkan }} </h5>
			</td>
			<td> <p style="color: white;"> spc </p></td>
			<td>
				<h5> {{ $as->nama_status }} </h5>
			</td>
			<td> <p style="color: white;"> spc </p></td>
			<td>
				<h5> {{ $as->tgl_notifikasi }} </h5>				
			</td>
		</tr>
		@endforeach
	</table> 
	
	<br>

	<form method="POST">
	{{ csrf_field() }}
	@foreach ($applicantProfile as $as)
		<input type="text" name="id_applicant" style="display:none" value="{{$as->id_applicant}}">
	@endforeach
	
	@foreach ($applicantStatus as $as)
		<input type="text" name="sla" style="display:none" value="{{$as->id_sla}}">
	@endforeach

	@foreach ($applicantStatus as $as)
		<input type="text" name="id_job" style="display:none" value="{{$as->id_job_vacant}}">
	@endforeach
	
	
	<div class="form-group">
         <label for="status">Change Status : </label><br><br>
         	<div class="input-group">
            <select id='valuestatus' class="status form-control" name="status">
                <option value="S03">Interview 1</option>
                <option value="S04">Interview 2</option>
                <option value="S06">Offering Letter</option>
                <option value="S02">Reject</option>
                <option value="S07">Hire</option>
            </select>
            <span class="input-group-btn">
           <input type="submit" value="Change" class="btn btn-secondary">
           </span>
           </div>
    </div>  
    </form>

</div>

</div>

<div class="col-md-7">

	<div class="desc-group inline">
	<table class="table">
		@foreach ($applicantProfile as $ap)
		<tr>
			<td> <label>Email</label> </td>
			<td> <!-- <p style="color: white;"> wspace </p> --></td>
			<td> 				
				 {{ $ap->email_applicant }} 
			</td>
		</tr>
		<tr>
			<td> <label> Address </label> </td>
			<td> </td>
			<td> 
				{{ $ap->alamat }}
			</td>
		</tr>
		<tr>
			<td> <label> Gender </label> </td>
			<td> </td>
			<td> 
				@if($ap->gender == 'F')
					{{ 'Female' }}
				@else
					{{ 'Male' }}
				@endif
			</td>
		</tr>
		<tr>
			<td> <label> Phone Number </label> </td>
			<td> </td>
			<td> 
				{{ $ap->no_hp }}
			</td>
		</tr>
		<tr>
			<td> <label> University </label> </td>
			<td> </td>
			<td>
				{{ $ap->universitas }}
			</td>
		</tr>
		<tr>
			<td> <label> Major </label> </td>
			<td> </td>
			<td> 
				{{ $ap->jurusan }}
			</td>
		</tr>
		<tr>
			<td> <label> Graduate Year </label> </td>
			<td> </td>
			<td>
				{{ $ap->thn_lulus }}
			</td>
		</tr>
		@endforeach
	</table>
	</div>

</div>
</div>
		

@endsection

