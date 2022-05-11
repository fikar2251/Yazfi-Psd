@extends('layouts.master', ['title'=>'Daftar Unit Ashoka Park'])

@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">DAFTAR UNIT ASHOKA PARK </h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="add-doctor.html" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add
                Unit</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="unit" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Type</th>
                                    <th>Blok</th>
                                    <th>No.</th>
                                    <th>LB</th>
                                    <th>LT</th>
                                    <th>NSTD</th>
                                    <th>Total</th>
                                    <th>Harga Jual</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stok as $item)
                                    <tr>
                                        <td>{{ $item->id_unit_rumah }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>

                                            {{ $item->blok }}
                                        </td>
                                        <td>

                                            {{ $item->no }}
                                        </td>
                                        <td>

                                            {{ $item->lb }} M<sup>2</sup>
                                        </td>
                                        <td>{{ $item->lt }} M<sup>2</sup></td>
                                        <td>
                                        {{-- @if ($item->nstd == '-')
                                            -
                                        @else
                                            {{ $item->nstd }} M<sup>2</sup>
                                        @endif --}}
                                        @php
                                            $string = preg_replace("/[^0-9]/","",$item->nstd);
                                           if ($item->nstd == $string) {
                                                echo $item->nstd . ' M<sup>2</sup>';
                                           }elseif ($item->nstd != $string ) {
                                               echo "-";
                                           }
                                        @endphp
                                        </td>
                                        <td>

                                            {{ $item->total }} M<sup>2</sup>
                                        </td>
                                        <td>
                                            @if ($item->harga_tanah_lebih != '' )
                                            Rp. {{ $item->total_harga }}
                                            @else
                                            Rp. {{ $item->harga_jual }}
                                            @endif
                                        </td>
                                        <td>


                                            {{ $item->status_penjualan }}

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
@stop
@section('footer')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.dataTables.min.css">

    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>

    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    {{-- <script>
        $(function() {
            $('#unit').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/marketing/doctor/json",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'blok',
                        name: 'blok'
                    },
                    {
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'lb',
                        name: 'lb'
                    },
                    {
                        data: 'lt',
                        name: 'lt'
                    },
                    {
                        data: 'nstd',
                        name: 'nstd'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'status_penjualan',
                        name: 'status_penjualan'
                    },
                ]
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#unit thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#unit thead');

            var table = $('#unit').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
               
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
                            $(cell).html('<input class="form-control" type="text" placeholder="' + title + '" style="width: 100%"/>');

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
            });
        });
    </script>
@stop
