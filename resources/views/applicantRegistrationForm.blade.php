@extends('layouts.master_applicant')
<?php  
  session_start();
?>
<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

 <h1> Applicant's Personal Information </h1>

 <br><br>

 <div>
    <?php
      $errors = []; 
      if(session()->has('errors')){
          $errors = session()->get('errors')->toArray();
          //dd($errors);
          $errors_work_exp = [];
          if(array_key_exists('posisiErr', $errors)){
            array_push($errors_work_exp, $errors['posisiErr'][0]);
          }
          if(array_key_exists('perusahaanErr', $errors)){
             array_push($errors_work_exp, $errors['perusahaanErr'][0]); 
          }
          if(array_key_exists('startErr', $errors)){
            array_push($errors_work_exp, $errors['startErr'][0]); 
          }
          if(array_key_exists('endErr', $errors)){
            array_push($errors_work_exp, $errors['endErr'][0]); 
          }
          if(array_key_exists('periodeErr', $errors)){
            array_push($errors_work_exp, $errors['periodeErr'][0]); 
          }
           if(array_key_exists('dateErr', $errors)){
            array_push($errors_work_exp, $errors['dateErr'][0]); 
          }
          //dd($errors_work_exp);
      }
      $old = [];
      if(session()->has('old_input')){
          $old = session()->get('old_input')->toArray();
          //dd($old);
      }
       $old_current = [];
       //$test=true;
       for($i=1; $i<=10; $i++){
         //$test = array_key_exists('current'.$i, $old);
         if(array_key_exists('current'.$i, $old)){
           array_push($old_current, $i);
         }
       }
       //dd("test: "+$test);
       //dd($old_current);
       $curr_json = json_encode($old_current);
       //dd($curr_json);

    ?>
 </div>

 <br><br>

 <form action="Save" method="post" autocomplete="on" enctype="multipart/form-data">
  
  <div class="row margin">
    <div class="form-group"> 
      <div class="col-md-3"><label>Full name</label></div>
      <div class="col-md-9"><input type="text" name="nama" autofocus placeholder=" Your Name " class="form-control" value="<?php if(array_key_exists('nama', $old)){ echo($old['nama'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('nameErr', $errors)){ echo($errors['nameErr'][0]);} ?></div></div>
    </div>
  </div>

  <div class="row margin">
    <div class="form-group"> 
      <div class="col-md-3"><label>E-mail<span></span></label></div>
      <div class="col-md-9"><input type="email" name="email" placeholder=" example@mail.com " class="form-control" value="<?php if(array_key_exists('email', $old)){ echo($old['email'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('emailErr', $errors)){ echo($errors['emailErr'][0]);} ?></div></div>  
    </div>
  </div>
  
  <div class="row margin">
    <div class="form-group"> 
      <div class="col-md-3"><label>Gender<span></span></label></div>
      <div class="col-md-9"><select name="gender" id="gender" class="form-control">
               <option value="O">------</option>
               <option value="M">Male</option>
               <option value="F">Female</option>
          </select>
       <div class="col-md-9 error"><?php if(array_key_exists('genderErr', $errors)){ echo($errors['genderErr'][0]);} ?></div></div>    
    </div>
  </div>
  
  <div class="row margin">
    <div class="form-group"> 
      <div class="col-md-3"><label>Address<span></span></label></div>
      <div class="col-md-9"><textarea name="alamat" placeholder="Street, home number, city" class="form-control"><?php if(array_key_exists('alamat', $old)){ echo($old['alamat'][0]);} ?></textarea>
      <div class="col-md-9 error"><?php if(array_key_exists('addressErr', $errors)){ echo($errors['addressErr'][0]);} ?></div></div> 
    </div>
  </div>
  
  <div class="row margin">
    <div class="form-group">  
      <div class="col-md-3"><label>Phone number<span></span></label></div>
      <div class="col-md-9"><input type="tel" name="phone" placeholder="08xxxxxxxxxx" class="form-control" value="<?php if(array_key_exists('phone', $old)){ echo($old['phone'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('phoneErr', $errors)){ echo($errors['phoneErr'][0]);} ?></div></div> 
    </div>
  </div>

  <div class="row margin">
    <div class="form-group">  
      <div class="col-md-3"><label>Major<span></span></label></div>
      <div class="col-md-9"><input type="text" name="jurusan" placeholder="Your Major" class="form-control" value="<?php if(array_key_exists('jurusan', $old)){ echo($old['jurusan'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('jurusanErr', $errors)){ echo($errors['jurusanErr'][0]);} ?></div></div> 
    </div>
  </div>

  <div class="row margin">
    <div class="form-group">
      <div class="col-md-3"><label>University<span></span></label></div>
      <div class="col-md-9"><input type="text" name="universitas" placeholder="University " class="form-control"  value="<?php if(array_key_exists('universitas', $old)){ echo($old['universitas'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('universitasErr', $errors)){ echo($errors['universitasErr'][0]);} ?></div></div> 
    </div>
  </div>

  <div class="row margin">
    <div class="form-group">  
      <div class="col-md-3"><label>Graduation year<span></span></label></div>
      <div class="col-md-9"><input type="text" name="tahunLulus" placeholder="20xx" class="form-control" value="<?php if(array_key_exists('tahunLulus', $old)){ echo($old['tahunLulus'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('tahunLulusErr', $errors)){ echo($errors['tahunLulusErr'][0]);} ?></div></div> 
    </div>
  </div>

  <div class="row margin">
    <div class="form-group">  
      <div class="col-md-3"><label>GPA<span></span></label></div>
      <div class="col-md-9"><input type="number" name="ipk" min="0" max="4" step="0.01" placeholder="3,51" class="form-control" value="<?php if(array_key_exists('ipk', $old)){ echo($old['ipk'][0]);} ?>">
      <div class="col-md-9 error"><?php if(array_key_exists('ipkErr', $errors)){ echo($errors['ipkErr'][0]);} ?></div></div> 
    </div>
  </div>

  <div class="row margin">
    <div class="form-group">
      <div class="col-md-3"><label>CV<span></span></label></div>
      <div class="col-md-9"><input type="file" id="cv" name="cv" class="form-control"><div><br>*only pdf allowed</div>
      <div class="col-md-9 error"><?php if(array_key_exists('cvErr', $errors)){ echo($errors['cvErr'][0]);} ?></div>
      <div class="col-md-9 info" style="color:blue;"><?php if(array_key_exists('undoUploadCV', $errors)){ echo($errors['undoUploadCV'][0]);} ?></div>
      </div> 
  </div>
