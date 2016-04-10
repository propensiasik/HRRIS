@extends('layouts.master')

@section('content')

<?php
session_start();
?>
<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
  <script type="text/javascript">
  	var a = '<?php echo $_SESSION['booleanRole'] ?>';
  	
  	$(function(){
  		if(a !='0'){
  			$("button#HR").hide(1);	
  		}
  		if(a !='2'){
  			$("button#R").hide(1);	
  		}
  	});
  	
  	
  </script>
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
<div class="vertical-separator"></div>
        <a href="{{url('/CreateInterview')}}"><button type="submit" class="btn btn-primary" id="HR">Create Interview Schedule</button></a>
        <a href="{{url('#')}}"><button type="submit" class="btn btn-primary" id="R">Create Available Schedule</button></a>
@stop