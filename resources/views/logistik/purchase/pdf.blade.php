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

    <title>Purchase Order Logistik</title>
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
                                        <h6><strong>Fomulir:</strong></h6>
                                        <input type="checkbox" />
                                        <label style="font-size:.80em;">Material Delivered</label>
                                    </tr>


                                </tbody>

                            </table>
                        </td>
                    </tr>
                </table>
           
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2><span class="purchase-order">Purchase Order</span></h2>
                    </div>
                </div> <br />
                <br>
                <table class="table table-borderless">
                    <tr>
                        <td style="padding-right: 0px;">
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                    <tr>
                                        <td>Supplier/ Vendor </td>
                                        <td>:</td>
                                        <td> {{ $purchase->supplier->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person </td>
                                        <td>:</td>
                                        <td> {{ $purchase->admin->name }}
                                            -{{ $purchase->admin->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Location </td>
                                        <td>:</td>
                                        <td> {{ $purchase->supplier->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Delevery On Site</td>
                                        <td>:</td>
                                        <td>{{ $purchase->project->nama_project }}<br>{{ $purchase->lokasi }}</td>

                                    </tr>



                                </tbody>
                            </table>
                        </td>
                        <td style="padding-right: 100px;">

                        </td>
                        <td>
                            <table cellspacing="5" cellpadding="5">

                                <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">

                                    <tr>
                                        <td>Date</td>
                                        <td>:</td>
                                        <td> {{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>PO Number</td>
                                        <td>:</td>
                                        <td> {{ $purchase->invoice }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project</td>
                                        <td>:</td>
                                        <td> {{ $purchase->project->nama_project }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project</td>
                                        <td>:</td>
                                        <td> {{ $purchase->project->project_code }}</td>
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
                                <tr style="font-size:12px;" class="bg-success">
                                    <th class="text-light">Acc.</th>
                                    <th class="text-light">No.</th>
                                    <th class="text-light">Description</th>
                                    <th class="text-light">Qty</th>
                                    <th class="text-light">Unit</th>
                                    <th class="text-light">Unit price</th>
                                    <th class="text-light">Total Price</th>
                                </tr>
                                <tbody>
                                    @php
                                    $total = 0
                                    @endphp
                                    @foreach(App\Purchase::where('invoice', $purchase->invoice)->get() as
                                    $barang)
                                    <tr style="font-size:12px;">
                                        <td class=" dynamic-hidden-col">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->barang->nama_barang }}</td>

                                        <td>{{ $barang->qty }}</td>

                                        <td>{{ $barang->unit }}</td>
                                        <td>@currency($barang->harga_beli)</td>
                                        <td>@currency($barang->total)</td>

                                    </tr>
                                    @php
                                    $total += $barang->total
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="font-size:12px;">
                                        <td></td>
                                        <td colspan="4"></td>
                                        <td>SUB TOTAL </td>
                                        <td><b>@currency($total)</b></td>
                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td></td>
                                        <td colspan="4"></td>
                                        <td>PPN</td>
                                        <td><b>{{ $purchase->PPN}}%</b></td>
                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td></td>
                                        <td colspan="4"></td>
                                        <td><strong>TOTAL<strong> </td>
                                        <td><b>@currency($purchase->grand_total)</b></td>
                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td rowspan="20"></td>
                                        <td colspan="4" rowspan="20">
                                            <p class="text-left">Note :</p>
                                        </td>
                                        <td>
                                            <p style="margin-top:20px;" class="text-center">PURCHASING</p>
                                        </td>
                                        <td>
                                            <p class="text-center">MANAGER <br> PROCUREMENT </p>
                                        </td>
                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td rowspan="2">
                                            <p style="margin-top: 40px;" class="text-center m-b-2">
                                                (............................)</p>
                                        </td>
                                        <td rowspan="2">
                                            <p style="margin-top: 40px;" class="text-center m-b-2">
                                                (............................)</p>
                                        </td>
                                    </tr>
                                    <tr style="font-size:12px;">

                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td colspan="4">
                                            <p class="text-center">DIRECTURE</p>
                                        </td>
                                    </tr>
                                    <tr style="font-size:12px;">
                                        <td colspan="4">
                                            <p style="margin-top: 40px;" class="text-center m-b-2">
                                                (............................)</p>
                                        </td>
                                    </tr>
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
