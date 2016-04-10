@extends('layout.master')

@section('content')
	
	<h3> Lorembduaboqbfoqfoubweplqfuibewgcqvwuwfwewkruwew
	gcrbwqhsdsfgbasdfaifasopfnfnasdohasoda
	abdjsafbasufufesjbcuasbouv </h3>

	<h3>Hallo, these are available position you can apply :</h3>
	

	<?php 

		foreach ($jobs as $job) {
			echo $job -> posisi_ditawarkan;
			echo '<br/>';
		}

	?>
	<button type ="button" onclick="window.location='{{url("/registrasi")}}'">Apply</button>
	<!--<a href="{{action('JobvacantController@reg')}}"> <button>Apply</button> </a>-->
	
@stop