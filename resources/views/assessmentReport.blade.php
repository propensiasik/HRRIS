@extends('layouts.master')


@section('content')
<?php
$adaReport = count($interviewer);
?>

<section id="content">
	<div class = "container">
			
			<h1> Assessment Report - {{$nama_applicant->nama_applicant}}</h1>
 			@if($adaReport != 0)
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
	 				@foreach ($interviewer as $intr)
 					<td> <input type="text" style="text-align: center;"></input> </td>
 					@endforeach
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
 			<a href="{{url('FillReport/'.$nama_applicant->id_applicant)}}"><button class="btn btn-secondary">Fill Report</button></a>
 			@else
 				<h4>There are still no report</h4>
 				<a href="{{url('Report/'.$nama_applicant->id_applicant)}}"><button class="btn btn-secondary">Create Report</button></a>
			@endif
			<a href=""><button class="btn btn-default">Back</button></a>
	</div>

</section>

@endsection