@extends('layouts.master', ['title' => 'Appointment'])

@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Invoice</h4>
    </div>
    <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="{{ asset('/') }}img/skydental.png" class="inv-logo" alt="">
                        <ul class="list-unstyled">
                            <li>Sky dental</li>
                            <li>{{ $appointment->cabang->nama }}</li>
                            <li>{{ $appointment->cabang->alamat }}</li>
                            <li>GST No:</li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">{{ $appointment->no_booking }}</h3>
                            <ul class="list-unstyled">
                                <li>Date booking: <span>{{ $appointment->tanggal_status }}</span></li>
                                <li>No MR: <span>{no_mr}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-6 m-b-20">

                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong>{{ $appointment->pasien->nama }}</strong></h5>
                            </li>
                            <li><span>{{ $appointment->pasien->alamat }}</span></li>
                            <li>{{ $appointment->pasien->no_telp }}</li>
                            @php
                            $age = explode(",", $appointment->pasien->ttl)
                            @endphp
                            <li>{{ \Carbon\Carbon::parse($age[1])->diff(\Carbon\Carbon::now())->format('%y Tahun') }}</li>
                            <li>{{ $appointment->pasien->jk }}</li>
                            <li>{nik_ktp}</li>
                            <li><a href="#">{{ $appointment->pasien->email }}</a></li>
                        </ul>

                    </div>
                    <div class="col-sm-6 col-lg-6 m-b-20">
                        <div class="invoices-view">
                            <span class="text-muted">Payment Details:</span>
                            <ul class="list-unstyled invoice-payment-details">
                                <li>
                                    <h5>Total Due: <span class="text-right">@currency($appointment->tindakan->sum('nominal'))</span></h5>
                                </li>
                                <li>Perawat: <span>{{ $appointment->perawat->name }}</span></li>
                                <li>Office boy: <span>{{ $appointment->ob->name }}</span></li>
                                <li>Resepsionis: <span>{{ $appointment->resepsionis->name }}</span></li>
                                <li>Address: <span>{{ $appointment->cabang->alamat }}</span></li>
                                <li>IBAN: <span>KFH37784028476740</span></li>
                                <li>SWIFT code: <span>BPT4E</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ITEM</th>
                                <th>DESCRIPTION</th>
                                <th>UNIT COST</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($appointment->tindakan as $tindakan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tindakan->item->nama_barang }}</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                                @php
                                $harga = \App\HargaProdukCabang::where('barang_id', $tindakan->item->id)->where('cabang_id', auth()->user()->cabang_id)->first();
                                @endphp
                                <td>@currency($harga->harga)</td>
                                <td>{{ $tindakan->qty }}</td>
                                <td>@currency($harga->harga * $tindakan->qty)</td>
                                <td><span class="custom-badge status-{{ $tindakan->status == 0 ? 'red' : 'green' }}">{{ $tindakan->status == 0 ? 'belum' : 'lunas' }}</span></td>
                            </tr>
                            @php
                            $total += $harga->harga * $tindakan->qty
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="row invoice-payment">
                        <div class="col-sm-7">
                        </div>
                        <div class="col-sm-12">
                            <div class="m-b-20">
                                <h6>Total due</h6>
                                <div class="table-responsive no-border">
                                    <table border="1" class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td class="text-right">@currency($total)</td>
                                            </tr>
                                            @if($appointment->cabang->status_pajak == 1)
                                            <tr>
                                                <th>Pajak ({{ $appointment->cabang->ppn }}%):</th>
                                                <td class="text-right">
                                                    @php
                                                    $pajak = $total * $appointment->cabang->ppn / 100
                                                    @endphp
                                                    @currency($pajak)
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Dibayar:</th>
                                                <td class="text-right">@currency($appointment->rincian->sum('dibayar'))</td>
                                            </tr>
                                            <tr>
                                                <th>Sisa Pembayaran:</th>
                                                <td class="text-right text-primary sisa">
                                                    <h5>@currency($total - $appointment->rincian->sum('dibayar') + $pajak)</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-info">
                        <h5>Pembayaran</h5>
                        <p class="text-muted"></p>
                        <table width="519" border="0" class="table">
                            <tbody>
                                <tr>
                                    <td width="200">Metode Pembayaran</td>
                                    <td width="195">Nominal</td>
                                    <td width="195">Dibayar</td>
                                    <td width="195">Change</td>
                                    <td width="188">Waktu Pembayaran</td>
                                </tr>
                                <tr>
                                    <form action="{{ route('appointments.bayar') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $appointment->id }}" id="booking_id">
                                        <input type="hidden" name="nominal" value="{{ $total - $appointment->rincian->sum('dibayar') + $pajak }}" id="nml">
                                        <input type="hidden" name="bayar" value="" id="bayar">
                                        <input type="hidden" name="kembali" value="0" id="kembali">
                                        <td>
                                            <select name="payment" class="form-control" id="metode">
                                                <option selected disabled>-- Metode --</option>
                                                @foreach($payments as $payment)
                                                <option value="{{ $payment->id }}">{{ $payment->nama_metode }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" value="@rp($total - $appointment->rincian->sum('dibayar') + $pajak)" class="form-control" id="nominal"></td>
                                        <td><input type="text" value="0" class="form-control" id="dibayar"></td>
                                        <td><input type="text" value="0" class="form-control" id="change" readonly></td>
                                        <td><input type="datetime" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran" readonly></td>
                                        <td><button type="submit" class="btn btn-success">Input</button></td>
                                    </form>
                                </tr>
                                <tr>
                                    <td height="47" id="potongan"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="519" border="0" class="table table-voc">
                            <tbody>
                                <tr>
                                    <td width="200" height="47">Kode Voucher</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" id="voc" placeholder="Kode Voucher"></td>
                                    <td><button type="button" class="btn btn-success voc">Apply</button></td>
                                </tr>
                                <tr>
                                    <td id="voucher" colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>

                        <p></p>
                        <table width="520" border="0" class="table">
                            <tbody>
                                <tr>
                                    <td>No</td>
                                    <td>Metode </td>
                                    <td>Nominal</td>
                                    <td>Waktu </td>
                                    <td>Cashier</td>
                                    <td>Potongan</td>
                                    <td>Biaya Kartu</td>
                                    <td>Dibayar</td>
                                </tr>
                                @foreach($appointment->rincian as $rincian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rincian->payment->nama_metode }}</td>
                                    <td>@currency($rincian->nominal)</td>
                                    <td>{{ \Carbon\Carbon::parse($rincian->tanggal_pembayaran)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $rincian->kasir->name }}</td>
                                    <td>{{ $rincian->payment->potongan }}%</td>
                                    <td>@currency($rincian->biaya_kartu)</td>
                                    <td>@currency($rincian->dibayar)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        var dibayar = document.getElementById('dibayar');
        dibayar.addEventListener('keyup', function(e) {
            dibayar.value = formatRupiah(this.value, 'Rp. ');

            var nominal = parseInt($("#nominal").val().replace(/[^,\d]/g, ''));
            var bayar = parseInt(this.value.replace(/[^,\d]/g, ''))
            var change = bayar - nominal;
            $("#change").empty();

            if (bayar >= nominal) {
                $("#change").val(change)

                var kmb = document.getElementById('change');
                kmb.value = formatRupiah(kmb.value, "Rp. ")
            } else {
                $("#change").val(0);
                $("#kembali").val(0)
            }

            $("#bayar").val(bayar)
        });


        $(".voc").on('click', function() {
            let kode_voucher = $("#voc").val();
            // let date = $("#tanggal_pembayaran").val()
            let dibayar = $("#bayar").val()
            let kembali = $("#kembali").val()
            let nominal = $("#nml").val();
            let booking_id = $("#booking_id").val()

            let route = "{{ route('appointments.voucher') }}";
            let _token = $('meta[name="csrf-token"]').attr('content');

            $("#voucher").empty()

            $.ajax({
                url: route,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    kode_voucher: kode_voucher,
                    nominal: nominal,
                    kembali: kembali,
                    booking_id: booking_id,
                    dibayar: dibayar,
                    _token: _token
                },
                success: function(result) {
                    console.log(result)
                    if (result.status == 400) {
                        $("#voucher").append(`<span class="text-danger">*` + result.message + `</span>`)
                    } else {
                        if (result.status) {
                            iziToast.success({
                                title: 'Success',
                                position: 'topRight',
                                message: result.message,
                            });
                            $(".sisa").empty().append("Rp. " + result.nominal)
                            $("#nml").val(result.nml)
                            $("#nominal").val(result.nominal)
                            $(".table-voc").remove();
                        } else {
                            $("#voucher").append(`<span>` + result.message + `</span>`)
                        }
                    }
                }
            })
        })

        $("#metode").on('change', function() {
            var id = $(this).val();
            let route = "/admin/payments/" + id;


            $.ajax({
                method: 'GET',
                url: route,
                success: function(result) {
                    $("#potongan").empty();

                    if (result.payment.potongan == 0) {
                        $("#potongan").append("Tidak ada potongan");
                    } else {
                        $("#potongan").append("Potongan Sebesar : " + result.payment.potongan + "%")
                    }

                }
            })
        })

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }

    })
</script>
@stop