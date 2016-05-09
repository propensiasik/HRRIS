@extends('layouts.master')
<?php 
	session_start();
?>
@section('content')

<section id="content">
	<h1> Registration Form</h1>

        <div class="col-md-6">
	
		<div class = 'form-group'>

	{!! Form::open(['url' => 'jobvacant']) !!}
	

		{!! Form::label('id_applicant','ID :') !!}
		
		{!! Form::text('id_applicant', null) !!}

	<br>

		{!! Form::label('nama_applicant','Name :') !!}
	
		{!! Form::text('nama_applicant', null) !!}
	

	<br>

		{!! Form::label('email_applicant','Email:') !!}
		
		{!! Form::text('email_applicant', null) !!}
	

	<br>

		{!! Form::label('alamat','Address :') !!}
		
		{!! Form::text('alamat', null) !!}
		

	<br>

		{!! Form::label('gender','Gender :') !!}
		
		{!! Form::text('gender', null) !!}
		

	<br>

		{!! Form::label('no_hp','Phone :') !!}
	
		{!! Form::text('no_hp', null) !!}
		

	<br>

		{!! Form::label('universitas','University :') !!}
		
		{!! Form::text('universitas', null) !!}
		

	<br>

		{!! Form::label('jurusan','Magor :') !!}
		
		{!! Form::text('jurusan', null) !!}
		

	<br>
		{!! Form::label('ipk','GPA :') !!}
		
		{!! Form::text('ipk', null) !!}
		

	<br>

		{!! Form::label('thn_lulus','Graduate Year :') !!}
		
		{!! Form::text('thn_lulus', null) !!}
		

	<br>


	<h4> What positions you want to apply? </h4>
	
		
		<?php 
			$all_data = array();
			foreach($jobs as $job){
			     $all_data[] =  $job->posisi_ditawarkan;
			}
		?>

	 <div class="checkbox">
     
		@foreach ($jobs as $job)
		    {{ Form::checkbox('job[]', $job->posisi_ditawarkan, in_array($job->posisi_ditawarkan, $all_data)) }}
		    {{ Form::label('job', $job->posisi_ditawarkan) }}<br>
		@endforeach

	
	</div>
	
	<br>

    {!! Form::file('image') !!}

    <br> 
	
	{!! Form::submit('Save', null, ['class' => 'btn btn-primary form-control' ]) !!}
	</div>

		
	{!! Form::close() !!}

	
	</div>
</section>

@stop