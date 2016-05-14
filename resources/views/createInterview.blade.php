@extends('layouts.master')
	
<script type="text/javascript">
	function test(val){
		var e = document.getElementById("posisi");
		var f = document.getElementById("interview");
		idjobvacant = e.options[e.selectedIndex].value;
		interviewKe= f.options[f.selectedIndex].value;
		window.location = 'CreateInterview/'+idjobvacant+'-'+interviewKe;
	}
</script>
@section('content')
<h1>Create Interview Schedule</h1>

<br><br>

<div class="form-group">
	<label for="jobvacant">Job Vacant</label> <br/>
	<select id='posisi'name='Jobvacant' class="form-control">
		<option>Select Job Vacant</option>
		@foreach($jobvacant as $jv)
		<option id = "opt" value="{{$jv->id_job_vacant}}">{{$jv->posisi_ditawarkan}} - {{$jv->nama_company}}</option>
		@endforeach
	</select>
</div>
<div class="form-group">
	<label>Interview Part </label> <br/>
	<select id = 'interview' name='jmlhInterview' class="form-control">
		<option>Choose</option>
		<option id ='opt2'>1</option>
		<option id ='opt2'>2</option>
	</select>  
</div>
</div>

<button type="button" class="btn btn-primary" onclick="test(this.value)">Assign Applicant</button>
</div>

</body>
@stop