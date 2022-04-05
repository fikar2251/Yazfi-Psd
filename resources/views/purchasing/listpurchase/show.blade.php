@extends('layouts.master', ['title' => 'Show Purchase'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Purchase</h4>
    </div>
    {{-- <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm ">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div> --}}
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-10 body-main">
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
                        {{-- <div class="payment-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p style="font-size: 12px">Supplier/ Vendor :
                                        <a style="font-size: 12px">
                                            {{ $purchase->supplier->nama }}
                                        </a>
                                    </p style="font-size: 12px">
                                    <p style="font-size: 12px">Contact Person:
                                        <a style="font-size: 12px">
                                            {{ $purchase->admin->name }} -{{ $purchase->admin->phone_number }}
                                        </a>
                                    </p>
                                    <p style="font-size: 12px">Location :
                                        <a style="font-size: 12px">
                                            {{ $purchase->supplier->nama }}
                                        </a>
                                    </p>
                                    <p style="font-size: 12px">Delevery On Site :
                                        <a style="font-size: 12px">
                                            {{ $purchase->project->nama_project }}
                                            <p style="text-indent: 100px; margin-top:-10px;  font-size:12px;">{{ $purchase->lokasi }}</p>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-6 tex-right">
                                    <div class="form-group">
                                        <p style="font-size: 12px">Date :
                                            <a style="font-size: 12px">
                                                {{ Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y') }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Contact Penerimaan:
                                            <a style="font-size: 12px">
                                                {{ $purchase->admin->name }}-{{ $purchase->admin->phone_number }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">PO Number :
                                            <a style="font-size: 12px">
                                                {{ $purchase->invoice }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Project :
                                            <a style="font-size: 12px">
                                                {{ $purchase->project->nama_project }}
                                            </a>
                                        </p>
                                        <p style="font-size: 12px">Project Code :
                                            <a style="font-size: 12px">
                                                {{ $purchase->project->project_code }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  report">
                                        <tr style="font-size:12px;" class="bg-success">
                                           
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
                                                
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->barang->nama_barang }}</td>
                                               
                                                <td>{{ $barang->qty }}</td>
                                            
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
                                                <td colspan="3"></td>
                                                <td>SUB TOTAL </td>
                                                <td><b>@currency($total)</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td></td>
                                                <td colspan="3"></td>
                                                <td>PPN</td>
                                                <td><b>{{ $purchase->PPN}}%</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td></td>
                                                <td colspan="3"></td>
                                                <td><strong>TOTAL<strong> </td>
                                                <td><b>@currency($purchase->grand_total)</b></td>
                                            </tr>
                                            {{-- <tr style="font-size:12px;">
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
                                            </tr> --}}
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
@stop