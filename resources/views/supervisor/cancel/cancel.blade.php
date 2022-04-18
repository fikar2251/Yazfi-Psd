@extends('layouts.master', ['title' => 'Pembatalan'])

@section('content')

    @php

    use App\Marketing;
    use App\Spr;
    use App\PembatalanUnit;

    $AWAL = 'PB';
    $noUrutAkhir = PembatalanUnit::max('id');

    $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">FORM INPUT PEMBATALAN </h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_transaksi" id="tanggal" value="{{ $nourut }}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="tanggal_transaksi" id="tanggal_transaksi"
                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Sales <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="nama_sales" id="nama_sales" value="{{ $nama->user->name }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET">
        <div class="form-group row d-flex justify-content-center mt-2">
            <label for="name" class="col-sm-2">Masukkan nomor SPR :</label>
            <div class="col-sm-3">
                <select name="no_transaksi" id="spr" class="form-control select2">
                    @if (!request()->get('no_transaksi'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($spr as $item)
                        @if (request()->get('no_transaksi') == $item->no_transaksi)
                            <option value="{{ $item->no_transaksi }}" selected>{{ $item->no_transaksi }} / {{$item->nama}}</option>
                        @else
                            <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }} / {{$item->nama}}</option>
                        @endif
                    @endforeach
                </select>
                {{-- <input type="text" name="no_transaksi" id="transaksi" class="typeahead form-control"> --}}
            </div>
            <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </form>


    @if (request()->get('no_transaksi'))
        @if (request()->get('no_transaksi') == $idbatal)
            <h2 class="text-center mt-5"> Anda sudah input SPR ini</h2>
        @else
            <form action="{{ route('supervisor.cancel.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8 container">
                        <div class="card shadow">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table table-striped">
                                        <thead>
                                            {{-- @foreach ($getSpr as $item) --}}
                                            <tr>
                                                <th style="width: 200px">NO</th>
                                                <th style="width: 20px">:</th>
                                                <th> {{ $nourut }} <input type="hidden" name="no_transaksi" value="">
                                                </th>

                                            </tr>
                                            {{-- @endforeach --}}
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Tanggal</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                            </tr>
                                            @foreach ($getSpr as $item)
                                                <tr>
                                                    <td style="width: 200px">Harga pembelian</td>
                                                    <td style="width: 20px">:</td>
                                                    <td>
                                                        @currency($item->harga_net)
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td style="width: 200px">Unit</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->unit->type }} <input type="hidden" name="id_spr"
                                                        value="{{ $item->id_transaksi }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">LT</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->unit->lt }} M<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">LB</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->unit->lb }} M<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Sales</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->user->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">SPV</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ auth()->user()->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Alasan pembatalan</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    <textarea name="alasan" id="alasan" cols="30" rows="5"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center">
                    <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </form>
        @endif
    @endif

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        var path = "{{ route('supervisor.autocomplete') }}";
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
    <script>
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function() {
            $('.rincian').change(function() {
                var rincian_id = $(this).val();
                var nominal = $(this).val();
                var div = $(this).parent();
                var op = " ";

                console.log(rincian_id);
                $.ajax({
                    url: `/supervisor/nominal`,
                    method: "get",
                    data: {
                        'rincian_id': rincian_id,
                        'nominal': nominal,
                    },
                    success: function(data) {
                        console.log(data);

                        for (var i = 0; i < data.length; i++) {

                            var nominal = data[i].jumlah_tagihan;
                            document.getElementById('nominal').value = nominal;
                        };
                    },
                    error: function() {

                    },

                })
            })
        })
    </script>
@stop
