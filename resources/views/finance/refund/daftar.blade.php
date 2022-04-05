@extends('layouts.master', ['title' => 'Daftar Refund'])
@section('content')

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar Refund </h4>
        </div>
    </div>

    <form action="{{ route('finance.store.list.refund') }}" method="POST">
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
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>No Refund</th>
                                        <th>No Pembatalan</th>
                                        <th>Konsumen</th>
                                        <th>Sales</th>
                                        <th>Total refund</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($refund as $item)
                                        <tr>
                                            <td> {{ $item->id }} <input type="hidden" name="id[]"
                                                    value="{{ $item->id }}"> </td>
                                            <td>{{ $item->tanggal_refund }}</td>
                                            <td>
                                                @if ($item->tanggal_pembayaran)
                                                    {{ $item->tanggal_pembayaran }}
                                                @else
                                                    <div style="width: 100px" class="input-group date"
                                                        data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control" name="tanggal_pembayaran">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->no_refund }}
                                            </td>
                                            <td>
                                                {{ $item->no_pembatalan }}
                                            </td>
                                            <td>
                                                {{ $item->pembatalan->spr->nama }}
                                            </td>
                                            <td>
                                                {{ $item->pembatalan->spr->user->name }}
                                            </td>
                                            <td>
                                                {{ $item->total_refund }}
                                            </td>
                                            <td>
                                                @if ($item->status == 'unpaid')
                                                    <span class="custom-badge status-red">{{ $item->status }}</span>
                                                @elseif ($item->status == 'paid')
                                                    <span class="custom-badge status-green">{{ $item->status }}</span>
                                                @elseif ($item->status == 'reject')
                                                    <span class="custom-badge status-orange">{{ $item->status }}</span>
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
