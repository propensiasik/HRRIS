@extends('layouts.master')

<?php
  session_start();
?>
  <script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
  <script type="text/javascript">
  $(function(){
    $("#setApplicant").hide(10);
  
  })
  function show(val) {
  $.ajax({
  type: "GET",
  url: "/ada/public/a",
  data:'id_job_vacant='+val,
  success: function(data){
    //console.log(data);
    $("#showajax").html(data);
    $("#setApplicant").show(10);
    }
    });
  }
  </script>
@section('content')
<h1>Create Interview Schedule</h1>
<div class="form-group">
  <label for="jobvacant">Job Vacant</label>
    <select name='Jobvacant' class="form-control" onchange="show(this.value)">
      <option value="">Select Job Vacant</option>
      @foreach($jobvacant as $jv)
        <option value="{{$jv->id_job_vacant}}">{{$jv->posisi_ditawarkan}} - {{$jv->nama_company}}</option>
      @endforeach
    </select>
</div>
<div class="form-group">
  <label>Interview Ke </label>
    <select name='jmlhInterview' class="form-control">
      <option>Choose</option>
      <option>1</option>
      <option>2</option>
    </select>  
</div>
<div class='form-group' id ='showajax'></div>
  <div class = 'form-group' id = 'setApplicant'>
      <label>Applicants </label></br>
              <div class="col-md-8">
          <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Budi</td>
                      <td><select>
                        <option>11 April 2016</option>
                        <option>12 April 2016</option>
                      </select></td>
                      <td><select>
                        <option>10.00</option>
                        <option>13.00</option>
                      </select></td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Sinta</td>
                      <td><select>
                        <option>11 April 2016</option>
                        <option>12 April 2016</option>
                      </select></td>
                      <td><select>
                        <option>10.00</option>
                        <option>13.00</option>
                      </select></td>
                      </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Jojo</td>
                      <td><select>
                        <option>11 April 2016</option>
                        <option>12 April 2016</option>
                      </select></td>
                      <td><select>
                        <option>10.00</option>
                        <option>13.00</option>
                      </select></td>
                      </tr>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
  
  </div>
  <div class="vertical-separator"></div>
<a href="{{url('/Schedule')}}"><button type="button" class="btn btn-primary">Save</button></a>
</div>
  
</body>
@stop