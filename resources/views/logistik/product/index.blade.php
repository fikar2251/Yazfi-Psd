@extends('layouts.master', ['title' =>'Report Barang'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Report Barang</h4>
    </div>
</div>

<div class="row input-daterange">
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus">
            <label class="focus-label">From</label>
            <div class="cal-icon">
                <input type="text" name="from" id="from" class="form-control" placeholder="From Date" />
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus">
            <label class="focus-label">To</label>
            <div class="cal-icon">
                <input type="text" name="to" id="to" class="form-control" placeholder="To Date" />
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div style="margin-top:8px;">
        <button type="button" name="filter" id="filter" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        <button type="button" name="refresh" id="refresh" class="btn btn-danger"><i class="fa-solid fa-arrows-rotate"></i></button>
        </div>
    </div>
</div>

@include('logistik.product.table')

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
<script>
    $(document).ready(function () {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $.noConflict();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#product thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#product thead');

        load_data();


        function load_data(from = '', to = '') {
            var from = $('#from').val();
            var to = $('#to').val();

            var table = $('#product').DataTable({
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                fixedHeader: true,
               "dom": "<'row' <'col-sm-12' l>>" + "<'row'<'col-sm-6'B><'col-sm-6'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
                        title: 'Laporan Barang',
                        messageTop:'Tanggal: '  + from + ' - ' + to + ' ',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        title: 'Laporan Barang',
                        messageTop:'Tanggal: '  + from + ' - ' + to + ' ',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        title: 'Laporan Barang ',
                         messageTop:'Tanggal: '  + from + ' - ' + to + ' ',
                        footer: true,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                  
                    // Total over this page
                    pageTotal = api
                        .column(4, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Total over this page
                    Total = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    Total_all = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(4).footer()).html(
                        '' + pageTotal + ' '
                    );
                    $(api.column(5).footer()).html(
                        '' + Total + ' '
                    );
                    $(api.column(6).footer()).html(
                        '' + Total_all + ' '
                    );
                },
                initComplete: function () {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" style="width:70%;" />');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th ').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})';
                                    // $(this).parents('th').find('select').val();

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

                ajax: {
                    url: '/admin/ajax/ajax_product',
                    get: 'get',
                    data: {
                        from: from,
                        to: to
                    }

                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'project',
                        name: 'project'
                    },
                    {
                        data: 'in',
                        name: 'in'
                    },
                    {
                        data: 'out',
                        name: 'out'
                    },
                    {
                        data: 'last',
                        name: 'last'
                    },

                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'admin',
                        name: 'admin'
                    },


                ],


            });
        }
        $('#filter').click(function () {
            var from = $('#from').val();
            var to = $('#to').val();
            if (from != '' && to != '') {
                $('#product').DataTable().destroy();
                load_data(from, to);
            } else {
                alert('Pilih Tanggal Terlebih Dahulu');
            }
        });
        $('#refresh').click(function () {
            $('#from').val('');
            $('#to').val('');
            $('#product').DataTable().destroy();
            load_data();
        });
    });

</script>
@stop
