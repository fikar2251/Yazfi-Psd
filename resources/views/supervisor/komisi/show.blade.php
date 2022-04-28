@extends('layouts.master', ['title' => 'Input Komisi'])

@section('content')

    @php

    use App\Marketing;
    use App\Spr;
    use App\Pembatalan;
    use App\Komisi;

    $AWAL = 'KM';
    $noUrutAkhir = Komisi::max('id');

    $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">FORM INPUT KOMISI </h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_komisi" id="tanggal" value="{{ $nourut }}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="tanggal_komisi" id="tanggal_komisi" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET">
        <div class="form-group row d-flex justify-content-center mt-2">
            <label for="name" class="col-sm-2">Masukkan nomor SPR :</label>
            <div class="col-sm-2">
                <select name="no_transaksi" id="spr" class="form-control">
                    @if (!request()->get('no_transaksi'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($spr as $item)
                        @if (request()->get('no_transaksi') == $item->no_transaksi)
                            <option value="{{ $item->no_transaksi }}" selected>{{ $item->no_transaksi }}</option>
                        @else
                            <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</option>
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

    @if (request()->get('no_transaksi'))
        @if (request()->get('no_transaksi') == $sprno)
            <h2 class="text-center mt-5"> Anda sudah input SPR ini</h2>
        @else
            <form action="{{ route('supervisor.komisi.storekomisi') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 container">
                        <div class="card shadow">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered custom-table table-striped">
                                        <thead>

                                            <tr>
                                                <th style="width: 200px">NO</th>
                                                <th style="width: 20px">:</th>
                                                <th> {{ $nourut }} <input type="hidden" name="no_komisi"
                                                    value="{{ $nourut }}">
                                                    <input type="hidden" name="no_transaksi"
                                                    value="{{ request()->get('no_transaksi') }}">
                                                </th>

                                                <td>Harga Jual</td>
                                                <td>:</td>
                                                <td> @currency($hj)
                                                    <input type="hidden" value="{{ $hj }}"
                                                    name="harga_jual" id="harga_jual">
                                                </td>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td style="width: 200px">Tanggal</td>
                                                <td style="width: 20px">:</td>
                                                <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>

                                                <td>PPH</td>
                                                <td>:</td>
                                                <td class="d-flex"> <input type="number" name="persenpph"
                                                        id="persenpph" class="form-control" style="width: 80px"
                                                        value="2.5" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="pph" id="pph"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($potongan['pph'])" style="text-decoration: none"
                                                        readonly>
                                                </td>
                                            </tr>

                                            {{-- @foreach ($getSpr as $item) --}}
                                            <tr>
                                                <td style="width: 200px">Project</td>
                                                <td style="width: 20px">:</td>
                                                <td>
                                                    {{ $item->project->nama_project }}
                                                </td>

                                                <td>BPHTB</td>
                                                <td>:</td>
                                                <td class="d-flex"> <input type="number" name="persenbphtb"
                                                        id="persenbphtb" class="form-control" style="width: 80px"
                                                        value="2.5" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="bphtb" id="bphtb"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($potongan['bphtb'])" style="text-decoration: none"
                                                        readonly> 
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
                                            <tr>
                                                <td style="width: 200px">Sales ({{ $item->user->name }}) <input
                                                        type="hidden" name="nama_sales" value="{{ $item->user->name }}">
                                                </td>
                                                <td style="width: 20px">:</td>
                                                <td class="d-flex">
                                                    <input type="number" name="persensales" id="persensales"
                                                        class="form-control" style="width: 80px" value="0.1" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="sales" id="sales"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($komisi['sales'])" style="text-decoration: none"
                                                        readonly>
                                                    <input type="hidden" id="nominal_sales" name="nominal_sales"
                                                        value="{{ $komisi['sales'] }}">
                                                </td>

                                                <td>Pengurangan lain-lain</td>
                                                <td>:</td>
                                                <td class="d-flex"> <input type="number" name="persenpll"
                                                        id="persenpll" class="form-control" style="width: 80px"
                                                        value="2.5" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="pll" id="pll"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($potongan['pll'])" style="text-decoration: none"
                                                        readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 200px">SPV ({{ auth()->user()->name }})</td> <input
                                                    type="hidden" name="nama_spv" value="{{ auth()->user()->name }}">
                                                <td style="width: 20px">:</td>
                                                <td class="d-flex">
                                                    <input type="number" name="persenspv" id="persenspv"
                                                        class="form-control" style="width: 80px" value="0.1" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="spv" id="spv"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($komisi['spv'])" style="text-decoration: none"
                                                        readonly>
                                                    <input type="hidden" id="nominal_spv" name="nominal_spv"
                                                        value="{{ $komisi['spv'] }}">
                                                </td>

                                                <td>Total potongan</td>
                                                <td>:</td>
                                                <td id="totalpotongan">@currency($totalfee)</td>

                                            </tr>
                                            <tr>
                                                <td style="width: 200px">Manager ({{$manager->manager->name}})</td> <input type="hidden"
                                                    name="nama_manager" value="Yanto">
                                                <td style="width: 20px">:</td>
                                                <td class="d-flex">
                                                    <input type="number" name="persenmanager" id="persenmanager"
                                                        class="form-control" style="width: 80px" value="0.1" step="any">&nbsp;
                                                    <h3> % </h3> <input type="text" name="manager" id="manager"
                                                        class="form-control" style="width: 145px"
                                                        value="@currency($komisi['manager'])" style="text-decoration: none"
                                                        readonly>
                                                    <input type="hidden" id="nominal_manager" name="nominal_manager"
                                                        value="{{ $komisi['manager'] }}">
                                                </td>

                                                <td>Dasar perhitungan</td>
                                                <td>:</td>
                                                <td id="dasar">@currency($dasar)</td>
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


    <script type="text/javascript">
        $(document).ready(function() {
            $("#persenpph").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);
                var pph = rupiah(potonganpph);

                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;
                var dasar = rupiah(dasarperhitungan);

                var persensales = parseFloat($("#persensales").val());
                var potongansales = dasarperhitungan * (persensales / 100);
                var sales = rupiah(potongansales);

                var persenspv = parseFloat($("#persenspv").val());
                var potonganspv = dasarperhitungan * (persenspv / 100);
                var spv = rupiah(potonganspv);

                var persenmanager = parseFloat($("#persenmanager").val());
                var potonganmanager = dasarperhitungan * (persenmanager / 100);
                var manager = rupiah(potonganmanager);

                document.getElementById("pph").value = pph;
                document.getElementById("totalpotongan").innerHTML = totalpotongan;
                document.getElementById("dasar").innerHTML = dasar;

                document.getElementById("sales").value = sales;
                document.getElementById("spv").value = spv;
                document.getElementById("manager").value = manager;

            });
        });

        $(document).ready(function() {
            $("#persenbphtb").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);
                var bphtb = rupiah(potonganbphtb);

                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;
                var dasar = rupiah(dasarperhitungan);

                var persensales = parseFloat($("#persensales").val());
                var potongansales = dasarperhitungan * (persensales / 100);
                var sales = rupiah(potongansales);

                var persenspv = parseFloat($("#persenspv").val());
                var potonganspv = dasarperhitungan * (persenspv / 100);
                var spv = rupiah(potonganspv);

                var persenmanager = parseFloat($("#persenmanager").val());
                var potonganmanager = dasarperhitungan * (persenmanager / 100);
                var manager = rupiah(potonganmanager);

                document.getElementById("bphtb").value = bphtb;
                document.getElementById("totalpotongan").innerHTML = totalpotongan;
                document.getElementById("dasar").innerHTML = dasar;

                document.getElementById("sales").value = sales;
                document.getElementById("spv").value = spv;
                document.getElementById("manager").value = manager;

            });
        });



        $(document).ready(function(pph) {
            $("#persenpll").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);
                var pll = rupiah(potonganpll);

                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;
                var dasar = rupiah(dasarperhitungan);

                var persensales = parseFloat($("#persensales").val());
                var potongansales = dasarperhitungan * (persensales / 100);
                var sales = rupiah(potongansales);

                var persenspv = parseFloat($("#persenspv").val());
                var potonganspv = dasarperhitungan * (persenspv / 100);
                var spv = rupiah(potonganspv);

                var persenmanager = parseFloat($("#persenmanager").val());
                var potonganmanager = dasarperhitungan * (persenmanager / 100);
                var manager = rupiah(potonganmanager);

                document.getElementById("pll").value = pll;
                document.getElementById("totalpotongan").innerHTML = totalpotongan;
                document.getElementById("dasar").innerHTML = dasar;

                document.getElementById("sales").value = sales;
                document.getElementById("spv").value = spv;
                document.getElementById("manager").value = manager;
            });
        });

        $(document).ready(function() {
            $("#persensales").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);
                var pph = rupiah(potonganpll);

                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;

                var persensales = parseFloat($("#persensales").val());
                var potongansales = dasarperhitungan * (persensales / 100);
                var sales = rupiah(potongansales);

                document.getElementById("sales").value = sales;
                document.getElementById("nominal_sales").value = potongansales;
            });
        });

        $(document).ready(function() {
            $("#persenspv").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);
                var pph = rupiah(potonganpll);

                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;

                var persenspv = parseFloat($("#persenspv").val());
                var potonganspv = dasarperhitungan * (persenspv / 100);
                var spv = rupiah(potonganspv);

                document.getElementById("spv").value = spv;
                document.getElementById("nominal_spv").value = potonganspv;
            });
        });

        $(document).ready(function() {
            $("#persenmanager").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpll").val());
                var potonganpll = harga_jual * (persenpph / 100);
                var pph = rupiah(potonganpll);

                var persenpph = parseFloat($("#persenbphtb").val());
                var potonganbphtb = harga_jual * (persenpph / 100);

                var persenpph = parseFloat($("#persenpph").val());
                var potonganpph = harga_jual * (persenpph / 100);

                var total = potonganpll + potonganbphtb + potonganpph;
                var totalpotongan = rupiah(total);
                var dasarperhitungan = harga_jual - total;

                var persenmanager = parseFloat($("#persenmanager").val());
                var potonganmanager = dasarperhitungan * (persenmanager / 100);
                var manager = rupiah(potonganmanager);

                document.getElementById("manager").value = manager;
                document.getElementById("nominal_manager").value = potonganmanager;
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
