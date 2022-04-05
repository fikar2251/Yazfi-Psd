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
                                            <td style="text-align: center">{{ $item->id }} <input type="hidden"
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
                                                <select name="status[]" id="status" class="form-control rincian"
                                                    style="width: 150px">
                                                    <option selected value="">Select status</option>
                                                    <option value="paid">paid</option>
                                                    <option value="reject">reject</option>
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
