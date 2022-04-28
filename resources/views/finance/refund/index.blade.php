@extends('layouts.master', ['title' => 'Refund'])
@section('content')

    @php

    use App\Marketing;
    use App\Spr;
    use App\Pembatalan;
    use App\Refund;

    $AWAL = 'RF';
    $noUrutAkhir = Refund::max('id');

    $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">FORM INPUT REFUND </h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_refund" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_refund" id="no_refund" value="{{ $nourut }}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="tanggal_transaksi" id="tanggal_transaksi"
                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="GET">
        <div class="form-group row d-flex justify-content-center mt-2">
            <label for="name" class="col-sm-2">Masukkan nomor pembatalan :</label>
            <div class="col-sm-2">
                <select name="no_pembatalan" id="no_pembatalan" class="form-control">
                    @if (!request()->get('no_pembatalan'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($batal as $item)
                        @if (request()->get('no_pembatalan') == $item->no_pembatalan)
                            <option value="{{ $item->no_pembatalan }}" selected>{{ $item->no_pembatalan }}</option>
                        @else
                            <option value="{{ $item->no_pembatalan }}">{{ $item->no_pembatalan }}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </form>

    @if (request()->get('no_pembatalan'))
        @if (request()->get('no_pembatalan') == $idbatal1)
            <h2 class="text-center mt-5">Anda sudah input refund ini</h2>
        @else
            <form action="{{ route('finance.refund.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8 container">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 200px">No Refund</th>
                                                <th style="width: 20px">:</th>
                                                <th> {{ $nourut }} <input type="hidden" name="no_refund"
                                                        value="{{ $nourut }}">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 200px">No Pembatalan</td>
                                                <td style="width: 20px">:</td>
                                                <td> {{ $singlebatal->no_pembatalan }} <input type="hidden"
                                                        name="no_pembatalan" value="{{ $singlebatal->no_pembatalan }}">
                                                    <input type="hidden" name="pembatalan_id"
                                                        value="{{ $singlebatal->id }}">
                                                </td>
                                            </tr>
                                            {{-- @foreach ($getSpr as $item) --}}
                                            <tr>
                                                <td style="width: 200px">Konsumen</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $singlebatal->spr->nama }}
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
                                            <tr>
                                                <td style="width: 200px">Sales</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $singlebatal->spr->user->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Spv</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->diajukan }} <input type="hidden" name="diajukan"
                                                        value="{{ $item->diajukan }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Tanggal</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ Carbon\Carbon::now()->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Total yang sudah dibayar</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    @currency($totalbayar) <input type="hidden" value="{{ $totalbayar }}"
                                                        name="nominal" id="nominal">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Potongan</td>
                                                <td style="width: 20px">:</td>
                                                <td class="d-flex">
                                                    <div style="width: 25%" class="input-group ">
                                                        <input type="text" class="form-control" name="potongan"
                                                            id="potongan" aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2"
                                                            aria-label="Dollar amount (with dot and two decimal places)"
                                                            maxlength="3"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" style="height: 99%"
                                                                id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                    &nbsp; &nbsp;
                                                    <div style="width: 50%" class="input-group ">
                                                        <div class="input-group-prepend" style="height: 99%">
                                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                                        </div>
                                                        <input type="text" class="form-control" aria-label="Username"
                                                            name="potongans" id="potongans" aria-describedby="basic-addon1"
                                                            aria-label="Dollar amount (with dot and two decimal places)"
                                                            maxlength="7"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Total refund</td>
                                                <td style="width: 20px">:</td>
                                                <td id="total" name="total">
                                                </td>

                                                <input type="text" name="total_refund" id="total_refund"
                                                    class="form-control" readonly hidden>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Status</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    unpaid
                                                    <input type="hidden" name="totals" id="totals" class="form-control" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Sumber pembayaran</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    <select name="sumber_pembayaran" id="" class="form-control">
                                                        <option value="">--Select sumber pembayaran--</option>
                                                        @foreach ($bank as $item)
                                                            @if ($item->deskripsi == 'Bank BCA')
                                                                <option value="{{ $item->id }}">
                                                                    BCA
                                                                </option>
                                                            @elseif ($item->deskripsi == 'Bank BRI')
                                                             <option value="{{ $item->id }}">
                                                                    BRI
                                                                </option>
                                                            @else
                                                            <option value="{{ $item->id }}">
                                                                    Mandiri
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                        {{-- <option value="bank mandiri">Bank Mandiri</option> --}}
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Ditransfer ke rekening</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    <textarea name="rekening" id="rekening" cols="30" rows="5"></textarea>
                                                </td>
                                            </tr>
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
        @endif
    @endif

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="libs/jquery.latest.js"></script>
    <script type="text/javascript" src="libs/jquery.maskMoney.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#potongan").keyup(function() {
                var nominal = parseFloat($("#nominal").val());
                console.log(nominal);
                var potongan = parseFloat($("#potongan").val());
                var angkapotongan = nominal * (potongan / 100);
                var total = nominal - angkapotongan;
                var angkatotal = rupiah(total);

                document.getElementById("total_refund").value = angkatotal;
                document.getElementById("total").innerHTML = angkatotal;
                document.getElementById("totals").value = total;
            });
        });

        $(document).ready(function() {
            $("#potongans").keyup(function() {
                var nominal = parseInt($("#nominal").val());
                console.log(nominal);
                var potongan = parseInt($("#potongans").val());
                // var angkapotongan = nominal * (potongan / 100);
                var total = nominal - potongan;
                var angkatotal = rupiah(total);

                document.getElementById("total_refund").value = angkatotal;
                document.getElementById("total").innerHTML = angkatotal;
            });
        });

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
    </script>
@stop
