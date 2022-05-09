@extends('layouts.master', ['title' => 'Chart of account'])
@section('auto')
    <style>
        table.dataTable td {
            font-size: 13px;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Chart of account</h4>
        </div>
        <div class="col-sm-8 text-right m-b-20">
            {{-- <a href="{{ route('finance.chart.create') }}" class="btn btn btn-primary btn-rounded float-right"><i
                    class="fa fa-plus"></i> Add chart of account</a> --}}
            <button type="button" class="btn btn-primary btn-rounded float-right" data-toggle="modal"
                data-target="#exampleModal">
                <i class="fa fa-plus"></i>
                Add chart of account
            </button>
        </div>
    </div>
    <x-alert></x-alert>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped" id="chart" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 5%">No</th>
                                    <th>Account No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th style="width: 20px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($parent as $item)
                                    <tr>
                                        <td> {{ ++$i }} </td>
                                        <td>
                                            {{ $item->kode }}
                                        </td>

                                        <td>
                                            {{ $item->deskripsi }} </td>

                                        <td style="font-weight: 500"> {{ $item->category->nama_cat }} </td>
                                        <td> @currency($item->balance) </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($item->children as $child)
                                        <tr>
                                            <td> {{ ++$i }} </td>
                                            <td>
                                                {{ $child->kode }}
                                            </td>
                                            <td>
                                                &nbsp; &nbsp; &nbsp; {{ $child->deskripsi }}

                                            </td>
                                            <td> {{ $child->category->nama_cat }} </td>
                                            <td> @currency($child->balance) </td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal{{ $child->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        @foreach ($child->children as $subchild)
                                            <tr>
                                                <td> {{ ++$i }} </td>
                                                <td>
                                                    {{ $subchild->kode }}
                                                </td>
                                                <td>
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $subchild->deskripsi }}

                                                </td>
                                                <td> {{ $subchild->category->nama_cat }} </td>
                                                <td> @currency($subchild->balance) </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#editModal{{ $subchild->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($chart as $ch)
                            <!-- Modal Edit Chart of Account -->
                            <div class="modal fade" id="editModal{{ $ch->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                                <div class="modal-dialog " style="max-width: 650px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel">
                                                Edit Chart of account</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">&times;</button>
                                        </div>
                                        <form action="{{ route('finance.update.chart', $ch->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Account type</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control type" name="cat_id" id="cat_id">
                                                            <option>--Select Type--</option>
                                                            @foreach ($cat as $item)
                                                                @if ($item->id_cat == $ch->cat_id)
                                                                    <option selected value="{{ $item->id_cat }}">
                                                                        {{ $item->nama_cat }}</option>
                                                                @else
                                                                    <option value="{{ $item->id_cat }}">
                                                                        {{ $item->nama_cat }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Account No</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="kode"
                                                            value="{{ $ch->kode }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="deskripsi"
                                                            value="{{ $ch->deskripsi }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label ">Sub Account</label>
                                                    <div class="col-md-9">
                                                        <select name="child_numb" id="child-numb" class="form-control root">
                                                            @php
                                                                foreach ($cat as $key) {
                                                                    if ($key->id_cat == $ch->cat_id) {
                                                                        $idcat = $key->id_cat;
                                                                    }
                                                                }
                                                                $data = DB::table('new_chart_of_account')
                                                                    ->where('cat_id', $idcat)
                                                                    ->get();
                                                                
                                                            @endphp
                                                            <option value="0">--Select sub account--</option>
                                                            @foreach ($data as $dt)
                                                                <option value="{{ $dt->id }}">{{ $dt->deskripsi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Opening Balance</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="balance"
                                                            value="{{ $ch->balance }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Tanggal</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class=" date form-control" name="tanggal"
                                                            value="{{ $ch->tanggal }}">
                                                           
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Notes</label>
                                                    <div class="col-md-9">
                                                        <textarea name="notes" id="notes" rows="5" cols="53">

                                                </textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div> --}}

                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Chart of Account -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog " style="max-width: 650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Add Chart of account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('finance.store.chart') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Account type</label>
                            <div class="col-md-9">
                                <select class="form-control type" name="cat_id" id="cat_id">
                                    <option>--Select Type--</option>
                                    @foreach ($cat as $item)
                                        <option value="{{ $item->id_cat }}">{{ $item->nama_cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Account No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label ">Sub Account</label>
                            <div class="col-md-9">
                                <select name="child_numb" id="child-numb" class="form-control root">
                                    <option selected value="0">--Select sub account--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Opening Balance</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="balance">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Tanggal</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="tanggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Notes</label>
                            <div class="col-md-9">
                                <textarea name="notes" id="notes" rows="5" cols="53">

                                </textarea>
                            </div>
                        </div>
                        {{-- <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
    <script type="text/javascript">
        $(function() {
            $('.date').datepicker({
                format: 'dd-mm-yyyy'  
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#chart thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#chart thead');

            $('#chart').DataTable({
                processing: true,
                // serverSide: true,
                orderCellsTop: true,
                fixedHeader: true,
                dom: 'Blfrtip',
                columnDefs: [{
                        targets: 5,
                        className: 'dt-body-center'
                    },
                    {
                        targets: 0,
                        className: 'dt-body-center'
                    },
                    {
                        targets: 1,
                        width: '15%'
                    },
                    {
                        targets: 4,
                        width: '20%'
                    }
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

                // ajax: "/finance/chart/json",

                // ajax: {
                //     url: '/finance/payment/json',
                //     get: 'get',
                //     data: {
                //         from_date: from_date,
                //         to_date: to_date
                //     }

                // },

                // columns: [{
                //         data: 'DT_RowIndex',
                //         name: 'DT_RowIndex',

                //     },
                //     {
                //         data: 'kode',
                //         name: 'kode',
                //     },
                //     {
                //         data: 'deskripsi',
                //         name: 'deskripsi',
                //     },
                //     {
                //         data: 'type',
                //         name: 'type',
                //     },
                //     {
                //         data: 'balance',
                //         name: 'balance',
                //         render: $.fn.dataTable.render.number('.', '.', 0, 'Rp. ')
                //     },
                //     {
                //         data: 'action',
                //         name: 'action',
                //     },
                // ]
            });
        });
    </script>

    <script>
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
    </script>
@endsection
