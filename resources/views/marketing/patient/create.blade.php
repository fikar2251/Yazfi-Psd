@extends('layouts.master', ['title' => 'Pasien'])

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Add Pasien</h4>
    </div>
</div>
<form action="{{ route('marketing.patient.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('marketing.patient.form')
</form>
@stop