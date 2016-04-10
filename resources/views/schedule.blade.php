@extends('layout.master')

@section('content')

<?php
session_start();
$_SESSION['email']='anestanggang@gmail.com';
?>	
<table style="width:50%">
	
	<caption>Interview Schedule</caption>
	  <tr>
	    <th>Tanggal</th>
	    <th>Waktu</th>
	    <th>Cara</th>
	    <th>Applicant</th>
	  </tr>

	@foreach ($schedule as $sc) 
		@if($_SESSION['email']===$sc->email_users)
		<tr>
			<td>
    		{{$sc -> tgl_wawancara}}
    		</td>

    		<td>
			{{$sc -> waktu_wawancara}}
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
@stop