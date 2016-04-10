@extends('layouts.master')

@section('content')

<section id="content">

	<h1> Create Available Posistion</h1>

	<div class="row margin">
        <div class="col-md-6">
	
	<div class = 'form-group'>
	{!! Form::open(['url' => 'create']) !!}
		
		
		{!! Form::label('subsidiaryname','Organization :') !!}
		
		{!! Form::select('subsidiary', array('Flipbox' => 'Flipbox', 
						'Contendr' => 'Contender', 
						'Definite' => 'Definite')) !!}



		<br>				

		{!! Form::label('jobname','Job Name :') !!}
		{!! Form::select('jobname', array('Programming' => 'Programming', 
						'UI/UX' => 'UI/UX', 
						'Analyst' => 'Analyst')) !!}
		<br>

		{!! Form::label('capacity','Capacity:') !!}
		
		{!! Form::text('capacity', null) !!}
		
		<br>


		{!! Form::label('requirement','Requirement :') !!}
		
		{!! Form::textarea('requirement', null) !!}
		
		<br>

		{!! Form::label('Jum','Author :') !!}
	
		{!! Form::text('npm', null) !!}
		

	</div>

	<br>

	{!! Form::submit('Save', null) !!}
		
	{!! Form::close() !!}

	</div>
	</div>

</section>

@stop