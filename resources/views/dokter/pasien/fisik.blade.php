@extends('layouts.master', ['title'=>'Fisik Pasien'])

@section('content')
<div class="panel-group" id="accordion">

    @forelse($fisik as $data)
    <div class="card shadow panel panel-default">
        <div class="card-header panel-heading">
            <h4 class="card-title panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $data->id }}">{{ $data->id }}.{{ App\Customer::find($data->customer_id)->nama }}</a>
            </h4>
        </div>
        <div id="collapse{{ $data->id }}" class="panel-collapse collapse in">
            <div class="panel-body card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gol_darah">gol darah</label>
                            <input type="text" readonly value="{{ $data->gol_darah }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">tekanan_darah</label>
                            <input type="text" readonly value="{{ $data->tekanan_darah }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gol_darah">penyakit jantung</label>
                            <input type="text" readonly value="{{ $data->pny_jantung }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gol_darah">diabetes</label>
                            <input type="text" readonly value="{{ $data->diabetes }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gol_darah">haemopilia</label>
                            <input type="text" readonly value="{{ $data->haemopilia }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gol_darah">hepatitis</label>
                            <input type="text" readonly value="{{ $data->hepatitis }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">penyakit lainnya</label>
                            <input type="text" readonly value="{{ $data->pny_lainnya }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">alergi obat</label>
                            <input type="text" readonly value="{{ $data->alergi_obat }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">alergi makanan</label>
                            <input type="text" readonly value="{{ $data->alergi_makanan }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">Keterangan lainnya</label>
                            <input type="text" readonly value="{{ $data->ket_lainnya }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">Keterangan tekanan</label>
                            <input type="text" readonly value="{{ $data->ket_tekanan }}" class="form-control">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="gol_darah">Keterangan obat</label>
                            <input type="text" readonly value="{{ $data->ket_obat }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning">
        <h4 class="text-center"><strong>Empty</strong></h4>
    </div>
    @endforelse
</div>
@stop