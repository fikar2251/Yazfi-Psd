<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="yoriadiatma">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Reinburst</title>
    <style>
        @page {
            width: 230mm;
            height: 987mm;
            margin-top: 90px;
        }

        @media screen {

            body {

                font-family: 'Rubik', sans-serif;
                font-size: 0.875rem;
                color: #666;
                background-color: #fafafa;
                overflow-x: hidden;
                height: 100%;
            }


            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0, 0, 0, .3);
                margin: 5mm auto;
                display: block;
            }
        }

        .bg-success,
        .badge-success {
            background-color: #5559ce !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        table.table td h2 {
            display: inline-block;
            font-size: inherit;
            font-weight: 400;
            margin: 0;
            padding: 0;
            vertical-align: middle;
        }

        table.table td h2 a {
            color: #757575;
        }

        table.table td h2 a:hover {
            color: #009efb;
        }

        table.table td h2 span {
            color: #9e9e9e;
            display: block;
            font-size: 12px;
            margin-top: 3px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3 body-main">
                <table class="table table-borderless">
                    <tr>
                        <td style="padding-right: 100px;">
                            <table cellspacing="5" cellpadding="5">
                                <tbody>
                                    <div class="dashboard-logo">
                                        <img style="width:180px;" src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                    </div>
                                </tbody>
                            </table>
                        </td>
                        <td style="padding-right: 150px;">
                        </td>
                        <td>
                            <table cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <h6><span
                                                style="font-size: 15px; color:white; background-color:blue;">{{$reinbursts->nomor_reinburst}}</span>
                                        </h6>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
                <br>
            
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2><span style="color:blue; text-decoration: underline; font-size: 20px">Pengajuan
                                Reimburse</span></h2>
                    </div>
                </div> <br />
                <table class="table table-borderless">
                    <tr>
                        <td style="padding-right: 0px;">
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 16px; 	font-family: 'Rubik', sans-serif;">

                                    <tr>
                                        <td>Nama </td>
                                        <td>:</td>
                                        <td>{{ $reinbursts->admin->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan </td>
                                        <td>:</td>
                                        <td>{{ $reinbursts->jabatan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Divisi </td>
                                        <td>:</td>
                                        <td> {{ $reinbursts->roles->name }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </td>
                        <td style="padding-right: 180px;">

                        </td>
                        <td>
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 16px; 	font-family: 'Rubik', sans-serif;">

                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ Carbon\Carbon::parse($reinbursts->tanggal_reinburst)->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran</td>
                                        <td>:</td>
                                        <td>{{ $reinbursts->file }}</td>
                                    </tr>

                                </tbody>

                            </table>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered  ">
                                <tr class="bg-success">
                                    <th style="width:10%" class="text-light">No.</th>
                                    <th  style="width:10%"class="text-light">Nota / BON / Kwitansi</th>
                                    <th  style="width:25%" class="text-light">Catatan</th>
                                    <th style="width:20%" class="text-light">Jumlah</th>
                                </tr>
                                <tbody>

                                    @php
                                    $total = 0
                                    @endphp
                                    @foreach(App\RincianReinburst::where('nomor_reinburst',
                                    $reinbursts->nomor_reinburst)->get() as $rein)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rein->no_kwitansi }}</td>
                                        <td>{{ $rein->catatan }}</td>
                                        <td>@currency($rein->harga_beli)</td>
                                    </tr>
                                    @php
                                    $total += $rein->total
                                    @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><strong>Total Reimburse<strong> </td>
                                        <td><b>@currency($total)</b></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-center">Diajukan Oleh,</p>
                                        </td>
                                        <td colspan="1">
                                            <p class="text-center">DiPeriksa dan DiSetujui,</p>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p style="padding-right:5px;">Manager</p>
                                                </div>
                                                <div class="col-6" style="margin-top:-1px; ">
                                                    <p style="padding-right:20px;">Keuangan</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="1">
                                            <p class="text-center">DiKetahui,</p>
                                            <br>
                                            <br>
                                            <p class="text-center">Komisaris</p>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                            <td colspan="6" rowspan="2">Cat :</td>
                                        </tr> -->

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        window.print()

    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
