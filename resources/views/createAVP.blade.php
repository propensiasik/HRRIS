@extends('layouts.master')

@section('content')
<?php
	session_start();
?>

<section id="content">

    <h1> Create Available Posistion</h1>

    <div class="row margin">
        <div class="col-md-6">
    
    {!! Form::open(['url' => 'CreateAvailablePosition']) !!}

   
         <div class="form-group">
         <label for="divisi">Division : </label>
            <select class="divisi" name="divisi">
                <option value="DIV04">Analyst</option>
                <option value="DIV02">HR</option>
                <option value="DIV05">PM</option>
                <option value="DIV06">Programmer</option>
                <option value="DIV03">UI/UX</option>
            </select>
          </div>  

      
         <div class="form-group">

        {!! Form::label('id','ID:') !!}
        
        {!! Form::text('id', null, ['class' => 'form-control']) !!}
        </div>
      

        <div class="form-group">
        {!! Form::label('jobname','Job name:') !!}
        
        {!! Form::text('jobname', null, ['class' => 'form-control']) !!}
        </div>
     

        <div class="form-group">
        {!! Form::label('capacity','Capacity:') !!}
        
        {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
        
        </div>


        <div class="form-group">
        {!! Form::label('requirement','Requirement :') !!}
        
        {!! Form::textarea('requirement', null, ['class' => 'form-control']) !!}
        </div>
        

   {!! Form::submit('Save', null) !!}
   
    {!! Form::close() !!}

        </div>
    </div>

</section>

@stop