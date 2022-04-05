@extends('layouts.master', ['title' => 'Edit Password'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="page-title">Edit Profile</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card-box">
            <form action="{{ route('marketing.profile.update', $marketing->id) }}" method="post">
            @csrf
            @method('put')
                <h3 class="card-title">Ubah Password</h3>
                <div class="card-body">
                    <label class="focus-label">Ganti Password</label>
                    <input type="text" class="form-control floating" name="password">
                </div>
                <button class="btn btn-outline-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
@stop
