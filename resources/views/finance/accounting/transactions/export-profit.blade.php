<!DOCTYPE html>
<html lang="en">

<head>
    @php
        header('Content-type: application/vnd-ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename=Laporan Profit & Loss.xls');
    @endphp
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Profit & Loss</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> --}}

    <style>
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 3px 8px;
        }

    </style>
</head>

<body>
    <div>
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Profit & Loss</h4>
        </div>
    </div>
    <x-alert></x-alert>
    <br />
    <div>
        <b> PENDAPATAN / <i>REVENUE</i> </b>
        <hr>
    </div>
    <div>
        <b> PENDAPATAN / <i>REVENUE</i> </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th>Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rev = 0;
                    $i = 0;
                @endphp
                @foreach ($profit as $pr)
                    @if ($pr->cat_id == 8)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $pr->kode }}
                            </td>
                            <td> {{ $pr->deskripsi }} </td>
                            <td> {{ $pr->category->nama_cat }} </td>
                            <td>
                                @currency($pr->balance)
                            </td>
                        </tr>
                        @foreach ($pr->children as $ch)
                            <tr>
                                <td style="text-align: center"> {{ ++$i }} </td>
                                <td>
                                    {{ $ch->kode }}
                                </td>
                                <td> {{ $ch->deskripsi }} </td>
                                <td> {{ $ch->category->nama_cat }} </td>
                                <td>
                                    @currency($ch->balance)
                                </td>
                            </tr>
                            @php
                                $rev += $ch->balance;
                            @endphp
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> HPP / <i>COST OF GOODS SOLD</i> </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $hpp = 0;
                @endphp
                @foreach ($profit as $hp)
                    @if ($hp->cat_id == 13)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $hp->kode }}
                            </td>
                            <td> {{ $hp->deskripsi }} </td>
                            <td> {{ $hp->category->nama_cat }} </td>
                            <td>
                                @currency($hp->balance)
                            </td>
                        </tr>
                        @php
                            $hpp += $hp->balance;
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-5" style="margin-bottom: 10px;">
        <b>
            LABA KOTOR / <i>GROSS PROFIT</i> = @currency($rev - $hpp)
        </b>
    </div>

    <div>
        <b> BEBAN OPERASIONAL / <i>OPERATIONAL COST</i> </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $cost = 0;
                    $costs = 0;
                @endphp
                @foreach ($profit as $ex)
                    @if ($ex->cat_id == 14)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $ex->kode }}
                            </td>
                            <td> {{ $ex->deskripsi }} </td>
                            <td> {{ $ex->category->nama_cat }} </td>
                            <td>
                                @currency($ex->balance)
                            </td>
                        </tr>
                        @foreach ($ex->children as $ch)
                            <tr>
                                <td style="text-align: center"> {{ ++$i }} </td>
                                <td>
                                    {{ $ch->kode }}
                                </td>
                                <td> {{ $ch->deskripsi }} </td>
                                <td> {{ $ch->category->nama_cat }} </td>
                                <td>
                                    @currency($ch->balance)
                                </td>
                            </tr>
                            @foreach ($ch->children as $sc)
                                <tr>
                                    <td style="text-align: center"> {{ ++$i }} </td>
                                    <td>
                                        {{ $sc->kode }}
                                    </td>
                                    <td> {{ $sc->deskripsi }} </td>
                                    <td> {{ $sc->category->nama_cat }} </td>
                                    <td>
                                        @currency($sc->balance)
                                    </td>
                                </tr>
                                @php
                                    $costs += $sc->balance;
                                @endphp
                            @endforeach
                            @php
                                $cost += $ch->balance;
                            @endphp
                        @endforeach
                    @endif
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="mb-5" style="margin-bottom: 10px;">
        <b>
            LABA OPERASI / <i>OPERATING PROFIT</i> = @currency(($rev - $hpp) - $costs)
        </b>
    </div>

    <div>
        <b> PENDAPATAN LAIN LAIN / <i>OTHER INCOME</i> </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $othin = 0;
                @endphp
                @foreach ($profit as $ot)
                    @if ($ot->cat_id == 16)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $ot->kode }}
                            </td>
                            <td> {{ $ot->deskripsi }} </td>
                            <td> {{ $ot->category->nama_cat }} </td>
                            <td>
                                @currency($ot->balance)
                            </td>
                        </tr>
                        @foreach ($ot->children as $ch)
                            <tr>
                                <td style="text-align: center"> {{ ++$i }} </td>
                                <td>
                                    {{ $ch->kode }}
                                </td>
                                <td> {{ $ch->deskripsi }} </td>
                                <td> {{ $ch->category->nama_cat }} </td>
                                <td>
                                    @currency($ch->balance)
                                </td>
                            </tr>
                            @php
                                $othin += $ch->balance;
                            @endphp
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> BEBAN LAINNYA / <i>OTHER EXPENSE</i> </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $othen = 0;
                @endphp
                @foreach ($profit as $otex)
                    @if ($otex->cat_id == 15)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $otex->kode }}
                            </td>
                            <td> {{ $otex->deskripsi }} </td>
                            <td> {{ $otex->category->nama_cat }} </td>
                            <td>
                                @currency($otex->balance)
                            </td>
                        </tr>
                        @foreach ($otex->children as $ch)
                            <tr>
                                <td style="text-align: center"> {{ ++$i }} </td>
                                <td>
                                    {{ $ch->kode }}
                                </td>
                                <td> {{ $ch->deskripsi }} </td>
                                <td> {{ $ch->category->nama_cat }} </td>
                                <td>
                                    @currency($ch->balance)
                                </td>
                            </tr>
                            @php
                                $othen += $ch->balance;
                            @endphp
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-2" style="margin-bottom: 10px;">
        <b>
            LABA RUGI BERSIH (BEFORE TAX) = @currency(($rev - $hpp) - $costs)
        </b>
    </div>

    <div class="mb-5">
        <b>
            LABA RUGI BERSIH (AFTER TAX) = @currency(($rev - $hpp) - $costs)
        </b>
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script> --}}
    <script>
        // $('#table').DataTable({
        //     "bSortCellsTop": true,
        //     dom: 'Blfrtip',
        //     buttons: [{
        //             extend: 'excelHtml5',
        //             footer: true,
        //             exportOptions: {
        //                 modifier: {
        //                     page: 'all',
        //                     selected: null,
        //                 },
        //                 columns: ':visible',

        //             }

        //         },
        //         'copy', 'csv', 'pdf', 'print'
        //     ],
        //     columnDefs: [{
        //         visible: true
        //     }],
        //     "paging": true,
        //     "ordering": true,
        //     "searching": true
        // })
    </script>
</body>

</html>
