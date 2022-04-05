@extends('layouts.master', ['title' => 'Show Purchase'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Purchase</h4>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3 body-main">
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
                                <h6><strong>Fomulir:</strong></h6>
                                <input type="checkbox" />
                                <label style="font-size:.80em;">Material Delivered</label>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2><span class="purchase-order">Purchase Order</span></h2>
                            </div>
                        </div> <br />
                        <table class="table table-borderless">
                            <tr>
                                <td style="padding-right: 100px;">
                                    <table cellspacing="5" cellpadding="5">
        
                                        <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">
        
                                            <tr>
                                                <td>Supplier/ Vendor </td>
                                                <td>:</td>
                                                <td> {{ $purchase->supplier->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person </td>
                                                <td>:</td>
                                                <td>  {{ $purchase->admin->name }} -{{ $purchase->admin->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Location </td>
                                                <td>:</td>
                                                <td> {{ $purchase->supplier->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>Delevery On Site</td>
                                                <td>:</td>
                                                <td>{{ $purchase->project->nama_project }}</td>
                                                <td>{{ $purchase->lokasi }}</td>
                                            </tr>
                                            
        
        
                                        </tbody>
                                    </table>
                                </td>
                                <td style="padding-right: 150px;">
        
                                </td>
                                <td>
                                    <table cellspacing="5" cellpadding="5">
        
                                        <tbody style="font-size: 14px; 	font-family: 'Rubik', sans-serif;">
        
                                            <tr>
                                                <td>Date</td>
                                                <td>:</td>
                                                <td>  {{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                                {{-- <tr>
                                                    <td>Contact Penerima</td>
                                                    <td>:</td>
                                                    <td> {{ $purchase->admin->name }}</td>
                                                </tr> --}}
                                            <tr>
                                                <td>PO Number</td>
                                                <td>:</td>
                                                <td> {{ $purchase->invoice }}</td>
                                            </tr>
                                            <tr>
                                                <td>Project</td>
                                                <td>:</td>
                                                <td>   {{ $purchase->project->nama_project }}</td>
                                            </tr>
                                            <tr>
                                                <td>Project</td>
                                                <td>:</td>
                                                <td>   {{ $purchase->project->project_code }}</td>
                                            </tr>
        
                                        </tbody>
        
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th class="text-light">Acc.</th>
                                            <th class="text-light">No.</th>
                                            <th class="text-light">Description</th>
                                            <th class="text-light">Qty</th>
                                            <th class="text-light">Unit</th>
                                            <th class="text-light">Unit price</th>
                                            <th class="text-light">Total Price</th>
                                        </tr>
                                        <tbody>
                                            @php
                                            $total = 0
                                            @endphp
                                            @foreach(App\Purchase::where('invoice', $purchase->invoice)->get() as $barang)
                                            <tr style="font-size:12px;">
                                                <td class=" dynamic-hidden-col">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->barang->nama_barang }}</td>
                                               
                                                <td>{{ $inout->in }}</td>
                                            
                                                <td>{{ $barang->unit }}</td>
                                                <td>@currency($barang->harga_beli)</td>
                                                <td>@currency($barang->total)</td>

                                            </tr>
                                            @php
                                            $total += $barang->total
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="font-size:12px;">
                                                <td></td>
                                                <td colspan="4"></td>
                                                <td>SUB TOTAL </td>
                                                <td><b>@currency($total)</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td></td>
                                                <td colspan="4"></td>
                                                <td>PPN</td>
                                                <td><b>{{ $purchase->PPN}}%</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td></td>
                                                <td colspan="4"></td>
                                                <td><strong>TOTAL<strong> </td>
                                                <td><b>@currency($purchase->grand_total)</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td rowspan="20"></td>
                                                <td colspan="4" rowspan="20">
                                                    <p class="text-left">Note :</p>
                                                </td>
                                                <td>
                                                    <p style="margin-top:20px;" class="text-center">PURCHASING</p>
                                                </td>
                                                <td>
                                                    <p class="text-center">MANAGER <br> PROCUREMENT </p>
                                                </td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td rowspan="2">
                                                    <p style="margin-top: 40px;" class="text-center m-b-2">(............................)</p>
                                                </td>
                                                <td rowspan="2">
                                                    <p style="margin-top: 40px;" class="text-center m-b-2">(............................)</p>
                                                </td>
                                            </tr>
                                            <tr style="font-size:12px;">

                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td colspan="4">
                                                    <p class="text-center">DIRECTURE</p>
                                                </td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td colspan="4">
                                                    <p style="margin-top: 40px;" class="text-center m-b-2">(............................)</p>
                                                </td>
                                            </tr>
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
                error: function() {}
            })
        })
    })
</script>
@stop