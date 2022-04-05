@extends('layouts.master', ['title' => 'Daftar Komisi'])
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar Komisi</h4>
        </div>
    </div>

    <form action="{{ route('finance.store.list.komisi') }}" method="POST">
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
                                <th>Tanggal Pembayaran</th>
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
                                    <td style="width: 80px">
                                        <div style="width: 100px" class="input-group date" data-provide="datepicker"
                                            data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control" name="tanggal_pembayaran">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </td>
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
        <div class="m-t-20 text-center">
            <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                Save</button>
        </div>
    </form>
@stop
