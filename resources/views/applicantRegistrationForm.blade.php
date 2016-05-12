@extends('layouts.master_applicant')
<?php  
  session_start();
?>
<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('content')

 <h1 style="text-align: center"> Applicant's Personal Information </h1>

 <form action="Registration/Save" method="post" autocomplete="on" enctype="multipart/form-data">
  <table class="table" style="margin-left:25%; margin-right:15%;">  
    <tr>
      <td><label>Full name</label></td>
      <td><input type="text" name="nama" autofocus required placeholder=" Your Name "></td>
    </tr>
    <tr>
      <td><label>E-mail<span></span></label></td>
      <td><input type="email" name="email" required placeholder=" example@mail.com "></td>
    </tr>
    <tr>
      <td><label>Gender<span></span></label></td>
      <td><select name="gender" id="gender" required>
               <option value="M">Male</option>
               <option value="F">Female</option>
          </select></td>
    </tr>
    <tr>
      <td><label>Address<span></span></label></td>
      <td><textarea name="alamat" required placeholder="Street, home number, city"></textarea></td>
    </tr>
    <tr>
      <td><label>Phone number<span></span></label></td>
      <td><input type="tel" name="phone" required placeholder="08xxxxxxxxxx"></td>
    </tr>
    <tr>
      <td><label>Major<span></span></label></td>
      <td><input type="text" name="jurusan" required placeholder="Your Major"></td>
    </tr>
    <tr>
      <td><label>University<span></span></label></td>
      <td><input type="text" name="universitas" required placeholder="University " ></td>
    </tr>
    <tr>
      <td><label>Graduation year<span></span></label></td>
      <td><input type="text" name="tahunLulus" required placeholder="20xx"></td>
    </tr>
    <tr>
      <td><label>GPA<span></span></label></td>
      <td><input type="number" name="ipk" min="0" max="4" step="0.01" required placeholder="3,51" ></td>
    </tr>
    <tr>
      <td><label>Portfolio<span></span></label></td>
      <td><input type="file" id="portofolio" name="portofolio"><div><br>*required for UI/UX<br>*only pdf allowed</div></td>
    </tr>
    <tr>
      <td><label>CV<span></span></label></td>
      <td><input type="file" id="cv" name="cv" required ><div><br>*only pdf allowed</div></td>
    </tr>
