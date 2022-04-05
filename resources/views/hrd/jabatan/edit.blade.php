@extends('layouts.master', ['title' => 'Edit Jabatan'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-md-6">
        <h4 class="page-title">Edit Jabatan</h4>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
      <form action="{{ route('hrd.jabatan.update', $jabatan->id) }}" method="post" id="form">
            @csrf
            @method('put')
            @include('hrd.jabatan.form')

        </form>
    </div>
</div>
@stop