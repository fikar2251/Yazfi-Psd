@extends('layouts.master', ['title' => 'Detail Appointment'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Invoice</h4>
    </div>
    <!-- <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white" onclick="printFunction()"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div> -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="{{ asset('/storage/' . \App\Setting::find(1)->logo) }}" class="inv-logo" alt="">
                        <ul class="list-unstyled">
                            <li>{{ \App\Setting::find(1)->web_name }}</li>
                            <li>{{$customer->cabang->nama}}</li>
                            <li>{{$customer->cabang->alamat}}</li>
                            <li>GST No:</li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">{{ $booking->no_booking }}</h3>
                            <ul class="list-unstyled">
                                <li>Date booking: <span>{{$customer->date_booking}}</span></li>
                                <li>No Rekam Medik: <span>{{ $customer->rekam_medik }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-6 m-b-20">

                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong>{{$customer->nama}}</strong></h5>
                            </li>
                            <li><span>{{$customer->alamat}}</span></li>
                            <li> {{ (int)Carbon\Carbon::now()->format('Y') - (int)Carbon\Carbon::parse($customer->tgl_lahir)->format('Y') }} Tahun</li>
                            <li>{{$customer->jk}}</li>
                            <li>{{$customer->nik_ktp}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-6 m-b-20">
                        <div class="invoices-view">
                            <span class="text-muted">Payment Details:</span>
                            <ul class="list-unstyled invoice-payment-details">
                                <li>
                                    @php
                                    $pajak = $booking->tindakan->sum('nominal') * $booking->cabang->ppn / 100
                                    @endphp
                                    <h5>Total Due: <span class="text-right">Rp. {{ number_format($booking->tindakan->sum('nominal') + $pajak) }}</span></h5>
                                </li>
                                <li>Dokter: <span>{{ $booking->dokter->name }}</span></li>
                                <input type="hidden" name="dokter_id" value="{{ $customer->id }}">
                                <li>Perawat: <span>{{ $booking->perawat->name  ?? '-' }}</span></li>
                                <li>Office boy: <span>{{ $booking->ob->name ?? '-' }}</span></li>
                                <li>Resepsionis: <span>{{ $booking->resepsionis->name ?? '-' }}</span></li>
                                <li>Address: <span>{{ auth()->user()->cabang->alamat }}</span></li>
                                <li>IBAN: <span>KFH37784028476740</span></li>
                                <li>SWIFT code: <span>BPT4E</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <h3><span class="badge badge-primary" id="status">{{ $booking->kedatangan->status }}</span></h3> -->
                <input type="hidden" id="id_booking" value="{{$booking->id}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table custom-table table-hover border" id="table-show">
                                <tr class="bg-success">
                                    <th class="text-light">No</th>
                                    <th class="text-light">Item</th>
                                    <th class="text-light">Harga</th>
                                    <th class="text-light">Qty</th>
                                    <th class="text-light">Total</th>
                                    <th class="text-light">Dokter</th>
                                    <th class="text-light">Updated At</th>
                                    <th class="text-light">Status</th>
                                </tr>
                                @foreach($booking->tindakan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->item->nama_barang }}</td>
                                    <td>Rp. {{ number_format($data->item->produkharga->where('cabang_id',auth()->user()->cabang_id)->first()->harga) }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>Rp. {{ number_format($data->nominal) }}</td>
                                    <td>{{ $data->dokter->name }}</td>
                                    <td>{{ $data->updated_at }}</td>
                                    <td><input type="checkbox" name="" @if($data->status) @if($data->dokter_id != auth()->user()->id) disabled @endif @endif onchange="update(this)" @if($data->status) checked @endif id="{{ $data->id }}"></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <!-- <div class="invoice-info">
                    <h5>Other information</h5>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero, eu finibus sapien interdum vel</p>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    function update(qr) {
        let id_booking = $('#id_booking').val()
        let check = $(qr).attr("checked", !$(qr).attr("checked"));
        if (check.attr('checked') == 'checked') {
            $.ajax({
                url: `/dokter/ajax/update/${$(qr).attr('id')}/1/${id_booking}`,
                success: function(data) {
                    $(qr).parent().parent().children()[5].innerHTML = data.dokter
                    $(qr).parent().parent().children()[6].innerHTML = data.updated_at
                    $('#status').html(data.status)
                    console.log(data)
                }
            })
        } else {
            $.ajax({
                url: `/dokter/ajax/update/${$(qr).attr('id')}/0/${id_booking}`,
                success: function(data) {
                    $(qr).parent().parent().children()[5].innerHTML = data.dokter
                    $(qr).parent().parent().children()[6].innerHTML = data.updated_at
                    $('#status').html(data.status)
                    console.log(data)

                }

            })
        }
    }
</script>

@stop