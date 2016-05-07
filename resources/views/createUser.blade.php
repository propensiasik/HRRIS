@extends('layouts.master_admin')

@section('content')

<script>
    $('#state').on('change', function(e){
        console.log(e);
        var state_id = e.target.value;

        $.get('{{url('/Users/Create')}}', function(data) {
            console.log(data);
            $('#city').empty();
            $.each(data, function(index,subCatObj){
                $('#city').append(''+subCatObj.name+'');
            });
        });
    });
</script>

    <h1>Create User</h1>

    {!! Form::open(['url' => 'Users/Create']) !!}

<div class="form-group">
                    <div id="nav">
                        {!! Form::label('Nama') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('nama_users',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('nama_users') }}</div>
                    </div>
                </div>
            
                <div class="form-group">
                    <div id="nav">
                        {!! Form::label('Email') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('email_users',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('email_users') }}</div>
                    </div>
                </div>
            
                <div class="form-group">
                    <div id="nav">
                        {!! Form::label('Posisi') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('posisi',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('posisi') }}</div>
                    </div>
                </div>
             
                <div class="form-group">
                    <div id="nav">
                        {!! Form::Label('Divisi') !!} 
                    </div>
                    <div id="section">
                        {!! Form::select('id_divisi', $divisi, null, ['class' => 'form-control']) !!}
                        <div class="error">{{ $errors->first('id_divisi') }}</div>
                    </div>
                </div>
           
                <div class="form-group">
                    <div id="nav">
                        {!! Form::label('Password') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('password',null,['class'=>'form-control']) !!}
                    </div>
                </div>
           
                <div class="form-group">
                    <div id="nav">
                        {!! Form::label('role') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('role',null,['class'=>'form-control', 'id'=>'state']) !!} 
                        <div class="error">{{ $errors->first('role') }}</div>
                    </div>
                </div>

    <br>
    <div id="nav"></div>
    <div id="section">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>    
    {!! Form::close() !!}

@stop