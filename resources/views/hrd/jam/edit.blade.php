@extends('layouts.master', ['title' => 'Edit Jam Shift'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Edit Shift Jam</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="{{ route('hrd.jam.update', $jam->id) }}" method="post" id="form">
            @csrf
            @method('put')
            @include('hrd.jam.form')

        </form>
    </div>
</div>

@stop
