@extends('layouts.master', ['title' => 'Jurnal Voucher'])
@section('auto')
    <style>
        table.dataTable td {
            font-size: 13px;
            font-family: Helvetica;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-title">Jurnal Voucher</h1>
        </div>
        <div class="col-sm-8 text-right m-b-20">
            {{-- <a href="{{ route('finance.chart.create') }}" class="btn btn btn-primary btn-rounded float-right"><i
                    class="fa fa-plus"></i> Add chart of account</a> --}}
            <a href="/finance/jurnal/create" class="btn btn-primary btn-rounded float-right">
                <i class="fa fa-plus"></i>
                Add jurnal voucher
            </a>
        </div>
    </div>
    <x-alert></x-alert>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" id="card">
                <div class="card-body">
                    {{-- <div class="row custom-invoice">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <div class="dashboard-logo">
                                <img src="{{ url('/img/logo/yazfi.png ') }}" alt="Image" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <div class="invoice-details">
                                <h3 class="text-uppercase"></h3>
                            </div>
                        </div>
                    </div> --}}
                    <table class="table table-bordered custom-table table-striped" id="jurnal" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 5%">No</th>
                                <th style="width: 25%">Sumber</th>
                                <th>Tanggal</th>
                                <th>Nama Akun</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Saldo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer')
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
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
    
    <script>
        $(document).ready(function() {
            $.noConflict();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#jurnal thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#jurnal thead');

            $('#jurnal').DataTable({
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
                order: [
                    [0, 'desc']
                ],

                // ajax: {
                //         url: '/finance/ajax_transcation',
                //         get: 'get',
                //         // data: {
                //         //     from_date: from_date,
                //         //     to_date: to_date
                //         // }

                //     },

                ajax: "/finance/ajax/ajax_jurnal",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
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
                        data: 'saldo',
                        name: 'saldo',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'dt-body-center'
                    },

                ]
            });
        });
    </script>
@endsection
