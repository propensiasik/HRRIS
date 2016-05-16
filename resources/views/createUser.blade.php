@extends('layouts.master_admin')

@section('content')

    <h1>Create User</h1>

    <br><br>

    {!! Form::open(['url' => 'Users/Create']) !!}

            <div class="row margin">
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::label('Name') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('nama_users',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('nama_users') }}</div>
                    </div>
                </div>
            </div>
            <div class="row margin">
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::label('Email') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('email_users',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('email_users') }}</div>
                    </div>
                </div>
            </div>
            <div class="row margin">
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::label('Position') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('posisi',null,['class'=>'form-control']) !!}
                        <div class="error">{{ $errors->first('posisi') }}</div>
                    </div>
                </div>
            </div>
            <div class="row margin"> 
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::Label('Division') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::select('id_divisi', $divisi, null, ['class' => 'form-control']) !!}
                        <div class="error">{{ $errors->first('id_divisi') }}</div>
                    </div>
                </div>
            </div>
            <div class="row margin">
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::label('Password') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('password',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row margin">
                <div class="form-group">
                    <div class="col-md-3">
                        {!! Form::label('role') !!} 
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('role',null,['class'=>'form-control', 'id'=>'state']) !!} 
                        <div class="error">{{ $errors->first('role') }}</div>
                    </div>
                </div>
            </div>

    <br>
    <div class="col-md-3"></div>
    <div class="col-md-9">
        <!-- {!! Form::submit('Save', ['class' => 'btn btn-success']) !!} -->
        <button type="submit" class="btn btn-success"><img src="{{asset('img/check.png')}}">Save</button>
        <a href="{{ URL::to('Users')}}"> 
            <button type="button" class="btn btn-danger"><img src="{{asset('img/cancel.png')}}">Cancel</button>
        </a>
    </div>    
    {!! Form::close() !!}

@stop