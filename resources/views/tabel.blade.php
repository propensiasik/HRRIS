@extends('layouts.coba_layout')

@section('content')

<section id = "content">
	<div class = "container">	
    	<table class="table">
        	<thead>
            	<tr>
                    <th>#</th>
                    <th>Table heading</th>
                    <th>Tabel heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th>Table heading</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td class="action">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                       		<img src="img/Icon - More.png">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td class="action">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="img/Icon - More.png">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td class="action">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="img/Icon - More.png">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </td>
                </tr>
            </tbody>
        </table>
	</div>
</section>

@endsection