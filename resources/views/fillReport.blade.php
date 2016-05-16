@extends('layouts.master')
@section('content')
<script type="text/javascript">
	function submitForm() {
    document.getElementById("submitForm").submit();
}
</script>
<div class = "container">
	<h1> Assessment Report - {{$applicant->nama_applicant}}</h1>
	<h4>Form Filler : {{ $report->nama_users }}</h4>
	<div class="desc-group inline">
		<br>
		<form id ='submitForm' method="post" action="{{ url('FillReportYaa/') }}">
			<input name='id_applicant' style="display: none" value="{{$applicant->id_applicant}}"></input>
			<input name='user' style="display: none" value="{{$report->email_users}}"></input>
			<table border="1">
				<thead>
					<th><h5 style="text-align: center;">Competency</h5></th>
					<th><h5 style="text-align: center;">Grade (0-100)</h5></th>
				</thead>
				@foreach ($competency as $comp)
				<input name='competency[]' style="display: none" value="{{$comp->nama_kompetensi}}"></input>
				<tr>
					<td> <h5> {{ $comp->nama_kompetensi }} </h5></td>
					<td> <input type="text" style="text-align: center;" name='nilai[]'></input> </td>
				</tr>
				@endforeach
			</table>

			<br>
			<h4> Comments:</h4>
			<h4> {!! Form::label('user', $report->nama_users ) !!} </h4>
			<textarea name="comment" style="width: 550px; height: 100px;"> {{ $report->isi_report }}</textarea>
			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<br>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Save</button>
			<a href="{{url('/applicant/profile/report/'.$applicant->id_applicant)}}"><input type="button" class = "btn btn-default" value="Back"></a>
		</form>


	</div>

</div>
<!-- Pop Up -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="gridSystemModalLabel">Confirm Save</h4>
					</div>

					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								Are you sure want to save this?
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<button type="button" class="btn btn-secondary" onclick="submitForm()">Yes</button>
					</div>

				</div>
			</div>
		</div>
@stop