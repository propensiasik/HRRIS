@extends('layouts.master')
<?php 
    session_start();
?>

@section('title')
	Create Report Form
@endsection


<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
  <script type="text/javascript">
  </script>

@@section('content')
   <div id="createForm">
   <h1 style="text-align: center"> Create Report Form </h1>
   </div>

   <br>
   <div class="col-md-12">
      <div class="table-responsive">
            <table class="table" style="margin-left:25%; margin-right:15%;">  
                <tbody>
          <tr>
            <td>Job vacancy</td>
            <td>{{ $nama_jv }}</td>
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
    </div><br>

    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table" style="margin-left:25%, margin-right:15%;">
          <h3>Competency List</h3>
          <thead>
            <th>#</th>
            <th>Nama Kompetensi</th>
            <th>Penjelasan</th>
          </thead>
          <tbody>
            <?php $i=0; ?>
               @foreach($competency as $competency)
               <?php $i++; ?>
               <tr>
                  <td>{{ $i }}</td>
                  <td>  <div id="competencyList"><div id="{{$competency->id_kompetensi}}" class="kompetensi">{{$competency->nama_kompetensi}}</div></div></td>
                  <td>{{ $competency->penjelasan_kompetensi }}</td>
               </tr>        
                @endforeach  
          </tbody>
        </table>
      </div>
    </div>
      

    <div id="choosen">
      <form>
        <div id="kompetensi-choose">
        </div>
        <input type="submit" value="Submit">
      </form>
    </div>

<div class="kompetensidiv">lala</div>

    <script type="text/javascript">
      $(document).ready(function() {
        var array_id = new Array();
        $('.kompetensi').click(function() {
          // get kompetensi id
          var id = $(this).attr('id');
          var name = $(this).html();
          var exist = false;
          for (var i = array_id.length - 1; i >= 0; i--) {
            if (array_id[i] == id) {
              exist = true;
            };
          };
          if (exist == false) {
            array_id.push(id); 
            $('#kompetensi-choose').append('<div id="'+id+'" class="kompetensidiv">'+name+'<br><input type="hidden" name="'+id+'" value="'+id+'"/></div>');
          };
        });
          
        $('.kompetensidiv').click(function(){
          alert('test');
          $(this).remove();
        });
      });
    </script>

@stop