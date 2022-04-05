@extends('layouts.master', ['title' => 'Kondisi Gigi Pasien'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Kondisi Gigi Pasien</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Kondisi Gigi Pasien {{ $pasien->nama }} / Gigi : {{ $gigi }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('rekam-medis.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $pasien->id }}">
                    <input type="hidden" name="no_gigi" value="{{ $gigi }}">
                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select name="kondisi" id="kondisi" class="form-control">
                            <option disabled selected>-- Pilih Kondisi --</option>
                            @foreach($kondisi as $kond)
                            <option value="{{ $kond->id }}">({{ $kond->singkatan }}) {{ $kond->nama_simbol }}</option>
                            @endforeach
                        </select>

                        @error('kondisi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="anamnesa">Anamnesa</label>
                        <input type="text" name="anamnesa" id="anamnesa" class="form-control">

                        @error('anamnesa')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" id="tindakan" class="form-control">

                        @error('tindakan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">Riwayat Pemeriksaan Gigi {{ $gigi }} Sebelumnya</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Gigi</th>
                                <th>Kondisi</th>
                                <th>Anamnesa</th>
                                <th>Pemeriksa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($history as $his)
                            <tr>
                                <td></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($his->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $his->no_gigi }}</td>
                                <td><span style="background-color:{{ $his->simbol->warna }}">&nbsp; &nbsp;&nbsp;</span> {{ $his->simbol->nama_simbol }} ({{ $his->simbol->singkatan }})</td>
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