@extends('layouts.master')
<?php 
  session_start();
?>
<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

<div class="container">

  <div id="createForm">
    <h1> Create Assessment Form Competency</h1>
  </div>

<br><br>
  <div class="table-responsive">
    <table class="table">  
      <tbody>
        <tr>
          <td>Job Vacancy</td>
          <td>{{ $nama_jv }}</td>
        </tr>
        <tr>
          <td>Business Unit</td>
          <td>{{ $nama_divisi }}</td>
        </tr>
        <tr>
          <td>Company</td>
          <td>{{ $nama_company }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="table-responsive">
    <table class="table">
      <h3>Competency List</h3>
      <thead>
        <th>No.</th>
        <th>Competency</th>
        <th>Explanation</th>
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
            <button id="{{$comp->id_kompetensi}}" class="opsi-kompetensi tambah-kompetensi active btn btn-secondary">
              <img src="{{asset('img/Icon - Add - White.png')}}">add
            </button>
            <button id="{{$comp->id_kompetensi}}" class="opsi-kompetensi hapus-kompetensi btn btn-default" style="display:none">
              <img src="{{asset('img/Icon - Delete.png')}}">remove
            </button>
          </td>
          <td></td>
        </tr>        
        @endforeach  
      </tbody>
    </table>
  </div>


  @foreach($competency as $com)
  <div id = "{{$com->id_kompetensi}}" class = "choose" style = "display:none">{{$com->nama_kompetensi}}</div>
  @endforeach
<div>
  <form action="SaveCreatedForm" method="post">
    <input name="array_id" value= "" id="json_to_submit" style="display:none">
    <input name="id_job_vacant" value= "{{$id_job_vacant}}" style="display:none">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <button class="simpan btn btn-primary">Save</button>
  </form>
</div>  

</div>

<script type="text/javascript">
$(document).ready(function() {
  var array_id = new Array();
  var id_job_vacant = '<?php Print($id_job_vacant);?>';
  //alert(id_job_vacant);

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
  var array_json = JSON.stringify(array_id);
  document.getElementById('json_to_submit').value= array_json;
});
});
</script>
@stop 