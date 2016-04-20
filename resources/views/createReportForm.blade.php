@extends('layouts.master')
<?php 
session_start();
?>

@section('title')
@endsection


<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript">
</script>

@section('content')
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
        <th>Select</th>
      </thead>
      <tbody>
        <?php $i=0; ?>
        @foreach($competency as $comp)
        <?php $i++; ?>
        <tr class="competencyList">
          <td>{{ $i }}</td>
          <td>  <div><div id="{{$comp->id_kompetensi}}" class="kompetensi">{{$comp->nama_kompetensi}}</div></div></td>
          <td>{{ $comp->penjelasan_kompetensi }}</td>
          <td>
            <button id="{{$comp->id_kompetensi}}" class="opsi-kompetensi tambah-kompetensi active">add</button>
            <button id="{{$comp->id_kompetensi}}" class="opsi-kompetensi hapus-kompetensi" style="display:none">remove</button>
          </td>
          <td></td>
        </tr>        
        @endforeach  
      </tbody>
    </table>
  </div>
</div>

<div>
  @foreach($competency as $com)
  <div id = "{{$com->id_kompetensi}}" class = "choose" style = "display:none">{{$com->nama_kompetensi}}</div>
  @endforeach
  <button class="simpan">Submit</button>
</div>  

<script type="text/javascript">
$(document).ready(function() {
  var array_id = new Array();

  $('.competencyList .opsi-kompetensi').click(function(){
    $(this).hide();
    $(this).siblings().show();

    if($(this).hasClass('tambah-kompetensi')){
                //console.log($(this).parent().parent().find('.kompetensi').html());
                var id = $(this).attr('id');
                $('.choose#'+id).show();
                var exist = false;
                for (var i = array_id.length - 1; i >= 0; i--) {
                  if(array_id[i] == id){
                    exist = true;
                  }
                };
                if(exist==false){
                  array_id.push(id);
                }
              }else if($(this).hasClass('hapus-kompetensi')){
               // alert("khalila");
               var id = $(this).attr('id');
               $('.choose#'+id).hide();
               for (var i = array_id.length - 1; i >= 0; i--) {
                 if(array_id[i]==id){
                      if(i==0){//kalo dia element pertama
                        array_id.shift();
                      }else if(i==array_id.length -1){//kalo dia element terakhir
                        array_id.pop();
                      }else{//element di tengah
                        var part1 = array_id.slice(0,i);
                        var part2 = array_id.slice(++i, array_id.length);
                        array_id = part1.concat(part2); //menggabungkan array
                      }
                    }
                  };  
                }
              });
$('.simpan').click(function(){

});
});



</script>

@stop