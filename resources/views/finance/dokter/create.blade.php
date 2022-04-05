@extends('layouts.master', ['title' => 'Add Dokter'])

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Add Doctor</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('resepsionis.dokter.store') }}" enctype="multipart/form-data">
            @csrf

            @include('resepsionis.dokter.form')

            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Create Doctor</button>
            </div>
        </form>
    </div>
</div>
@stop