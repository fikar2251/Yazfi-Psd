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
                                        {{-- <th>Tanggal Pembayaran</th> --}}
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
                                            <td> {{ $loop->iteration }} <input type="hidden" name="id[]"
                                                    value="{{ $item->id }}"> </td>
                                            <td>{{ $item->tanggal_refund }}</td>
                                            {{-- <td>
                                                @if ($item->tanggal_pembayaran)
                                                    {{ $item->tanggal_pembayaran }}
                                                @else

                                                @endif
                                            </td> --}}
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
                                                <!-- Button trigger modal -->
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal{{ $item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">
                                                                    {{ $item->no_refund }}</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered custom-table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <td style="width: 200px">Tanggal Pengajuan
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    <div style="width: 200px"
                                                                                        class="input-group date"
                                                                                        data-provide="datepicker"
                                                                                        data-date-format="dd/mm/yyyy">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="tanggal_refund[]"
                                                                                            value="{{ $item->tanggal_refund }}">
                                                                                        <div class="input-group-addon">
                                                                                            <span
                                                                                                class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">NO Refund</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->no_refund }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Total Refund
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->total_refund }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Sales</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->pembatalan->spr->user->name }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Customer</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->pembatalan->spr->nama }}
                                                                                </td>
                                                                            </tr>

                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 200px">Sumber Pembayaran
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    <select class="form-control"
                                                                                        name="sumber_pembayaran[]"
                                                                                        id="sumber">
                                                                                        <option selected
                                                                                            value="{{ $item->sumber->id_chart_of_account }}">
                                                                                            {{ $item->sumber->nama_bank }}
                                                                                        </option>
                                                                                        @foreach ($account as $item)
                                                                                            @if ($item->nama_bank != '')
                                                                                                <option
                                                                                                    value="{{ $item->id_chart_of_account }}">
                                                                                                    {{ $item->nama_bank }}
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
                                                                                    <div style="width: 200px"
                                                                                        class="input-group date"
                                                                                        data-provide="datepicker"
                                                                                        data-date-format="dd/mm/yyyy">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="tanggal_pembayaran[]"
                                                                                            value="">
                                                                                        <div class="input-group-addon">
                                                                                            <span
                                                                                                class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Status
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    <select name="status[]" id="status"
                                                                                        class="form-control rincian">
                                                                                        <?php
                                                                                        $refund = App\Refund::orderBy('no_refund', 'desc')
                                                                                            ->whereIn('status', ['unpaid', 'reject'])
                                                                                            ->get();
                                                                                        foreach ($refund as $key) {
                                                                                            $status = App\Refund::whereIn('id', $key)->get();
                                                                                        }
                                                                                        ?>
                                                                                        @foreach ($status as $item)
                                                                                            <option selected value="unpaid">
                                                                                                {{ $item->status }}
                                                                                            </option>
                                                                                        @endforeach
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
                                                                <button type="reset"
                                                                    class="btn btn-secondary">Batal</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Simpan</button>
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
    <script>
        var date = new Date();
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var todayDate = String(date.getDate()).padStart(2, '0');
        var datePattern = todayDate + '-' + month + '-' + year;
        document.getElementById("date-picker").value = datePattern;
    </script>
@stop
