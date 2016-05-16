@extends('layouts.master')

@section('content')
<?php
$count = count($data);
?>
<div class = "container">		
	<h1> Assessment Report - {{$applicant->nama_applicant}}</h1><br>
	@if($count > 1)
	<div class="desc-group inline">
		@foreach($data as $data)
		<h4>{{$data->nama_users}} - {{$data->posisi}}</h4>
		<br>
		@if($data->nilai_kompetensi != '')
		<a href="{{url('FillReport/'.$applicant->id_applicant)}}" target="_blank"><button class="btn btn-secondary">Update Report</button></a>
		<br>
		<table border="1">
			<thead>
				<th><h5 style="text-align: center;">Competency</h5></th>
				<th><h5 style="text-align: center;">Grade</h5></th>
			</thead>
			<tbody>
				<?php
				$pecah2 = array();
				foreach ($data2 as $key) {
					$pecah = explode(',', $key->nilai_kompetensi);
					for($i=0;$i<count($pecah);$i++){
						$temp = explode('=', $pecah[$i]);
						array_push($pecah2, $temp);
					}
				}
				for($i=0;$i<count($pecah2);$i++){
					if($pecah2[$i][0]!=""){
						echo '<tr>';
						echo '<td> <h5>';echo $pecah2[$i][0];echo '</h5></td>';
						;echo '<td><input type="text" style="text-align: center;" readonly value="';
						echo $pecah2[$i][1];echo '"></input> </td>';
						echo '</tr>';
					}
				}
				?>
			</tbody>
		</table>
		<br>
		<p>masuk if</p>
		<h4> Comments:</h4>
		<textarea readonly style="width: 550px; height: 100px;" readonly> {{ $data->isi_report }}</textarea>
		@else
		<p>There is still no report from this user</p>
		@if($data->email_users == $_SESSION['email']&& $data->nilai_kompetensi =='')
		<a href="{{url('FillReport/'.$applicant->id_applicant)}}"><button class="btn btn-secondary">Fill Report</button></a>
		@endif
		<br>
		@endif
		@endforeach
	</div>
	@else
	<h4>There are still no report</h4>
 	<a href="{{url('Report/'.$applicant->id_applicant)}}"><button class="btn btn-secondary">Create Report</button></a>
	@endif
	<a href="{{url('applicant/profile/'.$applicant->id_applicant)}}"><button class="btn btn-default">Back</button></a>
</div>
@stop