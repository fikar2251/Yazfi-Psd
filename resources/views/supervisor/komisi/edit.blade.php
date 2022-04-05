@extends('layouts.master', ['title' => 'Komisi'])

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1 class="page-title">Edit Komisi</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold card-title">Edit Komisi</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('supervisor.komisi.update', $komisi->id) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="dokter_id">Nama Dokter</label>
                        <input type="text" name="dokter_id" id="dokter_id" class="form-control" value="{{ $komisi->user->name }}" disabled>

                        @error('dokter_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nominal_komisi">Nominal Komisi</label>
                        <input type="number" name="nominal_komisi" id="nominal_komisi" class="form-control" value="{{ $komisi->nominal_komisi }}">

                        @error('nominal_komisi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
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
    $("#dokter_baru_id").on('change', function() {
        let nominal = parseInt($("#nominal_komisi").val());
        let nominal_baru = nominal * 70 / 100;

        $("#nominal_komisi_baru").val(nominal_baru)
        $("#nominal_komisi").val(nominal - nominal_baru)

    });
</script>
@stop