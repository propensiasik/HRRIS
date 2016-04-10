@extends('layouts.coba_layout')

@section('content')

<section id = "content">

<div class = "container">
      
        <h1> Judul Form </h1> 

        <br>

          <div class="form-group">
          	<div class="input-group">
            	<label for="exampleInputEmail1">Label 1</label> 
            	<input type="text" class="form-control" placeholder="Textfield">
          	</div>
          </div>

          <!--Text area-->
          <div class="form-group">
          	<div class="input-group">          	
            	<label for="text">Label 2</label> <br>
            	<textarea rows="5" cols="50" name="description" placeholder=""></textarea>       
            </div>
          </div>

          <!--Yg ada add-->
          <div class="form-group">
          	<label for="text">Label 5</label> 
              	<input type="text" class="form-control" placeholder="input...">
                		<button class="btn-secondary" type="button"><img src="img/Icon - Add - White.png"></button>
          </div>


          <!--Yg ada delete-->
          <div class="desc-group inline">
                <label>Label</label>
                Description
                		<button class="btn-default" type="button"><img src="img/Icon - Delete.png"></button>
          </div>

          <div class="form-group">
            	<label for="exampleInputPassword1">Upload a file</label> 
            	<input type="file" title="Choose a file to add">
          </div>

          <div class="checkbox">
            <label>
              <input type="checkbox" />
              <span class="lbl padding-8">This is checkbox</span>
            </label>
          </div>

          <div class="radio">
            <ul>
            <label>
              <input type="radio" name="radio" checked/>
              <span class="lbl padding-8">First option</span>
            </label>
            </ul>
            <ul>
            <label>
              <input type="radio" name="radio" />
              <span class="lbl padding-8">Second option</span>
            </label>
            </ul>
          </div>

          <div class="vertical-separator"></div>

          <div class="form-group">
          <label>Dropdown</label>
            <select class="selectpicker">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Relish</option>
            </select>
          </div>

       <div class="col-md-6">
		<div class="form-group">
			<label>Pilih Tanggal</label>
              <div class='input-group date'>
                <span class="input-group-addon">
                    <button class="btn btn-default" type="button">
                      <img src="img/Icon - Calendar.png"> Pick a Date
                    </button>
                </span>
                <input type='text' class="form-control" />
              </div>
          </div>
        </div>

        <br><br><br><br><br>

		<!--Tombol Save/Submit-->
        <button type="button" class="btn btn-danger">Save/Submit</button>

</div>

</section>

@endsection