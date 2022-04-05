@extends('layouts.master', ['title' => 'Show Purchase'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Penerimaan Barang</h4>
    </div>
   
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3 body-main">
            <div class="col-md-12">
                <div class="card shadow" id="card">
                    <div class="card-body">
                        {{-- <div class="row">
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
                                <h2><span class="purchase-order">Penerimaan Order</span></h2>
                            </div>
                        </div> <br /> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped custom-table report">
                                        <tr style="font-size:12px;" class="bg-success">
                                            <th class="text-light">No.</th>
                                            <th class="text-light">Nomor PN</th>
                                            <th class="text-light">Nomor PO</th>
                                            <th class="text-light">Nama Barang</th>
                                            <th class="text-light">Unit</th>
                                            <th class="text-light">Warehouse</th>
                                            <th class="text-light">Status Barang</th>
                                            <th class="text-light">Qty</th>
                                            <th class="text-light">Qty Received</th>
                                            <th class="text-light">Harga Beli</th>
                                        </tr>
                                        <tbody>
                                            @php
                                            $total = 0
                                            @endphp
                                            @foreach(App\PenerimaanBarang::where('no_penerimaan_barang', $penerimaan->no_penerimaan_barang)->get() as
                                            $barang)
                                            <tr style="font-size:12px;">
                                               
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->no_penerimaan_barang }}</td>
                                                <td>{{ $barang->no_po }}</td>
                                                <td>{{ $barang->barang->nama_barang }}</td>
                                                <td>{{ $barang->purchase->unit }}</td>
                                                <td>{{ $barang->purchase->warehouse->nama_warehouse }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center mt-2">
                                                        @if($barang->qty != $barang->qty_received)
                                                        <span class="custom-badge status-orange">partial</span>
                                                        @endif
                                                        @if($barang->qty == $barang->qty_received)
                                                        <span class="custom-badge status-green">completed</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $barang->qty }}</td>
                                                <td>{{ $barang->qty_received }}</td>
                                                {{-- <td>{{ $barang->unit }}</td> --}}
                                                <td>@currency($barang->harga_beli)</td>
                                              
                                                
                                            </tr>
                                            @php
                                            $total += $barang->qty_received * $barang->harga_beli
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td rowspan="2  " colspan="2"><b>Total Pembelian : </b></td>
                                              
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td colspan="5"></td>
                                                <td>SUB TOTAL </td>
                                                <td><b>@currency($total)</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td colspan="7"></td>
                                                <td>PPN</td>
                                                <td><b>{{ $penerimaan->ppn}}%</b></td>
                                            </tr>
                                            <tr style="font-size:12px;">
                                                <td colspan="7"></td>
                                                <td><strong>TOTAL<strong> </td>
                                                <td><b>@currency($penerimaan->grandtotal )</b></td>
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

@stop


@section('footer')
<script>
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