</div> 

  <div class="row margin">
    <div class="form-group"> 
      <div class="col-md-3"><label>Portfolio<span></span></label></div>
      <div class="col-md-9"><input type="file" id="portofolio" name="portofolio" class="form-control"><div><br>*required for UI/UX<br>*only pdf allowed</div>
      <div class="col-md-9 error"><?php if(array_key_exists('portofolioErr', $errors)){ echo($errors['portofolioErr'][0]);} ?></div>
      <div class="col-md-9 info" style="color:blue;"><?php if(array_key_exists('undoUploadPortofolio', $errors)){ echo($errors['undoUploadPortofolio'][0]);} ?></div>
    </div> 
    </div>
  </div>
</div>
   
  <div class="row margin">
    <div class="form-group">
      <div class="col-md-3"><label>Is there anything you want to share with us?</label></div>
      <div class="col-md-9"><textarea name="pesan" class="form-control"><?php if(array_key_exists('pesan', $old)){ echo($old['pesan'][0]);} ?></textarea class="form-control"></div>
    </div>
  </div>
    <input id="id_job_vacant" type="text" name="id_job_vacant" id="id_job_vacant" value="{{$id_job_vacant}}" style="display:none">

  <div class="row margin">
    <div class="form-group">
      <h2>Work experience</h2>
    </div>
  </div>
  <div class="error">
    @if(!empty($errors_work_exp))
      @foreach($errors_work_exp as $e)
        <li>{{ $e }}</li>
      @endforeach
    @endif
  </div>
    <br>
    <table class="form-group row margin">
      <div class="position">
        <tr>
          <td><label style="padding:7px;" class="pos1">Position</label></td>
          <td><input id="posisi1" style="padding:7px;" class="pos1" type="text" name="posisi1" placeholder="Your Position" value="<?php if(array_key_exists('posisi1', $old)){ echo($old['posisi1'][0]);} ?>"></td>
          <td><label style="padding:7px;" class="pos1">Company</label></td>
          <td><input id="perusahaan1" style="padding:7px;" class="pos1" type="text" name="perusahaan1" placeholder="The Company" value="<?php if(array_key_exists('perusahaan1', $old)){ echo($old['perusahaan1'][0]);} ?>"></td>
          <td><label style="padding:7px;" class="pos1">Start</label></td>
          <td><input id="start1" class="pos1" type="date" name="start1" value="<?php if(array_key_exists('start1', $old)){ echo($old['start1'][0]);} ?>"></td>
          <td><label style="padding:7px;" class="pos1" id="end1">End</label></td>
          <td><input id="end1" class="pos1" type="date" name="end1" value="<?php if(array_key_exists('end1', $old)){ echo($old['end1'][0]);} ?>"></td>
          <td><div class="checkbox"><label><input id="1" class="pos1 current" type="checkbox" name="current1" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
         <tr>
          <td><label class="pos2" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi2" class="pos2" style="display:none; padding:7px;" type="text" name="posisi2" placeholder="Your Position" value="<?php if(array_key_exists('posisi2', $old)){ echo($old['posisi2'][0]);} ?>" ></td>
          <td><label class="pos2" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan2" class="pos2" style="display:none; padding:7px;" type="text" name="perusahaan2" placeholder="The Company" value="<?php if(array_key_exists('perusahaan2', $old)){ echo($old['perusahaan2'][0]);} ?>" ></td>
          <td><label class="pos2" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start2" class="pos2" style="display:none" type="date" name="start2" value="<?php if(array_key_exists('start2', $old)){ echo($old['start2'][0]);} ?>"></td>
          <td><label class="pos2" style="display:none; padding:7px;" id="end2">End</label></td>
          <td><input id="end2" class="pos2" style="display:none" type="date" name="end2" value="<?php if(array_key_exists('end2', $old)){ echo($old['end2'][0]);} ?>"></td>
          <td><div class="checkbox pos2" style="display:none"><label><input id="2" class="pos2 current" type="checkbox" name="current2" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
         <tr>
          <td><label class="pos3" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi3" class="pos3" style="display:none; padding:7px;" type="text" name="posisi3" placeholder="Your Position" value="<?php if(array_key_exists('posisi3', $old)){ echo($old['posisi3'][0]);} ?>" ></td>
          <td><label class="pos3" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan3" class="pos3" style="display:none; padding:7px;" type="text" name="perusahaan3" placeholder="The Company" value="<?php if(array_key_exists('perusahaan3', $old)){ echo($old['perusahaan3'][0]);} ?>" ></td>
          <td><label class="pos3" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start3" class="pos3" style="display:none" type="date" name="start3" value="<?php if(array_key_exists('start3', $old)){ echo($old['start3'][0]);} ?>"></td>
          <td><label class="pos3" style="display:none; padding:7px;" id="end3">End</label></td>
          <td><input id="end3" class="pos3" style="display:none" type="date" name="end3" value="<?php if(array_key_exists('end3', $old)){ echo($old['end3'][0]);} ?>"></td>
          <td><div class="checkbox pos3" style="display:none"><label><input id="3" class="pos3 current" type="checkbox" name="current3" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
         <tr>
          <td><label class="pos4" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi4" class="pos4" style="display:none; padding:7px;" type="text" name="posisi4" placeholder="Your Position" value="<?php if(array_key_exists('posisi4', $old)){ echo($old['posisi4'][0]);} ?>" ></td>
          <td><label class="pos4" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan4" class="pos4" style="display:none; padding:7px;" type="text" name="perusahaan4" placeholder="The Company" value="<?php if(array_key_exists('perusahaan4', $old)){ echo($old['perusahaan4'][0]);} ?>"></td>
          <td><label class="pos4" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start4" class="pos4" style="display:none" type="date" name="start4" value="<?php if(array_key_exists('start4', $old)){ echo($old['start4'][0]);} ?>"></td>
          <td><label class="pos4" style="display:none; padding:7px;" id="end4">End</label></td>
          <td><input id="end4" class="pos4" style="display:none" type="date" name="end4" value="<?php if(array_key_exists('end4', $old)){ echo($old['end4'][0]);} ?>"></td>
          <td><div class="checkbox pos4" style="display:none"><label><input id="4" class="pos4 current" type="checkbox" name="current4" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos5" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi5" class="pos5" style="display:none; padding:7px;" type="text" name="posisi5" placeholder="Your Position" value="<?php if(array_key_exists('posisi5', $old)){ echo($old['posisi5'][0]);} ?>" ></td>
          <td><label class="pos5" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan5" class="pos5" style="display:none; padding:7px;" type="text" name="perusahaan5" placeholder="The Company" value="<?php if(array_key_exists('perusahaan5', $old)){ echo($old['perusahaan5'][0]);} ?>"></td>
          <td><label class="pos5" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start5" class="pos5" style="display:none" type="date" name="start5" value="<?php if(array_key_exists('start5', $old)){ echo($old['start5'][0]);} ?>"></td>
          <td><label class="pos5" style="display:none; padding:7px;" id="end5">End</label></td>
          <td><input id="end5" class="pos5" style="display:none" type="date" name="end5" value="<?php if(array_key_exists('end5', $old)){ echo($old['end5'][0]);} ?>"></td>
          <td><div class="checkbox pos5" style="display:none"><label><input id="5" class="pos5 current" type="checkbox" name="current5" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos6" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi6" class="pos6" style="display:none; padding:7px;" type="text" name="posisi6" placeholder="Your Position" value="<?php if(array_key_exists('posisi6', $old)){ echo($old['posisi6'][0]);} ?>" ></td>
          <td><label class="pos6" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan6" class="pos6" style="display:none; padding:7px;" type="text" name="perusahaan6" placeholder="The Company" value="<?php if(array_key_exists('perusahaan6', $old)){ echo($old['perusahaan6'][0]);} ?>"></td>
          <td><label class="pos6" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start6" class="pos6" style="display:none" type="date" name="start6" value="<?php if(array_key_exists('start6', $old)){ echo($old['start6'][0]);} ?>"></td>
          <td><label class="pos6" style="display:none; padding:7px;" id="end6">End</label></td>
          <td><input id="end6" class="pos6" style="display:none" type="date" name="end6" value="<?php if(array_key_exists('end6', $old)){ echo($old['end6'][0]);} ?>"></td>
          <td><div class="checkbox pos6" style="display:none"><label><input id="6" class="pos6 current" type="checkbox" name="current6" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos7" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi7" class="pos7" style="display:none; padding:7px;" type="text" name="posisi7" placeholder="Your Position" value="<?php if(array_key_exists('posisi7', $old)){ echo($old['posisi7'][0]);} ?>" ></td>
          <td><label class="pos7" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan7" class="pos7" style="display:none; padding:7px;" type="text" name="perusahaan7" placeholder="The Company" value="<?php if(array_key_exists('perusahaan7', $old)){ echo($old['perusahaan7'][0]);} ?>"></td>
          <td><label class="pos7" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start7" class="pos7" style="display:none" type="date" name="start7" value="<?php if(array_key_exists('start7', $old)){ echo($old['start7'][0]);} ?>"></td>
          <td><label class="pos7" style="display:none; padding:7px;" id="end7">End</label></td>
          <td><input id="end7" class="pos7" style="display:none" type="date" name="end7" value="<?php if(array_key_exists('end7', $old)){ echo($old['end7'][0]);} ?>"></td>
          <td><div class="checkbox pos7" style="display:none"><label><input id="7" class="pos7 current" type="checkbox" name="current7" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos8" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi8" class="pos8" style="display:none; padding:7px;" type="text" name="posisi8" placeholder="Your Position" value="<?php if(array_key_exists('posisi8', $old)){ echo($old['posisi8'][0]);} ?>" ></td>
          <td><label class="pos8" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan8" class="pos8" style="display:none; padding:7px;" type="text" name="perusahaan8" placeholder="The Company" value="<?php if(array_key_exists('perusahaan8', $old)){ echo($old['perusahaan8'][0]);} ?>"></td>
          <td><label class="pos8" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start8" class="pos8" style="display:none" type="date" name="start8" value="<?php if(array_key_exists('start8', $old)){ echo($old['start8'][0]);} ?>"></td>
          <td><label class="pos8" style="display:none; padding:7px;" id="end8">End</label></td>
          <td><input id="end8" class="pos8" style="display:none" type="date" name="end8" value="<?php if(array_key_exists('end8', $old)){ echo($old['end8'][0]);} ?>"></td>
          <td><div class="checkbox pos8" style="display:none"><label><input id="8" class="pos8 current" type="checkbox" name="current8" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos9" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi9" class="pos9" style="display:none; padding:7px;" type="text" name="posisi9" placeholder="Your Position" value="<?php if(array_key_exists('posisi9', $old)){ echo($old['posisi9'][0]);} ?>" ></td>
          <td><label class="pos9" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan9" class="pos9" style="display:none; padding:7px;" type="text" name="perusahaan9" placeholder="The Company" value="<?php if(array_key_exists('perusahaan9', $old)){ echo($old['perusahaan9'][0]);} ?>"></td>
          <td><label class="pos9" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start9" class="pos9" style="display:none" type="date" name="start9" value="<?php if(array_key_exists('start9', $old)){ echo($old['start9'][0]);} ?>"></td>
          <td><label class="pos9" style="display:none; padding:7px;" id="end9">End</label></td>
          <td><input id="end9" class="pos9" style="display:none" type="date" name="end9" value="<?php if(array_key_exists('end9', $old)){ echo($old['end9'][0]);} ?>"></td>
          <td><div class="checkbox pos9" style="display:none"><label><input id="9" class="pos9 current" type="checkbox" name="current9" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
        <tr>
          <td><label class="pos10" style="display:none; padding:7px;">Position</label></td>
          <td><input id="posisi10" class="pos10" style="display:none; padding:7px;" type="text" name="posisi10" placeholder="Your Position" value="<?php if(array_key_exists('posisi10', $old)){ echo($old['posisi10'][0]);} ?>" ></td>
          <td><label class="pos10" style="display:none; padding:7px;">Company</label></td>
          <td><input id="perusahaan10" class="pos10" style="display:none; padding:7px;" type="text" name="perusahaan10" placeholder="The Company" value="<?php if(array_key_exists('perusahaan10', $old)){ echo($old['perusahaan10'][0]);} ?>"></td>
          <td><label class="pos10" style="display:none; padding:7px;">Start</label></td>
          <td><input id="start10" class="pos10" style="display:none" type="date" name="start10" value="<?php if(array_key_exists('start10', $old)){ echo($old['start10'][0]);} ?>"></td>
          <td><label class="pos10" style="display:none; padding:7px;" id="end10">End</label></td>
          <td><input id="end10" class="pos10" style="display:none" type="date" name="end10" value="<?php if(array_key_exists('end10', $old)){ echo($old['end10'][0]);} ?>"></td>
          <td><div class="checkbox pos10" style="display:none"><label><input id="10" class="pos10 current" type="checkbox" name="current10" value=1><span class="lbl padding-8">Current</span></label></div></td>
        </tr>
      </div>
    </table>
  </div>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" class="btn btn-primary" value="Save and continue to apply" style="display:none">
