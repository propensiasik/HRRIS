@extends('master')

@section('title')
	Job Vacant Information
@endsection

@section('content')

<h1 style="text-align: center"> Available Position Detail Infromation </h1>
  
{{-- <!-- <div class="col-md-8">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">	
              
                  <tbody>
                	<tr>
                		<td>Posisi</td>
                		<td>{{ $posisi }} </td>
                	</tr>
                	<tr>
                		<td>Status</td>
                		<td>{{ $status }}</td>
                	</tr>	
                	<tr>
                		<td>Business Unit</td>
                		<td>{{ $nama_divisi }}</td>
                	</tr>	
                	<tr>
                		<td>Company</td>
                		<td>{{ $nama_company }}</td>
                	</tr>	
					<tr>
                		<td>Jumlah kebutuhan</td>
                		<td>{{ $jml_kebutuhan }}</td>
                	</tr>	
					<tr>
                		<td>Requirement</td>
                	</tr>
                  </tbody>
                </table>
                <div>
                	<td>{{ $requirement }}</td>
                </div>
              </div>
        </div>
      </div> --> --}}

	<div>
  	<a href="{{ URL::to('/JobVacant/ReportForm/' . $idJobVacant) }}"><button>View report form</button></a>
  	<a href="{{ URL::to('/JobVacant/ReportForm/' . $idJobVacant) }}"><button>Update Information</button></a>
  	</div>
 

@stop