@extends('layouts.master' ,['title' => 'History'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Riwayat Pemeriksaan Pasien</div>

            <div class="card-body">
                <a href="{{ route('admin.pasien.cetakriwayat', $customer->id) }}" class="btn btn-sm btn-danger mb-3"><i class="fa fa-print"></i> Cetak Riwayat</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Gigi</th>
                                <th>Kondisi</th>
                                <th>Anamnesa</th>
                                <th>Pemeriksa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($riwayat as $his)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($his->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $his->no_gigi }}</td>
                                <td><span style="background-color: {{ $his->simbol->warna }}">&nbsp; &nbsp;&nbsp;</span> {{ $his->simbol->nama_simbol }} ({{ $his->simbol->singkatan }})</td>
                                <td>{{ $his->keterangan }}</td>
                                <td>{{ $his->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop