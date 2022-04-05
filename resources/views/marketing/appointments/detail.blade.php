@extends('layouts.master', ['title' => 'Detail Appointment'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Invoice</h4>
    </div>
    <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white" onclick="printFunction()"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>
<form action="{{ route('marketing.appointments.store') }}" method="post">
    <input type="hidden" value="{{ $no_booking }}" name="no_booking">
    <input type="hidden" value="{{ $date_booking }}" name="date_booking">
    <input type="hidden" value="{{ $customer->id }}" name="customer_id">
    <input type="hidden" value="{{ $jadwal->tanggal }}" name="tanggal_status">
    <input type="hidden" value="{{ $jadwal->id }}" name="jadwal_id" id="jadwal_id">
    @csrf
    @method('post')
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
                                <h3 class="text-uppercase">{{ $no_booking }}</h3>
                                <ul class="list-unstyled">
                                    <li>Date booking: <span>{{$date_booking}}</span></li>
                                    <li>No MR: <span>{{ $customer->id }}</span></li>
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
                                <li>{{$customer->no_telp}}</li>
                                <li>{{$umur}} Tahun ({{ $customer->tgl_lahir }})</li>
                                <li>{{$customer->jk}}</li>
                                <li>{{$customer->nik_ktp}}</li>
                                <li><a href="#">{{$customer->email}}</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-lg-6 m-b-20">
                            <div class="invoices-view">
                                <span class="text-muted">Payment Details:</span>
                                <ul class="list-unstyled invoice-payment-details">
                                    <!-- <li>
                                        <h5>Total Due: <span class="text-right">$288.2</span></h5>
                                    </li> -->
                                    <li>Dokter: <span>{{ $dokter->name }}</span></li>
                                    <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">
                                    <li>Perawat: <span>{{ $booking->perawat->name  ?? '-' }}</span></li>
                                    <li>Office boy: <span>{{ $booking->ob->name  ?? '-' }}</span></li>
                                    <li>Resepsionis: <span>{{ $booking->resepsionis->name  ?? '-' }}</span></li>
                                    <li>Address: <span>{{ auth()->user()->cabang->alamat }}</span></li>
                                    <!-- <li>IBAN: <span>KFH37784028476740</span></li>
                                    <li>SWIFT code: <span>BPT4E</span></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add" class="btn btn-primary my-2">Tambah Row Baru</button>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover border" id="table-show">
                                    <tr class="bg-success">
                                        <th class="text-light">ITEM</th>
                                        <th class="text-light">PRICE</th>
                                        <th class="text-light">TIME</th>
                                        <th class="text-light">DURATION</th>
                                        <th class="text-light">TYPE</th>
                                        <th class="text-light">QUANTITY</th>
                                        <th class="text-light">TOTAL</th>
                                        <th class="text-light">DELETE</th>
                                    </tr>
                                    <tbody id="dynamic_field">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <p class="text-info">*Mohon Untuk Input Dengan Benar dan Berurut : <span class="badge badge-primary" id="counter"></span></p>
                    <div class="row invoice-payment">
                        <div class="col-sm-4 offset-sm-8">
                            <h6>Total due</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <input type="text" readonly name="waktu_mulai" id="waktu_mulai" value="{{ $waktu_mulai }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Waktu Selesai</label>
                                        <input type="text" id="waktu_selesai" readonly name="waktu_selesai" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" id="sub_total" readonly class="form-control">
                                    </div>
                                </div>
                                @if(auth()->user()->cabang->status_pajak)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>elTax <span class="text-regular" id="the_ppn">{{ auth()->user()->cabang->ppn }}%</span></label>
                                        <input type="text" id="tax" readonly class="form-control">
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>elTax <span class="text-regular" id="the_ppn">0%</span></label>
                                        <input type="text" id="tax" readonly class="form-control">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" readonly class="form-control" id="total_all">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 offset-sm-8">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
    </div>
</form>
@if(auth()->user()->cabang->status_pajak)
<input type="hidden" id="ppn" value="{{ auth()->user()->cabang->ppn }}">
@else
<input type="hidden" id="ppn" value="0">
@endif
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    var formatter = function(num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    document.getElementById('submit').disabled = true

    function form_dinamic() {
        let index = $('#dynamic_field tr').length + 1
        document.getElementById('counter').innerHTML = index
        let template = `
                <tr class="rowComponent">
                    <td hidden>
                        <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
                    </td>
                    <td>
                        <select required name="item[${index}]" onchange="GetResource(this)" id="${index}" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="text" name="price[${index}]"  class="form-control price-${index}" placeholder="0" readonly>
                    </td>
                    <td>
                        <input type="text" name="time[${index}]" class="form-control time-${index} waktu"  readonly>
                    </td>
                    <td>
                        <input type="text" name="duration[${index}]" class="form-control duration-${index}" readonly>
                    </td>
                    <td>
                        <input type="text" name="type[${index}]" class="form-control type-${index}" readonly>
                    </td>
                    <td>
                        <input type="number" name="quantity[${index}]" class="form-control quantity-${index}" data="${index}" placeholder="0" oninput="hitung(this) , HowAboutIt(this) , HowWith(this)">
                    </td>
                    <td>
                        <input type="text" name="total[${index}]" class="form-control total-${index} total-form"  placeholder="0" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="remove(this)">Delete</button>
                    </td>
                </tr>
        `
        $('#dynamic_field').append(template)

        $(`.select-${index}`).select2({
            placeholder: 'Select Product',
            ajax: {
                url: `/marketing/where/product`,
                processResults: function(data) {
                    console.log(data)
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $(document).ready(function() {
            $(`.select-${index}`).selectize({
                sortField: 'text'
            });
        });
    }

    function GetResource(q) {
        let id = q.value
        let attr = $(q).attr('id')
        $.ajax({
            url: `/marketing/resource/${id}`,
            success: function(resource) {
                console.log(resource)
                $(`.price-${attr}`).val(resource.harga)
                $(`.duration-${attr}`).val(resource.durasi)
                $(`.type-${attr}`).val(resource.jenis)
                $(`.barang_id-${attr}`).val(resource.barang_id)
            }
        })
    }

    function remove(q) {
        $(q).parent().parent().remove()
    }
    $('.remove').on('click', function() {
        $(this).parent().parent().remove()
    })

    function hitung(e) {
        let quantity = e.value
        let attr = $(e).attr('data')
        let harga = $(`.price-${attr}`)
        let durasi = $(`.duration-${attr}`)
        let total = $(`.total-${attr}`)
        let waktu = $(`.time-${attr}`)
        total.val(quantity * harga.val())
        waktu.val(quantity * durasi.val())
    }
    $(document).ready(function() {
        $('#add').on('click', function() {
            form_dinamic()
        })
    })

    function rupiah() {
        document.getElementById('total_all').value = formatter(document.getElementById('total_all').value)
        document.getElementById('sub_total').value = formatter(document.getElementById('sub_total').value)
        document.getElementById('tax').value = formatter(document.getElementById('tax').value)
    }

    function HowAboutIt(e) {
        let sub_total = document.getElementById('sub_total')
        let tax = document.getElementById('tax')
        let total_all = document.getElementById('total_all')
        let total = 0;
        let coll = document.querySelectorAll('.total-form')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }

        let ppn = document.getElementById('ppn').value
        sub_total.value = total
        tax.value = (ppn / 100) * sub_total.value
        total_all.value = parseInt(tax.value) + parseInt(sub_total.value)
        rupiah()
    }

    function TimeCarbon(jadwal_id, time, waktu_mulai) {
        return fetch(`/marketing/time/${jadwal_id}/${time}/${waktu_mulai}`)
            .then(function(data) {
                return data.json()
            })
    }
    async function HowWith(e) {
        let attr = $(e).attr('data')
        let total_all = document.getElementById('total_all')
        let waktu = 0;
        let submit = document.getElementById('submit')
        let coll = document.querySelectorAll('.waktu')
        let waktu_mulai = document.getElementById('waktu_mulai').value
        let jadwal_id = document.getElementById('jadwal_id');
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            waktu += parseInt(ele.value)
        }
        let res = document.getElementById('waktu_selesai')
        let jadwal = await TimeCarbon(jadwal_id.value, waktu, waktu_mulai)
        res.value = jadwal
        if (jadwal == 'Waktu Melebihi Waktu Shift' || total_all.value == 0) {
            submit.disabled = true
        } else {
            submit.disabled = false
        }
    }
</script>
@stop