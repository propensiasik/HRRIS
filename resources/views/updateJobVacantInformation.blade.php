@extends('layouts.master')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

<h1> Update Available Position </h1>

<br><br>

<div>
    <?php
      $errors = []; 
      if(session()->has('errors')){
          $errors = session()->get('errors')->toArray();
          //dd($errors);
      }
      $old = [];
      if(session()->has('old_input')){
          $old = session()->get('old_input')->toArray();
          //dd($old);
      }
    ?>
 </div>

<form action="Save" method="post" autocomplete="on">
  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Available Position<span class="error"></span></label></div>
        <div class="col-md-9"><input id="posisi" type="text" name="posisi" autofocus placeholder=" Name of the position " class = "form-control" >
        <div class="col-md-9 error"><?php if(array_key_exists('posisiErr', $errors)){ echo($errors['posisiErr'][0]);} ?></div></div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Status<span></span></label></div>
        <div class="col-md-9"><select id="status" name="status" class = "form-control">
          <option value=0>Not Publish</option>
          <option value=1>Publish</option>
        </select>
        </div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
      <div class="col-md-3"><label>Company<span></span></label></div>
      <div class="col-md-9"><select id="company" name="company" class = "form-control">
        <option value=0>-------------------</option>
        <option value=1>Definite (PT Definite Maji Arsana)</option>
        <option value=2>Flipbox (PT Saka Digital Arsana)</option>
        <option value=3>Karya (PT Karya Saka Arsana)</option>
        <option value=4>Innovacto (PT Adrian Saka Arsana)</option>
      </select>
     <div class="col-md-9 error"><?php if(array_key_exists('comErr', $errors)){ echo($errors['comErr'][0]);} ?></div></div>
    </div>
  </div>

  <div class="row margin">
      <div class="form-group">  
    <div class="col-md-3"><label>Business Unit<span></span></label></div>
    <div class="col-md-9"><select id="divisi" name="divisi" class = "form-control">
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
  <div class="col-md-9 error"><?php if(array_key_exists('divErr', $errors)){ echo($errors['divErr'][0]);} ?></div></div>
  </div>
  </div>

  <div class="row margin">
      <div class="form-group">
  <div class="col-md-3"><label>Number of Needs<span></span></label></div>
  <div class="col-md-9"><input id="jml_kebutuhan" type="number" name="jml_kebutuhan" min="1" step="1" placeholder= "1" required class = "form-control">
  <div class="col-md-9 error"><?php if(array_key_exists('jml_kebutuhanErr', $errors)){ echo($errors['jml_kebutuhanErr'][0]);} ?></div></div>
</div>
</div>


  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Job Description<span></span></label></div>
        <div class="col-md-9"><textarea id = "desription" name="description" placeholder= "o>description 1" class = "form-control"><?php if(array_key_exists('description', $old)){ echo($old['description'][0]);} ?></textarea>
         <div class="col-md-9 error"><?php if(array_key_exists('descriptionErr', $errors)){ echo($errors['descriptionErr'][0]);} ?></div></div>
      </div>
  </div>

  <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Job Requirement<span></span></label></div>
        <div class="col-md-9"><textarea id="requirement" name="requirement" placeholder= "o>requirement 1" class = "form-control"><?php if(array_key_exists('requirement', $old)){ echo($old['requirement'][0]);} ?></textarea>
         <div class="col-md-9 error"><?php if(array_key_exists('requirementErr', $errors)){ echo($errors['requirementErr'][0]);} ?></div></div>
      </div>
  </div>
  
  <div class="row margin">
      <div class="form-group">
  <div class="col-md-3"><label>Person In Charge<span></span></label></div>
  <div class="col-md-9"><textarea id="pic" name="pic" placeholder="example1@gmail.com, example2@gmail.com" class = "form-control"><?php if(array_key_exists('pic', $old)){ echo($old['pic'][0]);} ?></textarea>
  <div class="col-md-9 error">
      @if(array_key_exists('picErr', $errors))
          <?php $i = 0 ?>
          @foreach($errors['picErr'] as $p)
              {{ $errors['picErr'][$i] }}<br>  
              <?php $i++ ?>
          @endforeach
      @endif
  </div></div>
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
<a href="{{ URL::to('/JobVacant/'. $id_job_vacant) }}"><button class="btn btn-danger">
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
   document.getElementById('posisi').value= "<?php if(array_key_exists('posisi', $old)){ echo($old['posisi'][0]);} ?>";
   document.getElementById('company').value= "<?php if(array_key_exists('company', $old)){ echo($old['company'][0]);} ?>";
   document.getElementById('status').value= "<?php if(array_key_exists('status', $old)){ echo($old['status'][0]);} ?>";
   document.getElementById('divisi').value= "<?php if(array_key_exists('divisi', $old)){ echo($old['divisi'][0]);} ?>";
   document.getElementById('jml_kebutuhan').value= "<?php if(array_key_exists('jml_kebutuhan', $old)){ echo($old['jml_kebutuhan'][0]);} ?>";

   $('#to-save').click(function(){
    $('input[type="submit"]').trigger('click');
  });

 });
</script>  

@stop