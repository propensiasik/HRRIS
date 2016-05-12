@extends('layouts.master_recruiter')


@section('content')


<section id="content">
	<div class = "container">
			
			@foreach ($nama_applicant as $name)
	 			<h1> Assessment Report - {{$name->nama_applicant}}</h1>
 			@endforeach
 			<div class="desc-group inline">

 			<br>
 			
 			<table border="1">
 				<tr>
 					<td> </td>
 					@foreach ($interviewer as $intr)
 					<td> <h5 style="text-align: center;"> {{ $intr->nama_users }} </h5> </td>
 					@endforeach
 				
 				</tr>
 				@foreach ($competency as $comp)
 				<tr>
	 				<td> <h5> {{ $comp->nama_kompetensi }} </h5></td>
	 				<td> <input type="text" style="text-align: center;"></input> </td>
	 				<td> <input type="text" style="text-align: center;"></input> </td>
	 				<td> <input type="text" style="text-align: center;"></input> </td>
 				</tr>
 				@endforeach
 			</table>

 			<br>
 			<h4> Comments:</h4>
 				@foreach ($interviewer as $intr)
 					<h4> {!! Form::label('user', $intr->nama_users ) !!} </h4>
 					<textarea readonly style="width: 550px; height: 100px;"> {{ $intr->isi_report }}</textarea>
 				@endforeach
	</div>

</section>

@endsection