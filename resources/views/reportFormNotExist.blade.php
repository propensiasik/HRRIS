@extends('master')


@section('title')
	Report Form
@endsection


@section('content')

<div>
	<p>Job Vacancy berikut belum memiliki report form.
	 Untuk membuat report form silahkan pilih menu dibawah ini.</p>
</div>

<div>
	<button type ="button" onclick="window.location='{{url("/JobVacant/ReportForm/CreateReportForm/" . $id_job_vacant)}}'">Create report form</button>


</div>

	


@stop