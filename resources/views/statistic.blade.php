
@extends('layouts.master')

@section('title')
@endsection

@section('content')


<!--MENAMPILKAN JUMLAH PENDAFTAR PADA MASING-MASING ORGANISASI-->
<div id="pop_div"></div>

<?= Lava::render('PieChart', 'Company', 'pop_div') ?>

<!--MENAMPILKAN JUMLAH FEMALE DAN MALE DARI PENDAFTAR-->
<div id="pop_div1"></div>

<?= Lava::render('ColumnChart', 'Gender', 'pop_div1') ?>

@endsection