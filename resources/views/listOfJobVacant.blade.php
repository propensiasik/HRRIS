@extends('master')

@section('title')
  Job Vacant Information
@endsection

@section('content')

<h1 style="text-align: center"> List Of Available Position </h1>
<div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">	
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Posisi Ditawarkan</th>              
                      <th>Jumlah Kebutuhan</th>
                        <th>Requirement</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                	<?php $i = 0; ?>
                    @foreach ($jobVacantList as $jv)
                    <?php $i++; ?>
					<tr>
						<td>
							{{ $i }}		
						</td>
						<td>
						<a href="{{ URL::to('/JobVacant/' . $jv->id_job_vacant) }}"> {{ $jv->posisi_ditawarkan }} </a>
					    
          	</td>
						<td> 
							{{ $jv->jml_kebutuhan }}
						</td>
						<td>
							{{ $jv->requirement }}
						</td>
						<td>
							{{ $jv->is_open }}
						</td>
					</tr>
				@endforeach
                  </tbody>
                </table>
              </div>
        </div>
      </div>


@stop