</form>

 <div><button  class="add btn btn-secondary"><img src="{{asset('img/Icon - Add - White.png')}}">Add more experience</button></div>

<br>


 <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">
 <img src="{{asset('img/check.png')}}">Save</button>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Confirm Applying</h4>
          </div>

          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
              Are you sure to save this informatiom?
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
  var num = 0;
  num = "<?php if(array_key_exists('banyak_work_exp', $old)){ echo($old['banyak_work_exp'][0]);} ?>"
  document.getElementById('gender').value= "<?php if(array_key_exists('gender', $old)){ echo($old['gender'][0]);}else{echo "O";} ?>";

  var current_json = '<?php Print($curr_json);?>';
  var list_of_old_current = JSON.parse(current_json);


  for (var i = 1; i <= num; i++) {
    $('.pos'+i).show(); //memunculkan yang telah diisi
    if(list_of_old_current.length > 0){//array list_of_old_current tidak empty
    for(var j = 0; j < list_of_old_current .length; j++){
      if(list_of_old_current[j] === i){ 
        var id = list_of_old_current[j];
        $('.current#'+id).attr('checked', true); //menchecklist yang sudah di checlist sebelumnya
          if($('.current#'+id).is(':checked')){
          $('.pos'+id+'#end'+id).hide(); 
         }else{
          $('.pos'+id+'#end'+id).show(); 
       }
      }
    };
  }
};


  var i = parseInt(num)+1;
  //alert(i);
   $('.add').click(function(){
      $('.pos'+i).show();
      i++;
   });

   $('#to-save').click(function(){
      $('input[type="submit"]').trigger('click');
   });

   $('.current').click(function(){
       var id = $(this).attr('id');
       if($('.current#'+id).is(':checked')){
        $('.pos'+id+'#end'+id).hide(); 
       }else{
        $('.pos'+id+'#end'+id).show(); 
       }
   });
});
</script>  

@stop



