@extends('layout.master')

@section('content')

<section id="content">
	<h1> Registration Form</h1>

	{!! Form::open(['url' => 'registrasi']) !!}
	
	<div class = 'form-group'>

		{!! Form::label('id_applicant','ID :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('id_applicant', null, ['class' => 'form-control' ]) !!}
	
		</div>

	<br>

		{!! Form::label('nama_applicant','Name :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('nama_applicant', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('email_applicant','Email:', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('email_applicant', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('alamat','Address :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('alamat', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('gender','Gender :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('gender', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('no_hp','Phone :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('no_hp', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('universitas','University :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('universitas', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('jurusan','Magor :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('jurusan', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>
		{!! Form::label('ipk','GPA :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('ipk', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>

		{!! Form::label('thn_lulus','Graduate Year :', ['class' => 'control-label col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('thn_lulus', null, ['class' => 'form-control' ]) !!}
		</div>

	<br>


	</div>
	<br>
	<br>
	<br>
		
		<h4> What positions you want to apply? </h4>
		<?php 
			$all_data = array();
			foreach($jobs as $job){
			     $all_data[] =  $job->posisi_ditawarkan;
			}
		?>
	
		@foreach ($jobs as $job)
		    {{ Form::checkbox('job[]', $job->posisi_ditawarkan, in_array($job->posisi_ditawarkan, $all_data)) }}
		    {{ Form::label('job', $job->posisi_ditawarkan) }}<br>
		@endforeach

	<br>

    {!! Form::file('image') !!}

    <br> 
	
	{!! Form::submit('Save', null, ['class' => 'btn btn-primary form-control' ]) !!}
		
	{!! Form::close() !!}
</section>

@stop