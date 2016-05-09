@extends('layouts.master')

@section('content')
<?php
session_start();
?>
<script type="text/javascript">
    function goBack() {
        window.location.href = 'ada/public/JobVacant/';
    }
</script>
<section id="content">

    <h1> Create Available Posistion</h1>

    <div class="row margin">
        <div class="col-md-6">

            {!! Form::open(['url' => 'CreateAvailablePosition']) !!}


            <div class="form-group">
             <label for="divisi">Division : </label>
             <select class="divisi" name="divisi">
                 @foreach($listDivisi as $divisi)
                 <option value="{{$divisi->id_divisi}}">{{$divisi->nama_divisi}} - {{$divisi->nama_company}}</option>
                 @endforeach
             </select>
         </div>  


         <div class="form-group">

            {!! Form::label('id','ID:',['class' => 'form-control','style'=>'display:none']) !!}

            {!! Form::text('id', $newID, ['class' => 'form-control','style'=>'display:none']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('jobname','Job name:') !!}<br/>

            {!! Form::text('jobname', null, ['class' => 'form-control','required']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('capacity','Personal Needed:') !!}<br/>

            {!! Form::text('capacity', null, ['class' => 'form-control','required']) !!}

        </div>


        <div class="form-group">
            {!! Form::label('requirement','Requirement :') !!}<br/>

            {!! Form::textarea('requirement', null, ['class' => 'form-control','required']) !!}
        </div>  
        {!! Form::submit('Save', null,['class' => 'btn btn-primary'])!!}
        <button class='btn btn-default' onclick="goBack()"  style='margin-left: 2%'>Cancel</button>
        {!! Form::close() !!}

    </div>
</div>

</section>

@stop