</table>
   
    <div>
      <div><label>Is there anything you want to share with us?</label></div>
      <div><textarea name="pesan"></textarea></div>
    </div>
    <input type="text" name="id_job_vacant" id="id_job_vacant" value="{{$id_job_vacant}}" style="display:none">

  <div>
    <div>Work experience</div>
    <br>
    <table class="table" style="margin-left:25%; margin-right:15%;">
      <div class="position">
        <tr>
          <td><label class="pos1">Position</label></td>
          <td><input class="pos1" type="text" name="posisi1" placeholder="Your Position" ></td>
          <td><label class="pos1">Company</label></td>
          <td><input class="pos1" type="text" name="perusahaan1" placeholder="The Company" ></td>
          <td><label class="pos1">Start</label></td>
          <td><input class="pos1" type="date" name="start1"></td>
          <td><label class="pos1">End</label></td>
          <td><input class="pos1" type="date" name="end1"></td>
        </tr>
         <tr>
          <td><label class="pos2" style="display:none">Position</label></td>
          <td><input class="pos2" style="display:none" type="text" name="posisi2" placeholder="Your Position" ></td>
          <td><label class="pos2" style="display:none">Company</label></td>
          <td><input class="pos2" style="display:none" type="text" name="perusahaan2" placeholder="The Company" ></td>
          <td><label class="pos2" style="display:none">Start</label></td>
          <td><input class="pos2" style="display:none" type="date" name="start2"></td>
          <td><label class="pos2" style="display:none">End</label></td>
          <td><input class="pos2" style="display:none" type="date" name="end2"></td>
        </tr>
         <tr>
          <td><label class="pos3" style="display:none">Position</label></td>
          <td><input class="pos3" style="display:none" type="text" name="posisi3" placeholder="Your Position" ></td>
          <td><label class="pos3" style="display:none">Company</label></td>
          <td><input class="pos3" style="display:none" type="text" name="perusahaan3" placeholder="The Company" ></td>
          <td><label class="pos3" style="display:none">Start</label></td>
          <td><input class="pos3" style="display:none" type="date" name="start3"></td>
          <td><label class="pos3" style="display:none">End</label></td>
          <td><input class="pos3" style="display:none" type="date" name="end3"></td>
        </tr>
         <tr>
          <td><label class="pos4" style="display:none">Position</label></td>
          <td><input class="pos4" style="display:none" type="text" name="posisi4" placeholder="Your Position" ></td>
          <td><label class="pos4" style="display:none">Company</label></td>
          <td><input class="pos4" style="display:none" type="text" name="perusahaan4" placeholder="The Company" ></td>
          <td><label class="pos4" style="display:none">Start</label></td>
          <td><input class="pos4" style="display:none" type="date" name="start4"></td>
          <td><label class="pos4" style="display:none">End</label></td>
          <td><input class="pos4" style="display:none" type="date" name="end4"></td>
        </tr>
        <tr>
          <td><label class="pos5" style="display:none">Position</label></td>
          <td><input class="pos5" style="display:none" type="text" name="posisi5" placeholder="Your Position" ></td>
          <td><label class="pos5" style="display:none">Company</label></td>
          <td><input class="pos5" style="display:none" type="text" name="perusahaan5" placeholder="The Company" ></td>
          <td><label class="pos5" style="display:none">Start</label></td>
          <td><input class="pos5" style="display:none" type="date" name="start5"></td>
          <td><label class="pos5" style="display:none">End</label></td>
          <td><input class="pos5" style="display:none" type="date" name="end5"></td>
        </tr>
        <tr>
          <td><label class="pos6" style="display:none">Position</label></td>
          <td><input class="pos6" style="display:none" type="text" name="posisi6" placeholder="Your Position" ></td>
          <td><label class="pos6" style="display:none">Company</label></td>
          <td><input class="pos6" style="display:none" type="text" name="perusahaan6" placeholder="The Company" ></td>
          <td><label class="pos6" style="display:none">Start</label></td>
          <td><input class="pos6" style="display:none" type="date" name="start6"></td>
          <td><label class="pos6" style="display:none">End</label></td>
          <td><input class="pos6" style="display:none" type="date" name="end6"></td>
        </tr>
        <tr>
          <td><label class="pos7" style="display:none">Position</label></td>
          <td><input class="pos7" style="display:none" type="text" name="posisi7" placeholder="Your Position" ></td>
          <td><label class="pos7" style="display:none">Company</label></td>
          <td><input class="pos7" style="display:none" type="text" name="perusahaan7" placeholder="The Company" ></td>
          <td><label class="pos7" style="display:none">Start</label></td>
          <td><input class="pos7" style="display:none" type="date" name="start7"></td>
          <td><label class="pos7" style="display:none">End</label></td>
          <td><input class="pos7" style="display:none" type="date" name="end7"></td>
        </tr>
        <tr>
          <td><label class="pos8" style="display:none">Position</label></td>
          <td><input class="pos8" style="display:none" type="text" name="posisi8" placeholder="Your Position" ></td>
          <td><label class="pos8" style="display:none">Company</label></td>
          <td><input class="pos8" style="display:none" type="text" name="perusahaan8" placeholder="The Company" ></td>
          <td><label class="pos8" style="display:none">Start</label></td>
          <td><input class="pos8" style="display:none" type="date" name="start8"></td>
          <td><label class="pos8" style="display:none">End</label></td>
          <td><input class="pos8" style="display:none" type="date" name="end8"></td>
        </tr>
        <tr>
          <td><label class="pos9" style="display:none">Position</label></td>
          <td><input class="pos9" style="display:none" type="text" name="posisi9" placeholder="Your Position" ></td>
          <td><label class="pos9" style="display:none">Company</label></td>
          <td><input class="pos9" style="display:none" type="text" name="perusahaan9" placeholder="The Company" ></td>
          <td><label class="pos9" style="display:none">Start</label></td>
          <td><input class="pos9" style="display:none" type="date" name="start9"></td>
          <td><label class="pos9" style="display:none">End</label></td>
          <td><input class="pos9" style="display:none" type="date" name="end9"></td>
        </tr>
        <tr>
          <td><label class="pos10" style="display:none">Position</label></td>
          <td><input class="pos10" style="display:none" type="text" name="posisi10" placeholder="Your Position" ></td>
          <td><label class="pos10" style="display:none">Company</label></td>
          <td><input class="pos10" style="display:none" type="text" name="perusahaan10" placeholder="The Company" ></td>
          <td><label class="pos10" style="display:none">Start</label></td>
          <td><input class="pos10" style="display:none" type="date" name="start10"></td>
          <td><label class="pos10" style="display:none">End</label></td>
          <td><input class="pos10" style="display:none" type="date" name="end10"></td>
        </tr>
      </div>
    </table>
  </div>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="submit" class="btn btn-primary" value="Save and continue to apply" style="display:none">
</form>

 <div><button class="add">Add more experience</button></div>




 <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Save</button>

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
  var i = 2;
   $('.add').click(function(){
      $('.pos'+i).show();
      i++;
   });
    $('#to-save').click(function(){
          $('input[type="submit"]').trigger('click');
        });

});
</script>  

@stop




