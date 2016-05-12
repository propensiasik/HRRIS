@extends('layouts.master_admin')

@section('title')
@endsection

@section('content')

	<div class = "container">

	<h1>Applicants</h1>

	<br><br>
		
		<div class="table-responsive">
			<table class = "table">	
				<thead>	
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Position</th>
						<th>Company</th>
						<th colspan="1"></th>
					</tr>
				</thead>
				<tbody>
			        <?php $i = 0; ?>
			        @foreach ($applicants as $applicant)
			        <?php $i++; ?>
					<tr>
						<td>
							{{ $i }}		
						</td>
						<td>
						
								{{ $applicant->nama_applicant }}
									
						</td>
						<td> 
							{{ $applicant->posisi_ditawarkan }}
						</td>
						<td>
							{{ $applicant->nama_company }}
						</td>
						<td align="right">
							<a href="{{ url('Applicants/delete/'.$applicant->id_applicant.'') }}" onclick="return confirm('Are you sure you want to delete?')">
                                <button class = "btn btn-danger">Delete</button>
                            </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>



 <!-- Pop Up -->

<!-- <div id="modal-from-dom" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="gridSystemModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            Are you sure want to delete this?
                    	</div>
                	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal">No</button>
                    <a class = "btn btn-default" action="{{ url('Applicants/delete/'.$applicant->id_applicant.'') }}">Yes</a>
                </div>
        	</div>
    	</div>
	</div> -->  

@endsection