@extends('layouts.master', ['title' => 'Payment'])

@section('content')
    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">INPUT PEMBAYARAN KONSUMEN</h4>
            <div class="text-center">
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
                <select name="no_transaksi" id="spr" class="form-control select2" style="width: 200%">
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
        <form action="{{ route('supervisor.payment.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 container">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        @foreach ($getSpr as $item)
                                            <tr>
                                                <th style="width: 200px">NO SPR</th>
                                                <th style="width: 20px">:</th>
                                                <th> <input type="hidden" name="no_transaksi"
                                                        value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</th>
                                            </tr>
                                        @endforeach
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 200px">Konsumen</td>
                                            <td style="width: 20px">:</td>
                                            <td>{{ $item->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Tanggal Pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <div style="width: 200px" class="input-group date" data-provide="datepicker"
                                                    data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control" name="tanggal_pembayaran">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Tanggal Konfirmasi</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{ Carbon\Carbon::now()->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Nominal</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <input type="text" name="nominals" id="nominal" class="form-control"
                                                    style="width: 200px"> <input type="hidden" name="nominal" id="nominals"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <select name="rincian_id[]" id="rincian-id" class="form-control rincian "
                                                    style="width: 200px" multiple="multiple">
                                                    {{-- <option  value="">-- Pembayaran --</option> --}}
                                                    @foreach ($tagihan as $item)
                                                        {{-- <option value="{{ $item->id_rincian }}"> --}}
                                                        @if ($item->tipe == 1 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">Booking fee</option>
                                                        @elseif ($item->tipe == 1 && $item->status_pembayaran == 'paid')
                                                            <option disabled value="{{ $item->id_rincian }}">Booking fee
                                                            </option>
                                                        @elseif ($item->tipe == 2 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">Downpayment</option>
                                                        @elseif ($item->tipe == 2 && $item->status_pembayaran == 'partial')
                                                            <option value="{{ $item->id_rincian }}">Downpayment</option>
                                                        @elseif ($item->tipe == 2 && $item->status_pembayaran == 'paid')
                                                            <option disabled value="{{ $item->id_rincian }}">Downpayment
                                                            </option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'unpaid')
                                                            <option value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}</option>
                                                            </option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'partial')
                                                            <option value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}</option>
                                                        @elseif ($item->tipe == 3 && $item->status_pembayaran == 'paid')
                                                            <option disabled value="{{ $item->id_rincian }}">
                                                                {{ $item->keterangan }}
                                                            </option>
                                                        @endif
                                                        {{-- </option> --}}
                                                    @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Bank tujuan</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                <select name="bank_tujuan" id="bank_tujuan" class="form-control"
                                                    style="width: 200px">
                                                    <option selected value="">-- Bank tujuan --</option>
                                                    <option value="Bri">BRI</option>
                                                    <option value="Bca">BCA</option>
                                                    <option value="Mandiri">Mandiri</option>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Total pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                @currency($total)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Sisa pembayaran</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                @currency($sisa)
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
            <div class="row mt-5">
                <div class="col-sm-12" style="text-align: center">
                    <h4 class="page-title">Riwayat Pembayaran</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card shadow" style="margin-left: 180px">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Tanggal Jatuh tempo</th>
                                            <th>Nominal</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($tagihan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->jatuh_tempo }}</td>
                                                <td>@currency($item->jumlah_tagihan)</td>
                                                <td>
                                                    {{ $item->keterangan }}
                                                </td>
                                                <td>
                                                    @if ($item->status_pembayaran == 'partial')
                                                        <span class="custom-badge status-orange">partial</span>
                                                    @elseif($item->status_pembayaran == 'unpaid')
                                                        <span class="custom-badge status-red">unpaid</span>
                                                    @elseif($item->status_pembayaran == 'paid')
                                                        <span
                                                            class="custom-badge status-green">{{ $item->status_pembayaran }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        @foreach ($bayar as $item)
        @endforeach
        @if ($item->id)
            <div class="row mt-5">
                <div class="col-sm-12" style="text-align: center">
                    <h4 class="page-title">Konfirmasi Pembayaran</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="card shadow" style="margin-left: 90px">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal konfirmasi</th>
                                            <th>Tanggal pembayaran</th>
                                            <th>Tipe</th>
                                            <th>Nominal</th>
                                            <th>Bank Tujuan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bayar as $item)
                                            <tr>
                                                <td>{{ $item->no_detail_transaksi }}</td>
                                                <td style="width: 100px">{{ $item->tanggal_konfirmasi }}</td>
                                                <td style="width: 100px">{{ $item->tanggal_pembayaran }}</td>
                                                <td>
                                                    @foreach ($item->bayartagihan as $by)
                                                        {{ $by->rincian->keterangan }} <br>
                                                    @endforeach
                                                    {{-- {{$item->rincian->keterangan}} --}}
                                                </td>
                                                <td>
                                                    @currency($item->nominal)
                                                </td>
                                                <td>
                                                    @if ($item->bank_tujuan == 'Bri')
                                                        BRI
                                                    @elseif ($item->bank_tujuan == 'Bca')
                                                        BCA
                                                    @else
                                                        Mandiri
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status_approval == 'pending')
                                                        <span
                                                            class="custom-badge status-red">{{ $item->status_approval }}</span>
                                                    @elseif ($item->status_approval == 'paid')
                                                        <span
                                                            class="custom-badge status-green">{{ $item->status_approval }}</span>
                                                    @elseif ($item->status_approval == 'reject')
                                                        <span
                                                            class="custom-badge status-orange">{{ $item->status_approval }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="{{ route('supervisor.payment.delete', $item->id) }}">
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
    @else
    @endif

@stop
@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js"
        integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.js"
        integrity="sha512-e6Nk3mhokFywlEPtnkGmop6rHh6maUqL0T65yOkbSsJ3/y9yiwb+LzFoSTJM/a4j/gKwh/y/pHiSLxE82ARhJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.css"
        integrity="sha512-Lif7u83tKvHWTPxL0amT2QbJoyvma0s9ubOlHpcodxRxpZo4iIGFw/lDWbPwSjNlnas2PsTrVTTcOoaVfb4kwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css"
        integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $('.select2').select2();
    </script>
    <script>
        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>

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
        $(document).ready(function() {
            // $('#rincian_id').multiselect({
            //     nonSelectedText: '--Pembayaran--',
            //     onChange: function (option,selected) {
            //         var rincian = this.$select.val();
            //         var nominal = this.$select.val();
            //         var div = $(this).parent();
            //         var op = " ";
            //         var token = $("input[name='_token']").val();
            //         if (rincian.length > 0) {
            //             $.ajax({
            //                 url:  `/supervisor/nominal`,
            //                 method: "get",
            //                 data: {
            //                     'rincian': rincian,
            //                     'nominal' : nominal,

            //                 },
            //                 success: function(data) {
            //             // if (data) {
            //             console.log(data);

            //             for (var i = 0; i < data.length; i++) {
            //                 if (data[i].jumlah_tagihan) {
            //                     var nominal = data[i].jumlah_tagihan;
            //                     var numb = nominal;
            //                     var format = numb.toString().split('').reverse().join('');
            //                     var convert = format.match(/\d{1,3}/g);
            //                     var rupiah = convert.join('.').split('').reverse()
            //                         .join('')
            //                 } else {

            //                     var nominal = data;


            //                 }
            //                 document.getElementById('nominal').value = nominal;
            //                 document.getElementById('nominals').value = nominal;
            //                 console.log(rupiah);
            //             };

            //         },
            //         error: function() {

            //         },
            //             })
            //         }
            //     }
            // });
            $('#rincian-id').multiselect({
                nonSelectedText: '--Pembayaran--',
                onChange: function() {
                    var rincian_id = this.$select.val();
                    var nominal = this.$select.val();
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
                            // if (data) {
                            console.log(data);

                            for (var i = 0; i < data.length; i++) {
                                if (data[i].jumlah_tagihan) {
                                    var nominal = data[i].jumlah_tagihan;
                                    var numb = nominal;
                                    var format = numb.toString().split('').reverse().join(
                                        '');
                                    var convert = format.match(/\d{1,3}/g);
                                    var rupiah = convert.join('.').split('').reverse()
                                        .join('')
                                } else {

                                    var nominal = data;


                                }
                                document.getElementById('nominal').value = nominal;
                                document.getElementById('nominals').value = nominal;
                                console.log(rupiah);
                            };

                        },
                        error: function() {

                        },



                    })
                }
            })

            // $('.rincian').change(function() {
            //     var rincian_id = $(this).val();
            //     var nominal = $(this).val();
            //     var div = $(this).parent();
            //     var op = " ";

            //     console.log(rincian_id);
            //     $.ajax({
            //         url: `/supervisor/nominal`,
            //         method: "get",
            //         data: {
            //             'rincian_id': rincian_id,
            //             'nominal': nominal,
            //         },

            //         success: function(data) {
            //             // if (data) {
            //             console.log(data);

            //             for (var i = 0; i < data.length; i++) {
            //                 if (data[i].jumlah_tagihan) {
            //                     var nominal = data[i].jumlah_tagihan;
            //                     var numb = nominal;
            //                     var format = numb.toString().split('').reverse().join('');
            //                     var convert = format.match(/\d{1,3}/g);
            //                     var rupiah = convert.join('.').split('').reverse()
            //                         .join('')
            //                 } else {

            //                     var nominal = data;


            //                 }
            //                 document.getElementById('nominal').value = nominal;
            //                 document.getElementById('nominals').value = nominal;
            //                 console.log(rupiah);
            //             };

            //         },
            //         error: function() {

            //         },



            //     })
            // })


        })

        $('#nominal').on('keyup', function() {
            var input = $(this).val();
            var int = input.replace(/[^\w\s]/gi, '')
            document.getElementById('nominals').value = int;
        });

        var rupiah = document.getElementById('nominal');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    {{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#rincian_id').multiselect();
    });
</script> --}}
@stop
