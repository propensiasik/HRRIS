<?php 
    session_start();
?>

@extends('layouts.master_admin')

@section('content')

<div class = "container">

    <div class="top">

    <h1 class="alignleft">Users</h1>
    <br><a href="{{url('/Users/Create')}}" class="alignright"><button type="button" class="btn btn-secondary">Create User</button></a>

    </div>

    <div class="table-responsive">
        <table class = "table">
            <thead>
                <th> No. </th>
                <th> Nama User </th>
                <th> Email  User </th>
                <th> Posisi </th>
                <th> Divisi </th>
                <th> Company </th>
                <th> Role </th>
                <th colspan="2"></th>
            </thead>

            <tbody>
                <?php $i = 0; ?>
                @foreach ($users as $user)
                <?php $i++; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user->nama_users }}</td>
                        <td>{{ $user->email_users }}</td>
                        <td>{{ $user->posisi }}</td>
                        <td>{{ $user->divisi->nama_divisi }}</td>
                        <td>{{ $user->divisi->company->nama_company }}</td>
                        <td>{{ $user->role }}</td>
                        <td align="right">
                            <a class="btn btn-success" href="{{ route('edit', $user->email_users) }}">Update</a>
                        </td>
                        <td>
                            <a href="{{ url('Users/Delete/'.$user->email_users.'') }}" 
                            onclick="return confirm('Are you sure you want to delete?')">
                                <button class="btn btn-danger">Delete</button>
                            </a>       
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
           
<center> {!! $users->render() !!} </center>

</div>

@endsection