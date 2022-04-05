@extends('layouts.master', ['title' => 'Add Jabatan'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-md-6">
        <h4 class="page-title">Add Jabatan</h4>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
<form action="{{ route('hrd.jabatan.store') }}" method="post">
    @csrf
    @include('hrd.jabatan.form')

</form>
</div>
</div>
@stop

