@extends('layouts.master')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

<div class="container">

<h1> Create Available Position </h1>

<style type="text/css">
  .err {
    background: slategrey;
    color: #fff;
    padding: 20px;
    margin-buttom: 20px;      
  }
</style>

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

<br><br>
  <form action="CreateAvailablePosition/Save" method="post" autocomplete="on" id="submitForm">
    <div class="row margin">
      <div class="form-group">      
        <div class="col-md-3"><label>Available Position<span class="error"></span></label></div>
        <div class="col-md-9"><input type="text" class = "form-control" name="posisi" autofocus required placeholder=" Name of the position ">
        <div class="col-md-9 error"><?php if(array_key_exists('posisiErr', $errors)){ echo($errors['posisiErr'][0]);} ?></div>
        </div>
      </div>
    </div>

    <div class="row margin">
      <div class="form-group"> 
        <div class="col-md-3"><label>Status<span></span></label></div>
        <div class="col-md-9">
            <select name="status" class = "form-control" required>
              <option value=0>Not Publish</option>
              <option value=1>Publish</option>
            </select>
        </div>
      </div>
    </div>
                  
    <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Company<span></span></label></div>
        <div class="col-md-9">
            <select name="company" class = "form-control" required>
              <option value=0>-------------------</option>
              <option value=1>Definite (PT Definite Maji Arsana)</option>
              <option value=2>Flipbox (PT Saka Digital Arsana)</option>
              <option value=3>Karya (PT Karya Saka Arsana)</option>
              <option value=4>Innovacto (PT Adrian Saka Arsana)</option>
            </select>
        </div>
        <div class="col-md-9 error"><?php if(array_key_exists('comErr', $errors)){ echo($errors['comErr'][0]);} ?></div>
      </div>
    </div>

    <div class="row margin">
      <div class="form-group">              
        <div class="col-md-3"><label>Business Unit<span></span></label></div>
        <div class="col-md-9">
            <select name="divisi" class="form-control" required>
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
        <div class="col-md-9 error"><?php if(array_key_exists('divErr', $errors)){ echo($errors['divErr'][0]);} ?></div>
      </div>
    </div>

    <div class="row margin">
      <div class="form-group">
        <div class="col-md-3"><label>Number of Needs<span></span></label></div>
        <div class="col-md-9"><input type="number" class = "form-control" name="jml_kebutuhan" min="1" step="1" placeholder= "1" required></div>
        <div class="col-md-9 error"><?php if(array_key_exists('jml_kebutuhanErr', $errors)){ echo($errors['jml_kebutuhanErr'][0]);} ?></div>
      </div>
    </div>
    
    <div class="row margin">
      <div class="form-group">            
        <div class="col-md-3"><label>Job Description<span></span></label></div>
        <div class="col-md-9"><textarea name="description" class = "form-control" placeholder= "o>description 1" required></textarea></div>
        <div class="col-md-9 error"><?php if(array_key_exists('descriptionErr', $errors)){ echo($errors['descriptionErr'][0]);} ?></div>
      </div>
    </div>

    <div class="row margin">
      <div class="form-group">        
        <div class="col-md-3"><label>Job Requirement<span></span></label></div>
        <div class="col-md-9"><textarea name="requirement" class = "form-control" placeholder= "o>requirement 1" required></textarea></div>
        <div class="col-md-9 error"><?php if(array_key_exists('requirementErr', $errors)){ echo($errors['requirementErr'][0]);} ?></div>
      </div>
    </div>

    <div class="row margin">
      <div class="form-group">   
        <div class="col-md-3"><label>Person In Charge<span></span></label></div>
        <div class="col-md-9"><textarea name="pic" class = "form-control" placeholder="example1@gmail.com, example2@gmail.com" required></textarea></div>
        <div class="col-md-9 error">
          @if(array_key_exists('picErr', $errors))
              <?php $i = 0 ?>
              @foreach($errors['picErr'] as $p)
                  {{ $errors['picErr'][$i] }}<br>  
                  <?php $i++ ?>
              @endforeach
          @endif
        </div>
      </div>
    </div>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      </form>

<div class="col-md-3"></div>
<div class="col-md-9">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" id="real=save" class="btn btn-success" value="Save" style="display:none"> 
<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">
<img src="{{asset('img/check.png')}}">Save</button>
<a href="{{ URL::to('/JobVacant') }}"><button class="btn btn-danger"><img src="{{asset('img/cancel.png')}}">Cancel</button></a>
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
              Are you sure to save this as new available position?
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-secondary" onclick="submitForm()">Yes</button>
          </div>

        </div>
      </div>
    </div>


    <script type="text/javascript">
    function submitForm() {
    document.getElementById("submitForm").submit();
    }
      $(document).ready(function(){
        $('#to-save').click(function(){
          $('input[type="submit"]').trigger('click');
        });
      });
    </script>
@stop