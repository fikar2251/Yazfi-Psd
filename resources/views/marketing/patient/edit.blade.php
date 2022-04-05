@extends('layouts.master', ['title' => 'Roles'])

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Pasien</h4>
    </div>
</div>
<form action="{{ route('marketing.patient.update', $patient->id) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    @include('marketing.patient.form', ['patient' => $patient])
</form>
@stop