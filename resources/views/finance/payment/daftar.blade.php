@extends('layouts.master', ['title' => 'Daftar Pembayaran'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar Pembayaran</h4>
        </div>
    </div>

    <form action="{{ route('finance.store.payment') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered custom-table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal pembayaran</th>
                                        <th>Tipe</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Bank tujuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bayar as $item)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }} <input type="hidden"
                                                    name="id[]" value="{{ $item->id }}"></td>
                                            <td>{{ $item->no_detail_transaksi }} <input type="hidden" name="no_transaksi"
                                                    value="{{ $item->no_detail_transaksi }}"></td>
                                            <td>{{ $item->tanggal_pembayaran }}</td>
                                            <td>
                                                {{ $item->rincian->keterangan }}
                                            </td>
                                            <td>
                                                @currency($item->nominal)
                                            </td>
                                            <td>
                                                @if ($item->status_approval == 'pending')
                                                    <span
                                                        class="custom-badge status-red">{{ $item->status_approval }}</span>
                                                @elseif ($item->status_approval == 'paid')
                                                    <span
                                                        class="custom-badge status-green">{{ $item->status_approval }}</span>
                                                @elseif ($item->status_approval == 'reject')
                                                    <span
                                                        class="custom-badge status-orange">{{ $item->status_approval }}</span>
                                                @endif



                                                {{-- <div class="dropdown action-label">
                                                    <a class="custom-badge status-red dropdown-toggle" href="#"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Pending
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Paid</a>
                                                        <a class="dropdown-item" href="#">Reject</a>
                                                    </div>
                                                </div> --}}

                                            </td>
                                            <td style="width: 110px" class="text-center">
                                                @if ($item->bank_tujuan == 'Bri')
                                                    BRI
                                                @elseif ($item->bank_tujuan == 'Bca')
                                                    BCA
                                                @else
                                                    Mandiri
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <select name="status[]" id="status" class="form-control rincian"
                                                    style="width: 150px">
                                                    <option selected value="">Select status</option>
                                                    <option value="paid">paid</option>
                                                    <option value="reject">reject</option>
                                                </select>
                                                <br> --}}

                                                <!-- Button trigger modal -->
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">
                                                                    {{ $item->no_detail_transaksi }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered custom-table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <td style="width: 200px">Tanggal Pembayaran
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    <div style="width: 200px"
                                                                                        class="input-group date"
                                                                                        data-provide="datepicker"
                                                                                        data-date-format="dd/mm/yyyy">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="tanggal_pembayaran">
                                                                                        <div class="input-group-addon">
                                                                                            <span
                                                                                                class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="width: 200px">NO SPR</th>
                                                                                <th style="width: 20px">:</th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="width: 200px">NO SPR</th>
                                                                                <th style="width: 20px">:</th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="width: 200px">NO SPR</th>
                                                                                <th style="width: 20px">:</th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th style="width: 200px">NO SPR</th>
                                                                                <th style="width: 20px">:</th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>

                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 200px">Konsumen</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <div class="m-t-20 text-center">
            <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                Save</button>
        </div>
    </form>

@stop
