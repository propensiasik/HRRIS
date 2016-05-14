@extends('layouts.master')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

<h1> Update Available Position </h1>

<br><br>

<form action="Save" method="post" autocomplete="on">
  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Available Position<span class="error"></span></label></div>
        <div class="col-md-9"><input type="text" name="posisi" value="{{ $posisi }}" autofocus required placeholder=" Name of the position " class = "form-control"></div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Status<span></span></label></div>
        <div class="col-md-9"><select id="status" name="status" value= "{{ $status }}" required class = "form-control">
          <option value=0>Not Publish</option>
          <option value=1>Publish</option>
        </select>
        </div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
      <div class="col-md-3"><label>Company<span></span></label></div>
      <?php $default = $company; ?>
      <div class="col-md-9"><select id="company" name="company" value="{{ $company }}" required class = "form-control">
        <option value=0>-------------------</option>
        <option value=1>Definite (PT Definite Maji Arsana)</option>
        <option value=2>Flipbox (PT Saka Digital Arsana)</option>
        <option value=3>Karya (PT Karya Saka Arsana)</option>
        <option value=4>Innovacto (PT Adrian Saka Arsana)</option>
      </select>
    </div>
    </div>
  </div>

  <div class="row margin">
      <div class="form-group">  
    <div class="col-md-3"><label>Business Unit<span></span></label></div>
    <div class="col-md-9"><select id="divisi" name="divisi" value="{{ $divisi }}" required class = "form-control">
      <option value=0>-------------------</option>
      <option value=1>Project Manager</option>
      <option value=2>Web Developer</option>
      <option value=3>Designer</option>
      <option value=4>UI/UX</option>
      <option value=5>Account Manager</option>
      <option value=6>Quality Assurance</option>
      <option value=7>Mobile Developer</option>
      <option value=8>Human Resource</option>
      <option value=9>Analyst</option>
      <option value=10>Produser</option>
    </select>
  </div>
  </div>
  </div>

  <div class="row margin">
      <div class="form-group">
  <div class="col-md-3"><label>Number of Needs<span></span></label></div>
  <div class="col-md-9"><input type="number" name="jml_kebutuhan" value="{{ $jml_kebutuhan }}" min="1" step="1" placeholder= "1" required class = "form-control"></div>
</div>
</div>


  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Job Description<span></span></label></div>
        <div class="col-md-9"><textarea name="description" placeholder= "o>description 1" required class = "form-control">{{ $description }}</textarea></div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Job Requirement<span></span></label></div>
        <div class="col-md-9"><textarea name="requirement" placeholder= "o>requirement 1" required class = "form-control">{{ $requirement }}</textarea></div>
      </div>
  </div>
  
  <div class="row margin">
      <div class="form-group">
  <div class="col-md-3"><label>Person In Charge<span></span></label></div>
  <div class="col-md-9"><textarea name="pic" placeholder="example1@gmail.com, example2@gmail.com" required class = "form-control">{{ $pic }}</textarea></div>
</div>


<input type="number" name="id_job_vacant" value="{{ $id_job_vacant }}" style="display:none">
</div>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" class="btn btn-primary" value="Save" style="display:none"> 
</form>

<div class="col-md-3"></div>
<div class="col-md-9">
<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">
<img src="{{asset('img/check.png')}}">Save</button>
<a href="{{ URL::to('/JobVacant') }}"><button class="btn btn-danger">
<img src="{{asset('img/cancel.png')}}">Cancel</button></a>
</div>
</div> 

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Confirm Available Position</h4>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            Are you sure to save the changes?
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-secondary" id="to-save">Yes</button>
      </div>

    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
   document.getElementById('divisi').value="{{ $divisi }}";
   document.getElementById('company').value="{{ $company }}";
   document.getElementById('status').value="{{ $status }}";

   $('#to-save').click(function(){
    $('input[type="submit"]').trigger('click');
  });

 });
</script>  

@stop