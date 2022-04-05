@extends('layouts.master', ['title' => 'Edit Dokter'])

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title">Edit Doctor</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('resepsionis.dokter.update', $dokter->id) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            @include('resepsionis.dokter.form', ['dokter' => $dokter])

            <div class="m-t-20 text-center">
                <button class="btn btn-primary submit-btn">Update Doctor</button>
            </div>
        </form>
    </div>
</div>
@stop