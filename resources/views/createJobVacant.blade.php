@extends('layouts.master')
<?php 
  session_start();
?>
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

<?php
if(session()->has('comErr')){
  return session()->get('comErr');
}
?>
    <br>
    <form action="CreateAvailablePosition/Save" method="post" autocomplete="on">
      <div class="form-group">
        <div id="nav"><label>Available Position<span class="error"></span></label></div>
        <div id="section"><input type="text" class = "form-control" name="posisi" autofocus required placeholder=" Name of the position "></div>
                	
        <div id="nav"><label>Status<span></span></label></div>
        <div id="section">
            <select name="status" class = "form-control" required>
              <option value=0>Not Publish</option>
              <option value=1>Publish</option>
            </select>
        </div>
                	
        <div id="nav"><label>Company<span></span></label></div>
        <div id="section">
            <select name="company" class = "form-control" required>
              <option value=0>-------------------</option>
              <option value=1>Definite (PT Definite Maji Arsana)</option>
              <option value=2>Flipbox (PT Saka Digital Arsana)</option>
              <option value=3>Karya (PT Karya Saka Arsana)</option>
              <option value=4>Innovacto (PT Adrian Saka Arsana)</option>
            </select>
        </div>
                	
        <div id="nav"><label>Business Unit<span></span></label></div>
        <div id="section">
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
                	
        <div id="nav"><label>Number of Needs<span></span></label></div>
        <div id="section">
          <input type="number" class = "form-control" name="jml_kebutuhan" min="1" step="1" placeholder= "1" required>
        </div>
                
        <div id="nav"><label>Job Description<span></span></label></div>
        <div id="section"><textarea name="description" class = "form-control" placeholder= "o>description 1" required></textarea></div>
              
        <div id="nav"><label>Job Requirement<span></span></label></div>
        <div id="section"><textarea name="requirement" class = "form-control" placeholder= "o>requirement 1" required></textarea></div>
        
        <div id="nav"><label>Person In Charge<span></span></label></div>
        <div id="section"><textarea name="pic" class = "form-control" placeholder="example1@gmail.com, example2@gmail.com" required></textarea></div>
        
  </div>

<div id="nav"></div>
<div id="section">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" id="real=save" class="btn btn-primary" value="Save" style="display:none"> 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Save</button>
<a href="{{ URL::to('/JobVacant') }}"><button class="btn btn-secondary">Cancel</button></a>
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
            <button type="button" class="btn btn-secondary" id="to-save">Yes</button>
          </div>

        </div>
      </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function(){
        $('#to-save').click(function(){
          $('input[type="submit"]').trigger('click');
        });
      });
    </script>
@stop