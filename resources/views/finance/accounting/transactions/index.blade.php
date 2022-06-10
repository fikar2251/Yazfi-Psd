@extends('layouts.master', ['title' => 'Transactions'])
@section('auto')
    <style>
        table.dataTable td {
            font-size: 12px;
            font-family: Helvetica;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Transactions</h4>
        </div>
        {{-- <div class="col-sm-8 text-right m-b-20">
            <button type="button" class="btn btn-primary btn-rounded float-right" data-toggle="modal"
                data-target="#exampleModal">
                <i class="fa fa-plus"></i>
                Add chart of account
            </button>
        </div> --}}
    </div>
    <x-alert></x-alert>
    <br />
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body"> --}}
    <div class="table-responsive">
        <form action="{{route('finance.balance')}}" method="POST" target="_blank    " >
            @csrf
            <div class="w-25 d-flex flex-row mb-3">
                <select name="laporan" id="" class="form-control ">
                    <option value="">Select</option>
                    <option value="1">Balance of Sheet</option>
                    <option value="2">Profit & Loss</option>
                </select>
                <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                    Laporan
                </button>
            </div>
        </form>
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 25%">Sumber</th>
                    <th>Tanggal</th>
                    <th>Nama Akun</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
                                    $i = 0;
                                @endphp --}}
                {{-- @foreach ($transactions as $item)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            {{ $item->name }} {{ $item->no_transaksi }}
                        </td>
                        <td> {{ Carbon\Carbon::parse($item->date)->format('d-m-Y') }} </td>
                        <td> {{ $item->deskripsi }} </td>
                        <td>
                            @if ($item->debit == '')
                            @else
                                @currency($item->debit)
                            @endif
                        </td>

                        <td>
                            @if ($item->credit == '')
                            @else
                                @currency($item->credit)
                            @endif
                        </td>
                        <td>
                            @if ($item->last_balance == '')
                            @else
                                @currency($item->last_balance)
                            @endif
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    {{-- </div>
            </div>
        </div>
    </div> --}}

@stop
@section('footer')
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"
        type="text/javascript"></script>
    {{-- <script type="text/javascript">
        $(function() {
            $('.date').datepicker({
                format: 'dd-mm-yyyy'  
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $.noConflict();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#transactions thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#transactions thead');

            $('#transactions').DataTable({
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                fixedHeader: true,
                dom: 'lfrtip',
                columnDefs: [{
                        targets: 0,
                        className: 'dt-body-center'
                    },
                    // {
                    //     targets: 0,
                    //     className: 'dt-body-center'
                    // },
                    //     {
                    //         targets: 1,
                    //         width: '15%'
                    //     },
                    //     {
                    //         targets: 4,
                    //         width: '20%'
                    //     }
                ],
                buttons: [{
                        extend: 'copy',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        title: 'Konfirmasi Bayar',
                        messageTop: 'Tanggal  {{ request('from') }} - {{ request('to') }}',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        title: 'Konfirmasi Bayar ',
                        messageTop: 'Tanggal {{ request('from') }} - {{ request('to') }}',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        title: 'Konfirmasi Bayar ',
                        messageTop: 'Tanggal {{ request('from') }} - {{ request('to') }}',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html(
                                '<input class="form-control" type="text" placeholder="' +
                                title + '" style="width: 100%"/>');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                // order: [
                //     [0, 'desc']
                // ],

                // ajax: {
                //         url: '/finance/ajax_transcation',
                //         get: 'get',
                //         // data: {
                //         //     from_date: from_date,
                //         //     to_date: to_date
                //         // }

                //     },

                    ajax: "/finance/transction/json",

                    columns: [{
                            data: 'id',
                            name: 'id',
                            className: 'dt-body-center'
                        },
                        {
                            data: 'sumber',
                            name: 'sumber',
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal',
                        },
                        {
                            data: 'deskripsi',
                            name: 'deskripsi',
                        },
                        {
                            data: 'debit',
                            name: 'debit',
                            render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                        },
                        {
                            data: 'credit',
                            name: 'credit',
                            render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                        },

                        {
                            data: 'last_balance',
                            name: 'last_balance',
                            render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                        },
                    ]
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.type').change(function() {
                var cat_id = $(this).val();
                var child_numb = $(this).val();
                var div = $(this).parent();
                var op = " ";

                console.log(cat_id);
                $.ajax({
                    url: `/finance/account`,
                    method: "get",
                    data: {
                        'cat_id': cat_id,
                        'child_numb': child_numb,
                    },

                    success: function(data) {
                        // if (data) {
                        console.log(data);
                        op += '<option value="0">--Select Sub account--</option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value=" ' + data[i].id + ' ">' + data[i].deskripsi +
                                '</option>'
                        };
                        $('.root').html(op);
                    },
                    error: function() {

                    },



                })
            })
        })
    </script> --}}
@endsection
