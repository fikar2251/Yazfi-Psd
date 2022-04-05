@extends('layouts.master', ['title' => ' Komisi'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-title">List Sales</h1>
        </div>
    </div>

    <div class="row doctor-grid">
        @foreach ($user as $u)
            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="#"><img alt="" src="https://w1.pngwing.com/pngs/386/684/png-transparent-face-icon-user-icon-design-user-profile-share-icon-avatar-black-and-white-silhouette.png"
                                style="object-fit: cover; object-position: center;"></a>
                    </div>
                    <h4 class="doctor-name text-ellipsis"><a
                            href="{{ url('supervisor/komisi/' . $u->user->id) }}">{{ $u->user->name }}</a>
                    </h4>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{ $u->user->jabatan->nama }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <x-alert></x-alert>

    <div class="row mt-5">
        <div class="col-md-4">
            <h1 class="page-title">Rincian Komisi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped custom-table" width="100%" id="komisi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Komisi</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>No SPR</th>
                                    <th>Komisi Sales</th>
                                    <th>Komisi SPV</th>
                                    <th>Komisi Manager</th>
                                    <th>Diajukan</th>
                                    <th>Status</th>
                                    <th>Tanggal Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($komisi as $km)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $km->no_komisi }}</td>
                                <td>{{ $km->tanggal_komisi }}</td>
                                <td>{{ $km->no_spr }}</td>
                                <td>@currency($km->nominal_sales)</td>
                                <td>@currency($km->nominal_spv)</td>
                                <td>@currency($km->nominal_manager)</td>
                                <td>{{ $km->spv }}</td>
                                <td>
                                    @if ($km->status_pembayaran == 'unpaid')
                                        <span class="custom-badge status-red">{{ $km->status_pembayaran }}</span>
                                    @elseif ($km->status_pembayaran == 'paid')
                                        <span class="custom-badge status-green">{{ $km->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td>{{ $km->tanggal_pembayaran }}</td>
                            </tr>
                        @endforeach --}}
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.dataTables.min.css">

    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    {{-- <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> --}}
    <script>
        $(function() {
            $('#komisi thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#komisi thead');

            var table = $('#komisi').DataTable({
                processing: true,
                serverSide: true,
                orderCellsTop: true,
                fixedHeader: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
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
                            $(cell).html('<input class="form-control" type="text" placeholder="' +
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
                ajax: "/supervisor/komisi/json",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',

                    },
                    {
                        data: 'no_komisi',
                        name: 'no_komisi',
                    },
                    {
                        data: 'tanggal_komisi',
                        name: 'tanggal_komisi',
                    },
                    {
                        data: 'no_spr',
                        name: 'no_spr',
                    },
                    {
                        data: 'nominal_sales',
                        name: 'nominal_sales',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'nominal_spv',
                        name: 'nominal_spv',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')

                    },
                    {
                        data: 'nominal_manager',
                        name: 'nominal_manager',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'spv',
                        name: 'spv',
                    },
                    {
                        data: 'status_pembayaran',
                        name: 'status_pembayaran',
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                    },
                ]
            });
        });
    </script>
@stop
