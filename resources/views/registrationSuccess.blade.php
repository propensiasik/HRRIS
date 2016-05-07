@extends('master')

@section('title')
Job Vacant List
@endsection

@section('content')

<h1 style="text-align: center"> Congratulation {{ $nama }}!</h1>

<p> Your job applications as <b>{{ $posisi }}</b> has been registered 
	and will be processed further. Please wait for further information from us. Thank you for applying to our company.</p>

<div>
	<a href="{{url('/career')}}"><button type ="button" class="btn btn-primary">Back</button></a>
</div>

@stop