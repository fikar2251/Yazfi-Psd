@extends('layouts.master', ['title' => 'Dashboard Marketing'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Dashboard</h1>
    </div>
</div>
<x-alert></x-alert>
<div class="row">
    @foreach($data as $product)
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->nama_project }}</h5>
                <p class="card-text">{{ $product->alamat_project }}.</p>
                <div class="account-logo1">
                    <img src="{{url('/img/' . $product->image)}}" alt="Image" />
                </div>
                {{-- <a href="{{ route('marketing.pricelist.index') }}" class="btn btn-primary">Booking</a> --}}
                <a href="{{route('marketing.spr.show', $product->id)}}" class="btn btn-primary">Booking</a>


            </div>
        </div>
    </div>
    @endforeach
</div>
@stop

@section('footer')
<script>
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'btn-default',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-default',
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                title: 'Laporan Barang ',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    });
</script>
@stop
