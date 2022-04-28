@extends('layouts.master', ['title' => 'Daftar Komisi'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar Komisi</h4>
        </div>
    </div>

    {{-- <form action="{{ route('finance.store.list.komisi') }}" method="POST"> --}}
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table" id="appointments" width="100%">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komisi as $km)
                            <tr>
                                <td>{{ $km->id }} <input type="hidden" name="id[]" value="{{ $km->id }}">
                                </td>
                                <td>{{ $km->no_komisi }}</td>
                                <td style="width: 100px">{{ $km->tanggal_komisi }}</td>
                                <td>{{ $km->no_spr }}</td>
                                <td>@currency($km->nominal_sales)</td>
                                <td style="width: 100px">@currency($km->nominal_spv)</td>
                                <td>@currency($km->nominal_manager)</td>
                                <td>{{ $km->spv }}</td>
                                <td>
                                    @if ($km->status_pembayaran == 'unpaid')
                                        <span class="custom-badge status-red">{{ $km->status_pembayaran }}</span>
                                    @elseif ($km->status_pembayaran == 'paid')
                                        <span class="custom-badge status-green">{{ $km->status_pembayaran }}</span>
                                    @elseif ($km->status_pembayaran == 'reject')
                                        <span class="custom-badge status-orange">{{ $km->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('finance.updatekomisi', $km->id) }}" method="POST">
                                        @csrf
                                        <!-- Button trigger modal -->
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal{{ $km->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $km->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                                            <div class="modal-dialog " style="max-width: 650px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="exampleModalLabel">
                                                            {{ $km->no_komisi }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered custom-table table-striped">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 200px">Tanggal Pengajuan
                                                                        </td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            <div style="width: 200px"
                                                                                class="input-group date"
                                                                                data-provide="datepicker"
                                                                                data-date-format="dd/mm/yyyy">
                                                                                <input type="text" class="form-control"
                                                                                    name="tanggal_komisi"
                                                                                    value="{{ $km->tanggal_komisi }}">
                                                                                <div class="input-group-addon">
                                                                                    <span
                                                                                        class="glyphicon glyphicon-th"></span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">NO Komisi</td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            {{ $km->no_komisi }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">Total Pembayaran Komisi
                                                                        </td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            @currency($km->nominal_sales +
                                                                            $km->nominal_spv + $km->nominal_manager)
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">Karyawan</td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            <table class="table-borderless"
                                                                                style="decoration">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td> {{ $km->sales }}
                                                                                            (Sales) </td>
                                                                                        <td>:</td>
                                                                                        <td> @currency($km->nominal_sales)
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td> {{ $km->spv }}
                                                                                            (Supervisor) </td>
                                                                                        <td>:</td>
                                                                                        <td> @currency($km->nominal_spv)
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td> {{ $km->manager }}
                                                                                            (Marketing Manager) </td>
                                                                                        <td>:</td>
                                                                                        <td> @currency($km->nominal_manager)
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">Sumber Pembayaran
                                                                        </td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            <select class="form-control"
                                                                                name="sumber_pembayaran" id="sumber">
                                                                                @foreach ($bank as $item)
                                                                                    @if ($item->deskripsi == 'Bank BCA')
                                                                                        <option
                                                                                            value="{{ $item->id }}">
                                                                                            BCA
                                                                                        </option>
                                                                                        @elseif ($item->deskripsi == 'Bank BRI')
                                                                                        <option
                                                                                            value="{{ $item->id }}">
                                                                                            BRI
                                                                                        </option>
                                                                                    @else
                                                                                        <option
                                                                                            value="{{ $item->id }}">
                                                                                            Mandiri
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">Tanggal Pembayaran
                                                                        </td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            {{-- <div style="width: 200px"
                                                                                    class="input-group date"
                                                                                    data-provide="datepicker"
                                                                                    data-date-format="dd/mm/yyyy">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="tanggal_pembayaran"
                                                                                        value="">
                                                                                    <div class="input-group-addon">
                                                                                        <span
                                                                                            class="glyphicon glyphicon-th"></span>
                                                                                    </div>
                                                                                </div> --}}
                                                                            {{-- <input type="date" class="form-control"
                                                                                    name="tanggal_pembayaran"
                                                                                    placeholder="dd-mm-yyyy"
                                                                                    value="20-04-2022" min="01-01-1997"
                                                                                    max="31-12-2030"> --}}

                                                                            <div
                                                                                class="datepicker date input-group p-0 shadow-sm">
                                                                                <input type="text"
                                                                                    class="form-control py-4 px-4"
                                                                                    id="reservationDate"
                                                                                    name="tanggal_pembayaran">
                                                                                <div class="input-group-append"><span
                                                                                        class="input-group-text px-4"><i
                                                                                            class="fa fa-clock-o"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 200px">Status
                                                                        </td>
                                                                        <td style="width: 20px">:</td>
                                                                        <td>
                                                                            <select name="status" id="status"
                                                                                class="form-control rincian">
                                                                                @php
                                                                                    foreach ($komisi as $key) {
                                                                                        $status = App\Komisi::where('id', $key->id)->first();
                                                                                    }
                                                                                @endphp

                                                                                <option value="{{ $status->id }}">
                                                                                    {{ $status->status_pembayaran }}
                                                                                </option>
                                                                                <option value="paid">paid</option>
                                                                                <option value="reject">reject
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="m-t-20 text-center">
        <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
            Save</button>
    </div> --}}
    {{-- </form> --}}

@stop
@section('footer')

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {

            // INITIALIZE DATEPICKER PLUGIN
            $('.datepicker').datepicker({
                clearBtn: true,
                format: "dd/mm/yyyy"
            });


            // FOR DEMO PURPOSE
            $('#reservationDate').on('change', function() {
                var pickedDate = $('input').val();
                $('#pickedDate').html(pickedDate);
            });
        });
    </script>
@stop
