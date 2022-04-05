@extends('layouts.master', ['title' => 'Pasien'])

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h4 class="page-title">Pasien - {{ auth()->user()->cabang->nama }}</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table" id="table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nik KTP</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Suku</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/dokter/ajax/pasien',
                type: 'get'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nik_ktp',
                    name: 'nik_ktp'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'jk',
                    name: 'jk'
                },
                {
                    data: 'suku',
                    name: 'suku'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })
    })
</script>
@stop