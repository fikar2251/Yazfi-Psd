@extends('layouts.master', ['title' => 'Appointment'])
@section('content')
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Appointments</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{ route('marketing.dashboard') }}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table" width="100%" id="appointments">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Booking</th>
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Dokter</th>
                        <th>Cabang</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status Kedatangan</th>
                        <th>Status Tindakan</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#appointments').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/marketing/appointments/ajax',
                get: 'get'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_booking',
                    name: 'no_booking'
                },
                {
                    data: 'pasien',
                    name: 'pasien'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'dokter',
                    name: 'dokter'
                },
                {
                    data: 'cabang',
                    name: 'cabang'
                },
                {
                    data: 'tgl_status',
                    name: 'tgl_status'
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'kedatangan',
                    name: 'kedatangan'
                },
                {
                    data: 'tindakan',
                    name: 'tindakan'
                },
            ]
        })
    })
</script>
@stop