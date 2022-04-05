@extends('layouts.master', ['title' => 'Simbol'])

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1 class="page-title">Edit Simbol</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Edit Simbol</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.simbol.update', $simbol->id) }}" method="post">
                    @method('PATCH')
                    @csrf

                    @include('admin.simbol.form')

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop