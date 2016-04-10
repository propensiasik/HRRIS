@extends('layouts.master_recruiter')

@section('content')
<section id="content">
	<div class = "container">
		
		<div class="table-responsive">
        	<table class="table">
            	<thead>
                    <tr>
                      <th width="420px">
                      	<!--Judul-->
                      	<div class="form-group"><h1>Applicants</h1></div>
                      </th>
                      <th>
                      	<!--Choose-->
                      	<div class="form-group">
						<a href="#"><button type="button" class="btn btn-secondary">Choose</button></a>
						</div>
					  </th>
                      <th>
                      	<!--Search-->
						<div class="form-group">
            				<div class="input-group">
              					<input type="text" class="form-control" placeholder="Search for...">
              				<span class="input-group-btn">
                				<button class="btn-search" type="button"><img src="img/search.png"></button>
              				</span>
            				</div><!-- /input-group -->
        				</div>
        			  </th>
     				  <th>
        				<!--Filter-->
        				<div class="form-group">
            				<select class="selectpicker">
                				<option>Mustard</option>
                				<option>Ketchup</option>
                				<option>Relish</option>
                				<option>Relish</option>
            				</select>
          				</div>
         			  </th>
         			</tr>
         		</thead>
         	</table>
        </div>

	</div>

</section>

@endsection