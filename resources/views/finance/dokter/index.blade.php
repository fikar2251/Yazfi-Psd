@extends('layouts.master', ['title' => 'Dokter'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <x-alert></x-alert>

        <div class="row">
            <div class="col-sm-4 col-3">
                <h1 class="page-title">Dokter</h1>
            </div>
            @can('dokter-create')
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('resepsionis.dokter.create') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
            </div>
            @endcan
        </div>
        <div class="row doctor-grid">
            @foreach($dokter as $dok)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="{{ route('resepsionis.dokter.show', $dok->id) }}"><img alt="" src="{{ asset('storage/'. $dok->image) }}" style="object-fit: cover; object-position: center;"></a>
                    </div>
                    @can('dokter-edit')
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @can('dokter-edit')
                            <a class="dropdown-item" href="{{ route('resepsionis.dokter.edit', $dok->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            @endcan
                            @can('dokter-delete')
                            <form action="{{ route('resepsionis.dokter.destroy', $dok->id) }}" method="post" class="d-inline delete-form">
                                @method('DELETE')
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                    @endcan
                    <h4 class="doctor-name text-ellipsis"><a href="{{ route('resepsionis.dokter.show', $dok->id) }}">{{ $dok->name }}</a></h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $dok->address }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop