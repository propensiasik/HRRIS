@extends('master')

<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript"></script>

@section('title')
  Update Available Position
@endsection

@section('content')

<h1 style="text-align: center"> Update Available Position </h1>
  
   <div class="col-md-8">
    <form action="Save" method="post" autocomplete="on">
          <div class="table-responsive">
                <table class="table" style="margin-left:25%; margin-right:15%;">  
                  <tbody>
                  <tr>
                    <td><label>Available Position<span class="error"></span></label></td>
                    <td><input type="text" name="posisi" value="{{ $posisi }}" autofocus required placeholder=" Name of the position "></td>
                  </tr>
                  <tr>
                    <td><label>Status<span></span></label></td>
                    <td><select id="status" name="status" value= "{{ $status }}" required>
                        <option value=0>Not Publish</option>
                        <option value=1>Publish</option>
                        </select>
                    </td>
                  </tr> 
                  <tr>
                    <td><label>Company<span></span></label></td>
                    <?php $default = $company; ?>
                    <td><select id="company" name="company" value="{{ $company }}" required>
                        <option value=0>-------------------</option>
                        <option value=1>Definite (PT Definite Maji Arsana)</option>
                        <option value=2>Flipbox (PT Saka Digital Arsana)</option>
                        <option value=3>Karya (PT Karya Saka Arsana)</option>
                        <option value=4>Innovacto (PT Adrian Saka Arsana)</option>
                        </select>
                    </td>
                  </tr> 
                  <tr>
                    <td><label>Business Unit<span></span></label></td>
                    <td><select id="divisi" name="divisi" value="{{ $divisi }}" required>
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
                    </td>
                  </tr> 
                   <tr>
                    <td><label>Number of Needs<span></span></label></td>
                    <td><input type="number" name="jml_kebutuhan" value="{{ $jml_kebutuhan }}" min="1" step="1" placeholder= "1" required></td>
                  </tr> 
                  </tbody>
                </table>
                <div>
                  <div><label>Job Description<span></span></label></div>
                  <div><textarea name="description" placeholder= "o>description 1" required>{{ $description }}</textarea></div>
                </div>
                <br>
                <div>
                  <div><label>Job Requirement<span></span></label></div>
                  <div><textarea name="requirement" placeholder= "o>requirement 1" required>{{ $requirement }}</textarea></div>
                </div>
                <div>
                  <div><label>Person In Charge<span></span></label></div>
                  <div><textarea name="pic" placeholder="example1@gmail.com, example2@gmail.com" required>{{ $pic }}</textarea></div>
                </div>
                <input type="number" name="id_job_vacant" value="{{ $id_job_vacant }}" style="display:none">
              </div>
               <input type="submit" class="btn btn-primary" value="Save" style="display:none"> 
            </form>
              <a href="{{ URL::to('/JobVacant') }}"><button class="btn btn-secondary">Cancle</button></a>
        </div>
      </div> 


      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Save</button>

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