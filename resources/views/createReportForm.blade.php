@extends('layouts.master')
<?php 
    session_start();
?>

@section('title')
	Create Report Form
@endsection

@section('content')
<h1 style="text-align: center"> Create Report Form </h1>
<br>
	<div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">	
                  <tbody>
					<tr>
						<td>Job vacancy</td>
						<td>{{ $nama_jv}}</td>
					</tr>
					<tr>
						<td>Business function</td>
						<td>{{ $nama_divisi }}</td>
					</tr>
					<tr>
						<td>Company</td>
						<td>{{ $nama_company }}</td>
					</tr>
                  </tbody>
                </table>
              </div>  
    </div>
    <div>
         <label>Competency List :</label>
            <form>

               @foreach($competency as $competency)
                <label>
                <input type="checkbox" />
                <span class="lbl padding-8">{{$competency->nama_kompetensi}}</span>
                </label><br/>
                @endforeach
            
            </form>
    </div>

        <div>
        	<button type ="submit">Save</button>
        </div>
      



@stop



