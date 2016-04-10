@extends('layouts.master')
<?php
  session_start();
?>


@section('title')
	Job Vacant Information
@endsection

@section('content')

<h1 style="text-align: center"> Available Position Detail Infromation </h1>
<p>
  Lorem Ipsum

</p>
	<div>
  	<a href="#//{{ URL::to('/JobVacant/ReportForm/' . $idJobVacant) }}"><button type="submit" class="btn btn-primary">View report form</button></a>
  	<a href="{{ URL::to('/JobVacant/ReportForm/' . $idJobVacant) }}"><button type="submit" class="btn btn-primary">Update Information</button></a>
  	</div>
 

@stop