<?php 
  session_start();
?>
@extends('layouts.master')

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
<div class="col-md-12">
        <div class="vertical-separator"></div>
        <a href="{{url('/CreateAvailablePosition')}}"><button type="submit" class="btn btn-primary">Create Job Vacant</button></a>
        </div>
        
@stop