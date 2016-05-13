@extends('layouts.master_admin')

@section('content')

    <h1>Update User</h1>

    {!! Form::model($user,['method' => 'PATCH','route'=>['update',$user->email_users]]) !!}
    
    
                <div class="form-group">
                    <div id="nav">
                        {!! Form::label('Name') !!} 
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
                        {!! Form::label('Position') !!} 
                    </div>
                    <div id="section">
                        {!! Form::text('posisi',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('posisi') }}</div>
                    </div>
                </div>
             
                <div class="form-group">
                    <div id="nav">
                        {!! Form::Label('Division') !!} 
                    </div>
                    <div id="section">
                        {!! Form::select('id_divisi', $divisi, null, ['class' => 'form-control']) !!}
                        <div class="error">{{ $errors->first('divisi') }}</div>
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
                        {!! Form::text('role',null,['class'=>'form-control']) !!} 
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