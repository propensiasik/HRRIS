@extends('layouts.master_recruiter')

@section('title')
@endsection

@section('content')
<?php
	session_start();
?>

<div class="container">
	

	@foreach ($applicantProfile as $ap)
		<h1> {{ $ap->nama_applicant }} </h1>
	@endforeach
	<br>
	<div class="desc-group inline">
	<table border="0">
		<tr>
			<label> Status Applicant History: </label>
			<td> <p style="color: white;"> spc </p></td>
			<td> 
				@foreach ($applicantStatus as $as)
					<h5> {{ $as->posisi_ditawarkan }} </h5>
				@endforeach
			</td>
			<td> <p style="color: white;"> spc </p></td>
			<td>
				@foreach ($applicantStatus as $as)
					<h5> {{ $as->nama_status }} </h5>
				@endforeach
			</td>
			<td> <p style="color: white;"> spc </p></td>
			<td>
				@foreach ($applicantStatus as $as)
					<h5> {{ $as->tgl_konfirmasi }} </h5>
				@endforeach
			</td>
		</tr>
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
         <label for="status">Change Status : </label>
            <select id='valuestatus' class="status" name="status">
                <option value="S03">Interview 1</option>
                <option value="S04">Interview 2</option>
                <option value="S06">Offering Letter</option>
                <option value="S02">Reject</option>
                <option value="S07">Hire</option>
            </select>
           <input type="submit" value="Change">
    </div>  
    </form>
	
	</div>
	<div class="vertical-separator"></div>
	
	<div class="desc-group inline">
	<table border="0">
		<tr>
			<td> <label>Email</label> </td>
			<td> <p style="color: white;"> wspace </p></td>
			<td> 
				@foreach ($applicantProfile as $ap)
					<h5> {{ $ap->emai_applicant }} </h5>
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> Address </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					{{ $ap->alamat }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> Gender </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					@if($ap->gender == '0')
						{{$ap->gender = 'Woman'}}
					@else
						{{$ap->gender = 'Boy'}}
					@endif
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> Phone Number </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					{{ $ap->no_hp }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> University </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					{{ $ap->universitas }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> Major </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					{{ $ap->jurusan }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td> <label> Graduate Year </label> </td>
			<td> </td>
			<td> 
				@foreach ($applicantProfile as $ap)
					{{ $ap->thn_lulus }}
				@endforeach
			</td>
		</tr>
	</table>
</div>
	<br>
		<button type="button" class="btn btn-secondary"> View <br> Report </button>
		@foreach ($applicantCV as $cv)
		<?php 
		//<a href="{{ URL::to('applicant/profile/CV/' . $cv->id_applicant) }}"> <button type="button" class="btn btn-primary">View <br> CV</button></a>
		?>
		<a href="{{asset('cv/CVfile.pdf')}}"> <button type="button" class="btn btn-primary">
				View <br> CV</button>
		</a>
		@endforeach
		<a href="{{asset('portofolio/ChrisAvore_UX_Portfolio.pdf')}}"> <button type="button" class="btn btn-success"> View <br> Portofolio</button>

<!-- <br> <br>

<form action="{{ url('uploadFile') }}" enctype="multipart/form-data">

    <input type="file" name="file">
    <input type="submit">

</form> -->


@endsection

