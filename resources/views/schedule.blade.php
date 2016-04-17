<?php
session_start();
?>
@extends('layouts.master')
@section('content')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
   
<table style="width:50%">
	
	<caption>Interview Schedule</caption>
	  <tr>
	    <th>Tanggal</th>
	    <th>Waktu</th>
	    <th>Cara</th>
	    <th>Applicant</th>
	  </tr>

	@foreach ($schedule as $sc)
		@if($_SESSION['booleanRole']=='0'&& $sc->keterangan ==1)
		<tr>
			<td>
    		{{$sc -> available_date}}
    		</td>

    		<td>
			{{$sc -> waktu}}
			</td>

			<td>
			{{$sc -> cara_wawancara}}
			</td>

			<td>
			{{$sc -> nama_applicant}}
			</td>

		</tr>
		@elseif($_SESSION['email']===$sc->email_users)
		<tr>
			<td>
    		{{$sc -> available_date}}
    		</td>

    		<td>
			{{$sc -> waktu}}
			</td>

			<td>
			{{$sc -> cara_wawancara}}
			</td>

			<td>
			{{$sc -> nama_applicant}}
			</td>

		</tr>
		@endif
		
		@endforeach
</table>
<div class="vertical-separator"></div>
		@if($_SESSION['booleanRole']=='0')
		<a href="{{url('/CreateInterview')}}"><button type="submit" class="btn btn-primary" id="HR">Create Interview Schedule</button></a>
		@else
        <a href="{{url('#')}}"><button type="submit" class="btn btn-primary" id="R">Create Available Schedule</button></a>
        @endif
@stop