<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
	<script type="text/javascript">
	function show(val) {
	$.ajax({
	type: "GET",
	url: "/ada/public/a",
	data:'id_job_vacant='+val,
	success: function(data){
		$(".c").html(data);
		$("#d").show();
	}
	});
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
	});
}
	</script>
</head>
<body>
	<select name='Jobvacant' class="form-control" onchange="show(this.value)">
		<option value="">Select Job Vacant</option>
		@foreach($jobvacant as $jv)
		<option value="{{$jv->id_job_vacant}}">{{$jv->posisi_ditawarkan}}</option>
		@endforeach
	</select>
	<div class='c'></div>
	<div class="input_fields_wrap">
    <button class="add_field_button">Add More Fields</button>
    <div><input type="text" name="mytext[]"></div>
	</div>
	<div class="form-group" id="d">
    	<label for="Interview ke">Interview Ke</label>
        <input class="form-control"></input>
     </div>
     
</body>
</html>
