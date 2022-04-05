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

    <title>Tukar Faktur</title>
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
            <div class="col-md-6 col-md-offset-1 body-main">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-5">
                            <div class="dashboard-logo">
                                <img style="width:150px;" src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                            </div>

                        </div>
                        <div class="col-6">
                            <h2><span style="color:black; font-size: 30px;">Tanda Terima <br>Tukar Faktur</span>
                            </h2>
                        </div>
                        <div class="col-1">
                        </div>
                    </div>
                    <hr style="border: solid;"><br>
                   
                    @foreach($detail as $tur)
                    @endforeach
                 
                    <table class="table table-borderless">
                        <tr>
                            <td style="padding-right: 0px;">
                                <table cellspacing="5" cellpadding="5">

                                    <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                        <tr>
                                            <td>Nama Vendor</td>
                                            <td>:</td>
                                            <td>{{ $tur->nama }}</td>

                                        </tr>
                                        <tr>
                                            <td>Nilai Invoice </td>
                                            <td>:</td>
                                            <td> @currency($tur->nilai_invoice)</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Pembayaran </td>
                                            <td>:</td>
                                            <td>{{$tur->status_pembayaran}}</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </td>
                            <td style="padding-right: 150px;">

                            </td>
                            <td>
                                <table cellspacing="5" cellpadding="5">

                                    <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                        <tr>
                                            <td>No Faktur</td>
                                            <td>:</td>
                                            <td>{{$tur->no_faktur}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>{{ Carbon\Carbon::parse($tur->tanggal_tukar_faktur)->format('d/m/Y') }}
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered  report">
                                    <tr style="font-size:14px;" class="bg-success">
                                        <th class=" text-light text-center">No.</th>
                                        <th class="text-light text-center">Kelengkapan Dokumen</th>
                                        <th class="text-light text-center">Ada</th>
                                        <th class="text-light text-center">Tidak Ada</th>
                                        <th class="text-center text-light" style="width: 210px;"> Catatan</th>
                                    </tr>
                                    <tbody>
                                        @foreach($detail as $dokumens)
                                        <tr style="font-size:14px;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dokumens->nama_dokumen }}</td>
                                            <td>{{ $dokumens->pilihan == 'Y'? "√" : "" }}</td>
                                            <td>{{ $dokumens->pilihan == 'T' ? "√" : ""}}</td>
                                            <td>{{ $dokumens->catatan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 
                   <table class="table table-borderless">
                    <tr>
                        <td style="padding-right: 100px;">
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                    <tr>
                                        <div class="form-group">
                                            <p style="margin-top:20px;font-size:12px;" class="text-center">
                                                Pengirim,
                                            </p>
                                            <br>
                                           
                                            <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">
                                                (.......................................)</p>
                                            <p style="margin-top: -10px;font-size:12px;" class="text-center m-b-2">
                                                Nama
                                                Jelas</p>
                                        </div>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="padding-right: 150px;">

                        </td>
                        <td>
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                    <div class="form-group">
                                        <p style="margin-top:20px;font-size:12px;" class="text-center">
                                            Penerima,
                                        </p>
                                        <br>
                                       
                                        <p style="margin-top: 40px;font-size:12px;" class="text-center m-b-2">
                                            (.......................................)</p>
                                        <p style="margin-top: -10px; font-size:12px;" class="text-center m-b-2">
                                            Nama
                                            Jelas</p>
                                    </div>

                                </tbody>

                            </table>
                        </td>
                    </tr>
                    </table>
                   
                    <div class="row">
                        <div class="col-sm-12 col-sg-4 m-b-4">

                            <div class="form-group">
                                <p class="text-left" style="text-decoration:underline;font-size:10px;">
                                    <strong>Syarat Tukar Faktur</strong></p>
                                <ul style="list-style-type: square; margin-top:-15px;margin-left:-15px;font-size:12px;">
                                    <li>Peneromaan tukar faktur setiap hari Selasa dan Kamis jam 10.00 s/d jam
                                        15.00
                                        WIB</li>
                                    <li>Pembayaran direalisasikan setiap hari selasa</li>
                                    <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                    <li>Divisi keuangan berhak menolak dokumen tagihan jika terdapat kekurangan
                                        dokumen dan</li>
                                    <li>Realisasi pembayaran vendor dilakukan melalui transfer</li>
                                    <li>adanya kesalahan ketik atau perhitungan</li>
                                </ul>
                            </div>
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
