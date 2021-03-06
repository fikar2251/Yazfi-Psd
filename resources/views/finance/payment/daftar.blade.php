@extends('layouts.master', ['title' => 'Daftar Pembayaran'])

@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Daftar Pembayaran</h4>
        </div>
    </div>

    {{-- <form action="{{ route('finance.payment.status', $item->id) }}" method="POST"> --}}
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered custom-table table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 5%">No</th>
                                    <th style="width: 10%">No Transaksi</th>
                                    <th style="width: 16%">Tanggal pembayaran</th>
                                    <th style="width: 15%">Tipe</th>
                                    <th style="width: 13%">Nominal</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 12%">Bank tujuan</th>
                                    <th style="width: 10%">Action</th>
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
                                            @foreach ($item->bayartagihan as $by)
                                                {{ $by->rincian->keterangan }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @currency($item->nominal) <input type="hidden" name="nominal" id="nominal"
                                                value="{{ $item->nominal }}">

                                        </td>
                                        <td>
                                            @if ($item->status_approval == 'pending')
                                                <span class="custom-badge status-red">{{ $item->status_approval }}</span>
                                            @elseif ($item->status_approval == 'paid')
                                                <span
                                                    class="custom-badge status-green">{{ $item->status_approval }}</span>
                                            @elseif ($item->status_approval == 'reject')
                                                <span
                                                    class="custom-badge status-orange">{{ $item->status_approval }}</span>
                                            @endif

                                        </td>
                                        <td style="width: 110px" class="text-center">
                                            @if ($item->bank_tujuan == 'Bank BRI')
                                                BRI
                                            @elseif ($item->bank_tujuan == 'Bank BCA')
                                                BCA
                                            @else
                                                Mandiri
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('finance.payment.status', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <!-- Button trigger modal -->
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal1{{ $item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal1{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">
                                                                    @foreach ($item->bayartagihan as $by)
                                                                        {{ $by->rincian->keterangan }} <br>
                                                                    @endforeach
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-bordered custom-table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <td style="width: 200px">Tanggal
                                                                                    Pembayaran
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->tanggal_pembayaran }}

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">NO SPR</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->no_detail_transaksi }}
                                                                                    <input type="hidden" name="no_transaksi"
                                                                                        value="{{ $item->no_detail_transaksi }}">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Total
                                                                                    Pembayaran
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    @currency( $item->nominal )
                                                                                    <input type="hidden" name="nominal"
                                                                                        value="{{ $item->nominal }}">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Sales</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->rincian->spr->user->name }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Customer</td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{ $item->rincian->spr->nama }}
                                                                                </td>
                                                                            </tr>

                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 200px">Tujuan
                                                                                    Pembayaran
                                                                                    @php
                                                                                        
                                                                                        $status = App\Pembayaran::where('id', $item->id)->first();
                                                                                    @endphp
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    {{-- <select name="tujuan" id="tujuan"
                                                                                        class="form-control">
                                                                                        <option value="0">
                                                                                            {{ $item->bank_tujuan }}
                                                                                        </option>
                                                                                        @foreach ($account as $item)
                                                                                            @if ($item->nama_bank != '')
                                                                                                <option
                                                                                                    value="{{ $item->id_chart_of_account }}">
                                                                                                    {{ $item->nama_bank }}
                                                                                                </option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select> --}}
                                                                                    <select name="tujuan" id="tujuan"
                                                                                        class="form-control">
                                                                                        @foreach ($bank as $bk)
                                                                                            @if ($bk->deskripsi == $item->bank_tujuan)
                                                                                                @if ($item->bank_tujuan == 'Bank BCA')
                                                                                                    <option
                                                                                                       selected value="{{ $bk->id }}">
                                                                                                        BCA
                                                                                                    </option>
                                                                                                    @elseif ($item->bank_tujuan == 'Bank BRI')
                                                                                                    <option
                                                                                                       selected value="{{ $bk->id }}">
                                                                                                        BRI
                                                                                                    </option>
                                                                                                @else
                                                                                                    <option
                                                                                                      selected  value="{{ $bk->id }}">
                                                                                                        Mandiri
                                                                                                    </option>
                                                                                                @endif
                                                                                            @else
                                                                                                @if ($bk->deskripsi == 'Bank BCA')
                                                                                                    <option
                                                                                                        value="{{ $bk->id }}">
                                                                                                        BCA
                                                                                                    </option>
                                                                                                    @elseif ($bk->deskripsi == 'Bank BRI')
                                                                                                    <option
                                                                                                        value="{{ $bk->id }}">
                                                                                                        BRI
                                                                                                    </option>
                                                                                                @else
                                                                                                    <option
                                                                                                        value="{{ $bk->id }}">
                                                                                                        Mandiri
                                                                                                    </option>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px">Status
                                                                                </td>
                                                                                <td style="width: 20px">:</td>
                                                                                <td>
                                                                                    <select name="status" id="status"
                                                                                        class="form-control rincian">


                                                                                        <option
                                                                                            value="{{ $status->id }}">
                                                                                            {{ $status->status_approval }}
                                                                                        </option>
                                                                                        <option value="paid">paid
                                                                                        </option>
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
                                                                {{-- <a href="{{ route('finance.payment.status', $item->id) }}"
                                                                    class="btn btn-primary">
                                                                    Simpan
                                                                </a> --}}
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
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
        </div>
    </div>
    {{-- <div class="m-t-20 text-center">
        <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
            Save</button>
    </div> --}}
    {{-- </form> --}}
    <script>
        $(document).ready(function() {
            $("#exampleModal").on("hidden.bs.modal", function(e) {
                // $(this).removeData();
                $(this).find('form').trigger('reset');
            });
        });
    </script>
@stop
@section('foorter')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {


            $("#exampleModal1").on("hidden.bs.modal", function() {
                //reset values here. eg
                // $(document).find("#tujuan").val('0')

                // $('#tujuan').prop('selectedIndex', 0);
                $(this).find('select')[0].reset();
                //or
                // $("#tujuan").val('0');
            })

        });
    </script>

@endsection
