@extends('layouts.master', ['title' => 'Appointments'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Appointments</h1>
    </div>
</div>

<x-alert></x-alert>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Appointment ID</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Cabang</th>
                        <th>Tanggal Booking</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('appointments.show', $appointment->id) }}">{{ $appointment->no_booking }}</a></td>
                        <td>{{ $appointment->pasien->nama }}</td>
                        <td>{{ $appointment->dokter->name }}</td>
                        <td>{{ $appointment->cabang->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->tanggal_status)->format('d M Y') }}</td>
                        <td>{{ $appointment->jam_status }} - {{ $appointment->jam_selesai }}</td>
                        <td><span class="custom-badge status-{{ $appointment->is_active == 1 ? 'green' : 'red'}}">{{ $appointment->is_active == 1 ? 'Active' : 'Inactive'}}</span></td>
                        <td>
                            <a href=""></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop