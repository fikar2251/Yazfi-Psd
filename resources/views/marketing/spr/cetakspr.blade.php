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
        font-size: 13;
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
        /* font-family: Arial, Helvetica, sans-serif; */
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th #customers table {
        border: 1px solid black;
        padding: 5px;
    }

    #kop {
        /* font-family: Arial, Helvetica, sans-serif; */
        border-collapse: collapse;
        width: 100%;
    }

    #kop td,
    #kop th #kop table {
        border: none;
        padding: 5px;
    }

    #customerss {
        /* font-family: Arial, Helvetica, sans-serif; */
        border-collapse: collapse;
        width: 100%;
    }

    #customerss td,
    #customerss th #customerss table {
        border: none;
        padding: 5px;
    }


    /* #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    } */


    #customer {
        /* font-family: Arial, Helvetica, sans-serif; */
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

    <table id="kop">
        
        <tr>
            <td style="width: 15%">
                <img src="{{ public_path('/img/logo/yazfi.png') }}" alt="" width="90" height="80">
            </td>
            <td style="width: 300px; line-height: 15px">
                <p>
                    <b>PT. YAZFI SETIA PERSADA</b> <br>
                    Komplek Bishub Blok RA Nomor 3, <br>
                    Kelurahan Pabuaran, Kecamatan Gunung Sindur <br>
                    Kabupaten Bogor - Jawa Barat <br>
                    021-75678196
                </p>
            </td>
            <td style="line-height: 15px">
                <p>
                    <b>ASHOKA PARK</b> <br>
                    Jl Jampang <br>
                    Gunung Sindur - Bogor <br>
                    Jawa Barat <br>
                    &nbsp;
                </p>
            </td>
            <td>
                <img src="{{ public_path('/img/ashokapark.jpg') }}" alt="" width="90" height="80">
            </td>
        </tr>
    </table>
    <hr>
    
        <h4 style="font-size: 20px; font-weight: bold; text-decoration: underline; text-align: center">
            SURAT
            PEMESANAN
            RUMAH</h4>

    <table style="border: none; margin-left: 220px; padding-bottom: 0%">
        <tr>
            <td style="width: 100px; border: none;">Nomor</td>
            <td style="width: 20px; border: none;">:</td>
            <td style="width: 100px; border: none;">
                {{ $spr->no_transaksi }}
                <hr>
            </td>
        </tr>
    </table>


    <div class="row mt-3">
        <div class="col-md-10">


            <h4 class="card-title">I. Data Pembeli</h4>
            <div class="table-responsive container">
                <table id="customerss" class="table table-borderless">
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

                            <td style="width: 50px">Informasi</td>
                            <td style="width: 20px">:</td>
                            <td>
                                {{ $spr->sumber_informasi }}
                            </td>

                        </tr>
                        <tr>
                            <td>Blok</td>
                            <td>:</td>
                            <td> {{ $spr->unit->blok }}

                            <td style="width: 50px">No</td>
                            <td style="width: 20px">:</td>
                            <td colspan="4">
                                {{ $spr->unit->no }}

                            </td>



                        </tr>
                        <tr>
                            <td>Luas tanah</td>
                            <td>:</td>
                            <td colspan="7">
                                {{ $spr->unit->lt }} M<sup>2</sup>
                            </td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan</td>
                            <td>:</td>
                            <td colspan="7">
                                {{ $spr->unit->lb }} M<sup>2</sup>

                            </td>
                        </tr>
                        <tr>
                            <td>Penambahan Luas Tanah</td>
                            <td>:</td>
                            <td>
                                @php
                                    $string = preg_replace('/[^0-9]/', '', $spr->unit->nstd);
                                    if ($spr->unit->nstd == $string) {
                                        echo $spr->unit->nstd . ' M<sup>2</sup>';
                                    } elseif ($spr->unit->nstd != $string) {
                                        echo '-';
                                    }
                                @endphp
                            <td style="width: 50px">Total</td>
                            <td style="width: 20px">:</td>
                            <td colspan="4">
                                {{ $spr->unit->total }} M<sup>2</sup>
                            </td>

                            </td>
                        </tr>
                        <tr>
                            <td>Nilai penambahan luas</td>
                            <td>:</td>
                            <td style="text-align: right">
                                @rp($spr->harga_tanah_lebih)

                            <td>Diskon</td>
                            <td>:</td>
                            <td style="text-align: right">
                                {{-- @if ($spr->diskon != null)
                                                    @currency($spr->diskon)
                                                     @else
                                                     -   
                                                    @endif --}}
                                @rp($spr->harga_tanah_lebih - $spr->harga_net_tanah)
                            </td>
                            <td style="width: 100px">Harga Net</td>
                            <td style="width: 20px">:</td>
                            <td style="text-align: right">
                                @rp($spr->harga_net_tanah)
                            </td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td>:</td>
                            <td style="text-align: right">
                                @rp($spr->harga_jual)


                            <td>Diskon</td>
                            <td>:</td>
                            <td style="text-align: right">
                                @rp($spr->diskon)
                            </td>

                            <td style="width: 100px">Harga Net</td>
                            <td style="width: 20px">:</td>
                            <td style="text-align: right">
                                @rp($spr->harga_net)
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <h4 class="card-title mt-5">III. Data Pembayaran</h4>
            <div class="table-responsive container">
                <table class="table table-borderless" id="customer" style="border: 1px solid black">
                    <tbody>
                        <tr style="background-color:darkblue; text-align:center">
                            <td style="color: white; width: 40px; text-align: center">No</td>
                            <td style="color: white">Skema Pembayaran</td>
                            <td style="color: white; width: 150px">Jumlah</td>
                            <td style="color: white">Jadwal</td>
                            <td style="color: white">Keterangan</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">1</td>
                            <td>Booking Fee</td>
                            <td>Rp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                @rp($bf->jumlah_tagihan)</td>
                            <td>
                                {{-- {{ $bf->jatuh_tempo }} --}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center">2</td>
                            <td>Downpayment</td>
                            <td>Rp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                @rp($dp->jumlah_tagihan)</td>
                            <td>
                                {{-- {{ $dp->jatuh_tempo }} --}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center">3</td>
                            <td>Angsuran 1 sd {{ $angs }}</td>
                            <td>Rp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; @rp($tg->jumlah_tagihan)</td>
                            <td></td>
                            <td>x {{ $angs }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center">5</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center">6</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: darkblue; font-weight: 700;">
                            <td style="color: white; font-weight: 700" colspan="2">Total Pembayaran
                            </td>
                            <td style="color: white">
                                {{-- @currency($dp->jumlah_tagihan + ($spr->harga_net -
                                                    $dp->jumlah_tagihan) + $bf->jumlah_tagihan) --}}
                                Rp &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; @rp($dp->jumlah_tagihan +
                                $bf->jumlah_tagihan +
                                $tg->jumlah_tagihan)
                            </td>
                            <td></td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>




</body>

</html>
