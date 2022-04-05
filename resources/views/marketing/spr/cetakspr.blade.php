<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/style.css">

    <script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('/') }}js/jquery.printPage.js"></script> --}}

</head>
<style>
    .text-center {
        text-align: center !important
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14;
    }

    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px
    }

    .d-flex {
        display: -ms-flexbox !important;
        display: flex !important
    }

    .justify-content-center {
        -ms-flex-pack: center !important;
        justify-content: center !important
    }

    .col,
    .no-gutters>[class*=col-] {
        padding-right: 0;
        padding-left: 0
    }

    .col,
    .col-1,
    .col-10,
    .col-11,
    .col-12,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-auto,
    .col-lg,
    .col-lg-1,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-auto,
    .col-md,
    .col-md-1,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-auto,
    .col-sm,
    .col-sm-1,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-auto,
    .col-xl,
    .col-xl-1,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th #customers table {
        border: none;
        padding: 5px;
    }


    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }


    #customer {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customer td,
    #customer th,
    #customer table {
        border: 1px solid black;
        padding: 5px;
    }

    /* table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
    } */

    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto
    }

    @media (min-width:576px) {
        .container {
            max-width: 540px
        }
    }

    @media (min-width:768px) {
        .container {
            max-width: 720px
        }
    }

    @media (min-width:992px) {
        .container {
            max-width: 960px
        }
    }

    @media (min-width:1200px) {
        .container {
            max-width: 1140px
        }
    }

    hr {
        margin-bottom: 0px;
        margin-top: 0px;
        color: black;
    }

</style>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <img src="{{ public_path('/img/logo/yazfi.png') }}" alt="" width="120" height="100">
                <div class="text-center">
                    <h4 style="font-size: 30px; font-weight: 500; text-decoration: underline" class="page-title mb-3">
                        SURAT
                        PEMESANAN
                        RUMAH</h4>
                </div>
                <div class=" row d-flex justify-content-center" style="margin-left: 220px">
                    <div class="col-sm-5">
                        <table class="table table-borderless" style="border: none">
                            <tbody>
                                <tr>
                                    <td style="width: 100px; border: none; font-weight: bold">Nomor</td>
                                    <td style="width: 20px; border: none; font-weight: bold">:</td>
                                    <td style="width: 100px; border: none; font-weight: bold">
                                        {{ $spr->no_transaksi }}
                                        <hr>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td style="width: 100px">Tanggal</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->tanggal_transaksi }} </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-title">I. Data Pembeli</h4>
                                <div class="table-responsive container">
                                    <table id="customers" class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Konsumen</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ $spr->nama }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No KTP</td>
                                                <td>:</td>
                                                <td> {{ $spr->no_ktp }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No NPWP</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $spr->npwp }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No Tlp</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $spr->no_tlp }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No HP</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $spr->no_hp }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $spr->email }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $add->alamat }},
                                                    {{ $add->desa->name }},
                                                    {{ $add->kecamatan->name }},
                                                    {{ $add->kota->name }}, {{ $add->provinsi->name }}
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $spr->pekerjaan }}
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-5">II. Data Unit Rumah</h4>
                                <div class="table-responsive container">
                                    <table class="table table-borderless" id="customers">
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">Type</td>
                                                <td style="width: 20px">:</td>
                                                <td colspan="4"> {{ $spr->unit->type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Blok</td>
                                                <td>:</td>
                                                <td> {{ $spr->unit->blok }}


                                                <td style="width: 50px">No</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->unit->no }}

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Luas tanah</td>
                                                <td>:</td>
                                                <td colspan="4">
                                                    {{ $spr->unit->lt }} M<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Luas Bangunan</td>
                                                <td>:</td>
                                                <td colspan="4">
                                                    {{ $spr->unit->lb }} M<sup>2</sup>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Penambahan Luas Tanah</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($spr->unit->nstd = '-')
                                                        -
                                                    @else
                                                        {{ $spr->unit->nstd }} M<sup>2</sup>
                                                    @endif

                                                <td style="width: 50px">Total</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $spr->unit->total }} M<sup>2</sup>
                                                </td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Jual</td>
                                                <td>:</td>
                                                <td>
                                                    @currency($spr->harga_jual)

                                                <td style="width: 100px">Harga Net</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    @currency($spr->harga_net)
                                                </td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="card-title mt-5">III. Data Pembayaran</h4>
                                <div class="table-responsive container">
                                    <table class="table table-borderless" id="customer" style="border: 1px solid black">
                                        <tbody>
                                            <tr style="background-color:darkblue; ">
                                                <td style="color: white">No</td>
                                                <td style="color: white">Termin Pembayaran</td>
                                                <td style="color: white">Jumlah</td>
                                                <td style="color: white">Jadwal</td>
                                                <td style="color: white">Keterangan</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Booking Fee</td>
                                                <td>@currency($bf->jumlah_tagihan)</td>
                                                <td>{{ $bf->jatuh_tempo }}</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Downpayment</td>
                                                <td>@currency($dp->jumlah_tagihan)</td>
                                                <td>{{ $dp->jatuh_tempo }}</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Plafond Kredit</td>
                                                <td>@currency($spr->harga_net - $dp->jumlah_tagihan)</td>
                                                <td>{{ $dp->jatuh_tempo }}</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Total Pembayaran</td>
                                                <td>@currency($dp->jumlah_tagihan + ($spr->harga_net -
                                                    $dp->jumlah_tagihan) + $bf->jumlah_tagihan)</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
