@extends('layouts.master', ['title' => 'Komisi'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-title">Change Komisi</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Change Komisi</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('supervisor.komisi.updatechange', $komisi->id) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="dokter_id">Nama Dokter</label>
                            <input type="text" name="dokter_id" id="dokter_id" class="form-control" value="{{ $komisi->user->name }}" readonly>

                            @error('dokter_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="dokter_baru_id">Nama Dokter Pengganti</label>
                            <select name="dokter_baru_id" id="dokter_baru_id" class="form-control">
                                <option disabled selected>-- Pilih Dokter --</option>
                                @foreach($dokter as $dok)
                                <option value="{{ $dok->id }}">{{ $dok->name }}</option>
                                @endforeach
                            </select>

                            @error('dokter_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nominal_komisi">Nominal Komisi</label>
                            <input type="number" name="nominal_komisi" id="nominal_komisi" class="form-control" value="{{ $komisi->nominal_komisi }}" data-nominal="{{ $komisi->nominal_komisi }}">

                            @error('nominal_komisi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nominal_komisi">Nominal Komisi</label>
                            <input type="number" name="nominal_komisi_baru" id="nominal_komisi_baru" class="form-control" value="0">

                            @error('nominal_komisi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $("#nominal_komisi_baru").on('keyup', function() {
        let nominal = parseInt($("#nominal_komisi").attr('data-nominal'));
        let nominal_baru = parseInt($(this).val());
        let total = nominal - nominal_baru;

        $("#nominal_komisi").val(total)
    });
    // $("#dokter_baru_id").on('change', function() {
    //     let nominal = parseInt($("#nominal_komisi").val());
    //     let nominal_baru = nominal * 70 / 100;

    //     $("#nominal_komisi_baru").val(nominal_baru)
    //     $("#nominal_komisi").val(nominal - nominal_baru)

    // });
</script>
@stop