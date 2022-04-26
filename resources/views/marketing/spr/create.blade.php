@extends('layouts.master', ['title' => 'Order SPR '])
@section('content')
    @php

    use App\Marketing;
    use App\Spr;

    $stock = DB::table('unit_rumah')
        ->select('type')
        ->distinct()
        ->get();

    $AWAL = 'SP';
    $noUrutAkhir = Spr::max('id_transaksi');

    $nourut = $AWAL . '/' . sprintf('%02s', abs($id)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <form action="{{ route('marketing.storespr', $id) }}" method="POST">
        @csrf

        <div class="row">
            <div class=" col text-center">
                <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">SURAT PEMESANAN RUMAH</h4>
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
                                name="tanggal" id="tanggal_transaksi" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                            <input type="hidden" name="tanggal_transaksi"
                                value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-4">
                <h4 class="page-title">I. Data Pembeli</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">No KTP</label>
                    <input type="number" name="no_ktp" id="no_ktp" class="form-control" maxlength="16" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">NPWP</label>
                    <input type="number" name="npwp" id="npwp" class="form-control" maxlength="15" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Alamat</label>
                    <textarea name="alamat" id="alamat" required rows="3" class="form-control"></textarea>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Provinsi</label>
                    <select class="form-control provinsi" name="provinsi" id="provinsi" required>
                        <option value="">-- Select Provinsi --</option>
                        @foreach ($provinces as $pv)
                            <option value="{{ $pv->id_prov }}">{{ $pv->name }}</option>
                        @endforeach
                    </select>
                    {{-- <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea> --}}
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Kota/Kabupaten</label>
                    <select name="kota" id="kota" class="form-control kota kota1" data-dependent="lt" required>
                        <option value="">-- Select Kota/Kabupaten --</option>
                    </select>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control kecamatan kecamatan1" required
                        data-dependent="lt">
                        <option value="">-- Select Kecamatan --</option>
                    </select>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Desa</label>
                    <select name="desa" id="desa" class="form-control desa1" data-dependent="lt" required>
                        <option value="">-- Select Desa --</option>
                    </select>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_number">No. Telp</label>
                    <input type="number" name="no_tlp" id="no_tlp" class="form-control" maxlength="11" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">No. HP</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control" maxlength="13" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Sumber Informasi</label>
                    <select name="sumber_informasi" id="sumber_informasi" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="iklan">Iklan</option>
                        <option value="media sosial">Media Sosial</option>
                        <option value="pameran">Pameran</option>
                        <option value="walk-in">Walk In</option>
                        <option value="brosur">Brosur</option>
                        <option value="buyer">Buyer</option>
                        <option value="lain-lain">Lain-lain</option>
                    </select>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-4">
                <h4 class="page-title">II. Data Unit Rumah</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Type</label>
                    <select name="type" id="type" class="form-control dynamic" data-dependent="blok" required>
                        <option value="">-- Select Type --</option>
                        @foreach ($blok as $item)
                            <option value="{{ $item->type }}">{{ $item->type }}</option>
                        @endforeach
                    </select>

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Blok</label>
                    <select name="blok" id="blok" class="form-control dinamis root2" data-dependent="no" required>
                        <option value=""></option>
                    </select>
                    <select hidden name="blok1" id="blok1" class="root6">

                    </select>
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" name="id_unit" id="id_unit" class="form-control" readonly hidden>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">No.</label>
                    <select name="no" id="no" class="form-control lt root1" data-dependent="lt" required>
                        <option value=""></option>
                    </select>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="phone_number">Luas bangunan</label>
                        <div class="row container">
                            <input type="number" name="lb" id="luas_bangunan" class="col-sm-10 form-control root6" readonly>
                            <h3 class="col-sm-2">M<sup>2</sup></h3>
                        </div>

                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="phone_number">Luas tanah</label>
                        <div class="row container">
                            <input type="number" name="lt" id="lt" class="col-sm-10 form-control root4" readonly>
                            <h3 class="col-sm-2">M<sup>2</sup></h3>
                        </div>
                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="phone_number">Penambahan Luas Tanah</label>
                        <div class="row container">
                            <input type="number" name="plt" id="plt" class="col-sm-10 form-control" maxlength="3"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <h3 class="col-sm-2">M<sup>2</sup></h3>
                        </div>

                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="phone_number">Total Luas Tanah</label>
                        <div class="row container">
                            <input type="number" name="tlt" id="tlt" class="col-sm-10 form-control">
                            <h3 class="col-sm-2">M<sup>2</sup></h3>
                        </div>
                        @error('phone_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone_number">Nilai Penambahan Luas tanah</label>
                    <input type="text" name="nilai_tambah" id="nilai_tambah" class="form-control" readonly>
                    <input type="hidden" name="nilai_tambahs" id="nilai_tambahs" class="form-control" readonly>
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Potongan Penambahan Luas tanah</label>
                    <input type="text" name="potongans" id="potongans" class="form-control" maxlength="15"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    <input type="text" name="potonganss" id="potonganss" class="form-control">
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Harga Net Penambahan Luas tanah</label>
                    <input type="text" name="tambah_net" id="tambah_net" class="form-control" maxlength="9"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        readonly>

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_number">Harga Jual</label>
                    <input type="text" name="harga_jual" id="harga_jual" class="form-control" readonly>
                    <input type="hidden" name="harga_juals" id="harga_juals" class="form-control" readonly>
                    <input type="hidden" name="harga_nets" id="harga_nets" class="form-control" readonly>
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Potongan Harga Jual</label>
                    <input type="text" name="potongan" id="potongan" class="form-control" maxlength="15"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    <input type="text" name="potongan1" id="potongan1" class="form-control">
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Harga Net</label>
                    <input type="text" name="harga_net" id="harga_net" class="form-control" readonly>
                    <input type="hidden" name="harga_nett" id="harga_nett" class="form-control">
                    <input type="hidden" name="harga_nettt" id="harga_nettt" class="form-control">

                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-5">
                    <hr>
                </div>
                <div class="form-group">
                    <label for="name">Booking Fee</label>
                    <input type="number" name="booking_fee" id="booking_fee" class="form-control" maxlength="7" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Downpayment</label>
                    <input type="number" name="downpayment" id="downpayment" class="form-control" maxlength="7" required
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Skema Pembayaran</label>
                    <select name="skema" id="skema" class="form-control" required>
                        <option value="">-- Skema Pembayaran --</option>
                        @foreach ($skema as $item)
                            <option value="{{ $item->id_skema }}">{{ $item->nama_skema }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="m-t-20 text-center">
            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>

    </html>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dynamic').change(function() {

                var type = $(this).val();
                var blok = $(this).val();
                var no = $(this).val();
                var lt = $(this).val();
                var div = $(this).parent();
                var op = " ";
                var tp = " ";
                $.ajax({
                    url: `/marketing/blok`,
                    method: "get",
                    data: {
                        'type': type,
                        'blok': blok,
                        'no': no,
                        'lt': lt,
                    },
                    success: function(data) {
                        console.log(data);
                        op += '<option value="0">--Select Blok--</option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].blok + '">' + data[i].blok +
                                '</option>'

                            tp += ' <option hidden selected value="' + data[i].type + '">' +
                                data[i].type + '</option>'
                        };
                        $('.root2').html(op);
                        $('.root6').html(tp);
                    },
                    error: function() {

                    }
                })
            })
        })
        $(document).ready(function() {
            $('.dinamis').change(function() {
                var type = $('.root6').html(tp).val();
                var blok = $(this).val();
                var no = $(this).val();
                var lt = $(this).val();
                var div = $(this).parent();
                var tp = " ";
                var op = " ";
                console.log(type);
                $.ajax({
                    url: `/marketing/no`,
                    method: "get",
                    data: {
                        'type': type,
                        'blok': blok,
                        'no': no,
                        'lt': lt,
                    },
                    success: function(data) {
                        console.log(data);
                        op += '<option value="0">--Select No--</option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value=" ' + data[i].no + ' ">' + data[i].no +
                                '</option>'

                        };
                        $('.root1').html(op);
                    },
                    error: function() {

                    }
                })
            })
        })
        $(document).ready(function() {
            $('.lt').change(function() {
                var type = $('.root6').html(tp).val();
                var blok = $('.root2').html(op).val();
                var no = $(this).val();
                var lt = $(this).val();
                var div = $(this).parent();
                var op = " ";
                var tp = " ";

                console.log(blok)
                $.ajax({
                    url: `/marketing/lt`,
                    method: "get",
                    data: {
                        'type': type,
                        'blok': blok,
                        'no': no,
                        'lt': lt,

                    },
                    success: function(data) {
                        console.log(data);

                        for (var i = 0; i < data.length; i++) {

                            var id_unit = data[i].id_unit_rumah;
                            document.getElementById('id_unit').value = id_unit;

                            var luas_tanah = data[i].lt;
                            document.getElementById('lt').value = luas_tanah;

                            // var l = document.getElementById('no');
                            var harga_jual = data[i].harga_jual;
                            var harganets = data[i].harga_tanah_lebih;
                            var harga_nets = harganets.replace(/[^\w\s]/gi, '');
                            var harga = harga_jual.replace(/[^\w\s]/gi, '');
                            if (isNaN(harga_jual)) {
                                var numRp = new Intl.NumberFormat("id-ID", {
                                    style: "currency",
                                    currency: "IDR"
                                })
                                document.getElementById('harga_jual').value =
                                    numRp.format(harga);
                                document.getElementById('harga_juals').value = harga;
                                document.getElementById('harga_nets').value = harga_nets;
                                document.getElementById('nilai_tambahs').value = harga_nets;
                                document.getElementById('nilai_tambah').value = numRp.format(
                                    harga_nets);
                                document.getElementById('tambah_net').value = numRp.format(
                                    harga_nets);
                            } else {
                                document.getElementById('harga_jual').value = harga_jual;

                            };

                            var harga_net = data[i].total_harga;
                            var harganet = harga_net.replace(/[^\w\s]/gi, '');
                            if (isNaN(harga_net)) {
                                var numRp = new Intl.NumberFormat("id-ID", {
                                    style: "currency",
                                    currency: "IDR"
                                })
                                document.getElementById('harga_net').value = numRp.format(
                                    harganet);
                                document.getElementById('harga_nett').value = harganet;
                                document.getElementById('harga_nettt').value = harganet;
                            } else {
                                document.getElementById('harga_net').value = harga_net;

                            };

                            var luas_bangunan = data[i].lb;
                            document.getElementById('luas_bangunan').value = luas_bangunan;

                            var penambahan = data[i].nstd;
                            document.getElementById('plt').value = penambahan;

                            var total = data[i].total;
                            document.getElementById('tlt').value = total;
                        };
                    },
                    error: function() {

                    },

                })
            })
        })

        $(document).ready(function() {
            $('.provinsi').change(function() {

                var provinsi = $(this).val();
                var kota = $(this).val();
                var op = " ";
                $.ajax({
                    url: `/marketing/kota`,
                    method: "get",
                    data: {
                        'provinsi': provinsi,
                        'kota': kota,
                    },
                    success: function(city) {
                        console.log(city);
                        op += '<option value="0">--Select Kota--</option>';
                        for (var i = 0; i < city.length; i++) {
                            op += '<option value="' + city[i].id_kab + '">' + city[i].name +
                                '</option>'
                        };
                        $('.kota1').html(op);
                    },
                    error: function() {

                    }
                })
            })
        })

        $(document).ready(function() {
            $('.kota').change(function() {

                var kota = $(this).val();
                var kecamatan = $(this).val();
                var op = " ";
                $.ajax({
                    url: `/marketing/kecamatan`,
                    method: "get",
                    data: {
                        'kota': kota,
                        'kecamatan': kecamatan,
                    },
                    success: function(district) {
                        console.log(district);
                        op += '<option value="0">--Select Kecamatan--</option>';
                        for (var i = 0; i < district.length; i++) {
                            op += '<option value="' + district[i].id_kec + '">' + district[i]
                                .name +
                                '</option>'
                        };
                        $('.kecamatan1').html(op);
                    },
                    error: function() {

                    }
                })
            })
        })

        $(document).ready(function() {
            $('.kecamatan').change(function() {

                var kecamatan = $(this).val();
                var desa = $(this).val();
                var op = " ";
                $.ajax({
                    url: `/marketing/desa`,
                    method: "get",
                    data: {
                        'kecamatan': kecamatan,
                        'desa': desa,
                    },
                    success: function(subdistrict) {
                        console.log(subdistrict);
                        op += '<option value="0">--Select Desa--</option>';
                        for (var i = 0; i < subdistrict.length; i++) {
                            op += '<option value="' + subdistrict[i].id_kel + '">' +
                                subdistrict[i].name +
                                '</option>'
                        };
                        $('.desa1').html(op);
                    },
                    error: function() {

                    }
                })
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#potongan").keyup(function() {
                var harga_jual = parseInt($("#harga_juals").val());
                var total_harga = parseInt($("#harga_nettt").val());
                var potongan = $(this).val();
                var potongans = potongan.replace(/[^\w\s]/gi, '');
                var tanah_lebih = parseInt($("#harga_nets").val());
                var potonganss = document.getElementById('potongan1').value = potongans;
                if (potongan == 0 || isNaN(potongan)) {
                    var totals = harga_jual + tanah_lebih;
                    var numRp = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    })
                    document.getElementById('harga_net').value =
                        numRp.format(totals);
                    document.getElementById('harga_nett').value =
                        totals;
                } else {

                    var total = total_harga - potonganss;
                    var numRp = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    })
                    document.getElementById('harga_net').value =
                        numRp.format(total);
                    document.getElementById('harga_nett').value =
                        total;
                }
            });
        });

        $(document).ready(function() {
            $("#potongans").keyup(function() {
                var harga_jual = parseInt($("#harga_juals").val());
                var total_harga = parseInt($("#harga_nett").val());
                var potongan = $(this).val();
                var potongans = potongan.replace(/[^\w\s]/gi, '');
                var tanah_lebih = parseInt($("#harga_nets").val());
                var tanah_lebihs = parseInt($("#nilai_tambahs").val());
                var potonganss = document.getElementById('potonganss').value = potongans;
               
                if (potongan == 0 || isNaN(potongan)) {
                    var total = tanah_lebihs + 0;
                    var harganet = harga_jual + total;
                    var numRp = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    })
                    document.getElementById('tambah_net').value =
                        numRp.format(tanah_lebihs);
                    document.getElementById('harga_nets').value =
                        tanah_lebihs;
                    document.getElementById('harga_net').value =
                        numRp.format(harganet);

                    document.getElementById('harga_nettt').value =
                        harganet;
                } else {
                    var total = tanah_lebihs - potonganss;
                    var harganet = harga_jual + total;
                    var numRp = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR"
                    })
                    document.getElementById('tambah_net').value =
                        numRp.format(total);
                    document.getElementById('harga_nets').value =
                        total;
                    document.getElementById('harga_net').value =
                        numRp.format(harganet);

                    document.getElementById('harga_nettt').value =
                        harganet;
                   
                }

            });

            var rupiah = document.getElementById('potongan');
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
        });

        $(document).ready(function() {
            $("#plt").keyup(function() {
                var lt = parseInt($("#lt").val());
                var plt = parseInt($("#plt").val());
                var total = lt + plt;
                var nilai = plt * 2750000;
                var tanah_net = parseInt($('#harga_nets').val());
                var harga_rmh = parseInt($('#harga_juals').val());
                var total_net = harga_rmh + tanah_net;
                var numRp = new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                })

                if (plt == 0 || isNaN(plt)) {
                  document.getElementById('')  
                } 

                document.getElementById('nilai_tambah').value = numRp.format(nilai);
                document.getElementById('tambah_net').value = numRp.format(nilai);
                document.getElementById('harga_nets').value = nilai;
                document.getElementById('nilai_tambahs').value = nilai;
                document.getElementById('harga_nettt').value = total_net;
                document.getElementById('harga_nett').value = total_net;
                document.getElementById('harga_net').value = numRp.format(total_net);
                $("#tlt").val(total);
            });

            var rupiah = document.getElementById('potongans');
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
        });
    </script>
@stop
