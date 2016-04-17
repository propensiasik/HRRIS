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

            {!! Form::label('id','ID:',['class' => 'form-control','style'=>'display:none']) !!}

            {!! Form::text('id', $newID, ['class' => 'form-control','style'=>'display:none']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('jobname','Job name:') !!}<br/>

            {!! Form::text('jobname', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('capacity','Capacity:') !!}<br/>

            {!! Form::text('capacity', null, ['class' => 'form-control']) !!}

        </div>


        <div class="form-group">
            {!! Form::label('requirement','Requirement :') !!}<br/>

            {!! Form::textarea('requirement', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">

            {!! Form::text('author_terkait0','anestanggang@gmail.com',['class' => 'form-control','style'=>'display:none']) !!}
            {!! Form::text('author_terkait1','khalilahunafa@gmail.com',['class' => 'form-control','style'=>'display:none']) !!}
        </div>
        <div class="form-group">
           <label for="author">Author : </label>
           <select class="author" name="author">
           <option value="diniseprilia@gmail.com">Dini Seprilia</option>
            <option value="anestanggang@gmail.com">Yohanes Sitanggang</option>
            <option value="khalilahunafa@gmail.com">Khalila Hunafa</option>
            <option value="ferrisaputra@gmail.com">Ferri Saputra</option>
            <option value="nabilaclydea@gmail.com">Nabila Clydea</option>
        </select>
    </div>  
    {!! Form::submit('Save', null) !!}

    {!! Form::close() !!}

</div>
</div>

</section>

@stop