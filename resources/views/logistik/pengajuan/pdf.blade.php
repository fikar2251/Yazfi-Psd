@extends('layouts.master', ['title' => 'PDF Pengajuan Dana'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3 body-main">
            <div class="col-md-12">
                <div class="card shadow" id="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-logo">
                                    <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                </div>
                            </div>
                            <div class="col-md-8 text-right">
                                <h6><span style="font-size: 15px; color:white; background-color:blue;">{{$pengajuan->nomor_pengajuan}}</span></h6>
                            </div>
                        </div><br>
                        <div class="payment-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p style="font-size: 12px">Nama :
                                        <a>
                                            {{ $pengajuan->admin->name }}
                                        </a>
                                    </p style="font-size: 12px">
                                    <p style="font-size: 12px">Jabatan :
                                        <a style="font-size: 12px">
                                            {{ $jabatan->nama }}
                                        </a>
                                    </p>
                                    <p style="font-size: 12px">Divisi :
                                        <a style="font-size: 12px">
                                            {{ $pengajuan->roles->name }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-6 tex-right">
                                    <div class="form-group">
                                        <p style="font-size: 12px">Tanggal : <a style="font-size: 12px">{{ Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y H:i:s') }}
                                            </a></p>
                                    </div>
                                    <div class="form-group">
                                        <p style="font-size: 12px">Lampiran : <a style="font-size: 12px">{{$pengajuan->nomor_pengajuan}}/{{ $pengajuan->file }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr class="bg-success">
                                            <th class="text-light">No.</th>
                                            <th class="text-light">Deskripsi</th>
                                            <th class="text-light">Harga Satuan</th>
                                            <th class="text-light">Kwitansi</th>
                                            <th class="text-light">Jumlah</th>
                                            <th class="text-light">Keterangan</th>
                                        </tr>
                                        <tbody>
                                            @php
                                            $total = 0
                                            @endphp
                                            @foreach(App\Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->first() as $barang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->barang->nama_barang }}</td>
                                                <td>{{ $barang->rincianpengajuan->qty }}</td>
                                                <td>@currency($barang->rincianpengajuan->harga_beli)</td>
                                                <td>@currency($barang->rincianpengajuan->grandtotal)</td>
                                                <td>{{$barang->rincianpengajuan->keterangan}}</td>
                                            </tr>
                                            @php
                                            $total += $barang->total
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"><strong>Total<strong> </td>
                                                <td></td>
                                                <td><b>@currency($total + $barang->rincianpengajuan->grandtotal)</b></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" rowspan="1">Cat :</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p class="text-center">Diajukan Oleh,</p>
                                                </td>
                                                <td colspan="2">
                                                    <p class="text-center">DiPeriksa,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-left">Manager</p>
                                                    <p class="text-right" style="margin-top: -37px;">Keuangan</p>
                                                </td>
                                                <td colspan="1">
                                                    <p class="text-center">DiSetujui,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-center">Direktur</p>
                                                </td>
                                                <td colspan="1">
                                                    <p class="text-center">DiKetahui,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-center">Komisaris</p>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                            <td colspan="6" rowspan="2">Cat :</td>
                                        </tr> -->

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </html>
    <script>
        function myFunction() {
            document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
        }
        $('.report').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn-default',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-default',
                    title: 'Laporan Pembelian ',
                    messageTop: 'Tanggal  {{ request("from") }} - {{ request("to") }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    title: 'Laporan Pembelian ',
                    messageTop: 'Tanggal {{ request("from") }} - {{ request("to") }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ]
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        var formatter = function(num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 13,
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


        // document.getElementById('submit').disabled = true

        function form_dinamic() {
            let index = $('#dynamic_field tr').length + 1
            document.getElementById('counter').innerHTML = index
            let template = `
        <tr class="rowComponent">
                    <td hidden>
                        <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
                    </td>
                    <td>
                        <select required name="barang_id[${index}]" id="${index}" class="form-control select-${index}"></select>
                    </td>
                    <td>
                        <input type="number" name="qty[${index}]"  class="form-control qty-${index}" placeholder="0">
                    </td>
                    <td>
                        <input type="number" name="harga_beli[${index}]" class="form-control harga_beli-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this), HowAboutIt(this)">
                    </td>
                    <td>
                        <input type="number" name="total[${index}]" disabled class="form-control total-${index} total-form"  placeholder="0">
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
                    url: `/admin/where/product`,
                    processResults: function(data) {
                        console.log(data)
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });


        }

        function remove(q) {
            $(q).parent().parent().remove()
        }
        $('.remove').on('click', function() {
            $(this).parent().parent().remove()
        })

        function hitung(e) {
            let harga = e.value
            let attr = $(e).attr('data')
            let qty = $(`.qty-${attr}`).val()
            let total = parseInt(harga * qty)

            $(`.total-${attr}`).val(total)

        }

        function HowAboutIt(e) {
            let sub_total = document.getElementById('sub_total')
            let total = 0;

            let coll = document.querySelectorAll('.total-form')
            for (let i = 0; i < coll.length; i++) {
                let ele = coll[i]
                total += parseInt(ele.value)
            }

            sub_total.value = total
            let tax = (10 / 100) * sub_total.value;
            let total_all = parseInt(tax);
            // rupiah()
            document.getElementById('PPN').value = total_all;


        }


        $(document).ready(function() {
            $('#add').on('click', function() {
                form_dinamic()
            })
        })

        $(document).ready(function() {
            $('.dynamic').change(function() {

                var id = $(this).val();
                var div = $(this).parent();
                var op = " ";
                $.ajax({
                    url: `/logistik/where/project`,
                    method: "get",
                    data: {
                        'id': id


                    },

                    success: function(data) {
                        console.log(data);
                        op += '<option value="0" selected disabled> Lokasi</option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].alamat_project + '">' + data[i].alamat_project + '</option>'
                        };
                        $('.root3').html(op);
                    },
                    error: function() {

                    }
                })
            })
        })
    </script>
    @stop