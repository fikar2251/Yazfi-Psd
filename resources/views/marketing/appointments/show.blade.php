@extends('layouts.master', ['title' => 'Appointment Show'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">{{ $booking->no_booking }} - <span class="badge badge-success">{{ $booking->kedatangan->status }}</span></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <table>
                            <tr>
                                <th>Customer</th>
                                <th>:</th>
                                <th>{{ $booking->pasien->nama }} - {{ $booking->pasien->nik_ktp }}</th>
                            </tr>
                            <tr>
                                <th>Dokter</th>
                                <th>:</th>
                                <th>{{ $booking->dokter->name }}</th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>:</th>
                                <th>{{ $booking->jadwal->tanggal }}</th>
                            </tr>
                            <tr>
                                <th>Jam Status</th>
                                <th>:</th>
                                <th>{{ $booking->jam_status }}</th>
                            </tr>
                            <tr>
                                <th>Jam Selesai</th>
                                <th>:</th>
                                <th>{{ $booking->jam_selesai }}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Type</th>
                                <th>Total</th>
                            </tr>
                            @foreach($booking->tindakan as $data)
                            <tr>
                                <td>{{ $data->item->nama_barang }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info">
                                            @if($data->item->type) Lanjutan @else Umum @endif
                                        </button>
                                        <button class="btn btn-warning">
                                            {{ $data->booking->dokter->name }}
                                        </button>
                                    </div>
                                    </td>
                                <th>Rp. {{ number_format($data->nominal) }}</th>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-info">Kembali</a>
            </div>
        </div>
    </div>
</div>
@stop