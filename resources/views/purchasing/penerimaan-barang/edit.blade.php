@extends('layouts.master', ['title' => 'Create Penerimaan Barang'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Edit Penerimaan Barang</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <div class="dashboard-logo">
                            <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <div class="invoice-details">
                            <h3 class="text-uppercase"></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong></strong></h5>
                            </li>
                            <li><span></span></li>
                        </ul>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="supplier">Supplier <span style="color: red">*</span></label>
                                    <input type="text" readonly class="form-control"
                                        value="{{ $purchase->nama }}">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="project">Project <span style="color: red">*</span></label>
                                    <input type="text" value="{{$purchase->nama_project  }} " class="form-control"
                                        readonly>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi <span style="color: red">*</span></label>
                                    <input type="text" value="{{ $purchase->lokasi }}" class="form-control" readonly>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span style="color: red">*</span></label>
                                    <input type="text" value="{{ $purchase->created_at }}" class="form-control" readonly>

                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
                @foreach($penerimaans as $item)
                @endforeach
                <form action="{{ route('purchasing.penerimaan-barang.update', $purchase->id) }}" method="get">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <input type="hidden" readonly id="id_purchase" name="id_purchase" class="form-control"
                                            value="{{ $item ? $item->id_purchase : '' }}">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <input type="hidden" id="id_user" name="id_user" readonly class="form-control"
                                            value="{{ auth()->user()->id }}">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6 col-sg-4 m-b-4">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group">
                                                <h4 class="page-title">Insert Penerimaan Barang</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-sg-4 m-b-4">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group">
                                                <label for="tanggal">No Penerimaan Barang <span
                                                        style="color: red">*</span></label>
                                                <input type="text" id="no_penerimaan_barang" name="no_penerimaan_barang"
                                                    readonly class="form-control" value="{{ $item ? $item->no_penerimaan_barang : '' }}">
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-sg-4 m-b-4">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group">
                                                <label for="tanggal_penerimaan">Tanggal Penerimaan Barang<span
                                                        style="color: red">*</span></label>
                                                <input type="datetime-local" id="tanggal_penerimaan"
                                                    name="tanggal_penerimaan" class="form-control" required=""  value="{{Carbon\Carbon::parse($item ? $item->tanggal_penerimaan : '')->format('Y-m-d').'T'.Carbon\Carbon::parse($item ? $item->tanggal_penerimaan : '')->format('H:i:s')}}">
                                                @error('tanggal_penerimaan')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered  report">
                                    <tr style="font-size:12px;" class="bg-success">
                                        <th class=" text-light">No.</th>
                                        <th class="text-light">Nama Barang</th>
                                        <th class="text-light">Qty Received</th>
                                        <th class="text-light">Qty Order</th>
                                        <th class="text-light">Harga Satuan</th>
                                        <th class="text-light"> Total</th>
                                        <th class="text-light"> Status Barang</th>
                                    </tr>
                                    <br>
                                    <br>
                                    <tbody id="dynamic_field">
                                        <script src="{{ asset('/') }}js/jquery-3.2.1.min.js"></script>
                                        <script src="{{ asset('/') }}js/select2.min.js"></script>

                                        @foreach($penerimaans as $penerimaan)
                                        <tr class="rowComponent">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>

                                                <input type="text" value="{{$penerimaan->barang->nama_barang}}"
                                                    class="form-control" disabled>
                                                <input type="hidden" name="barang_id[{{ $loop->iteration }}]"
                                                    data="{{ $loop->iteration }}" id="barang_id"
                                                    value="{{ $penerimaan->barang_id }}"
                                                    class="form-control barang_id-{{ $loop->iteration }}">

                                                @error('barang_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="qty_received[{{ $loop->iteration }}]" value="{{ $penerimaan->qty_received }}"
                                                    class="form-control qty_received-{{ $loop->iteration }}"
                                                    data="{{ $loop->iteration }}" required="" onkeyup="testNum(this)"
                                                    id="qty_received" placeholder=" 0">

                                                @error('qty_received')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $penerimaan->qty }}"
                                                    name="qty[{{ $loop->iteration }}]" data="{{ $loop->iteration }}"
                                                    id="qty" class="form-control qty-{{ $loop->iteration }}"
                                                    placeholder="0" required="">

                                                @error('qty')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </td>
                                            <td>
                                                <input type="number" value="{{$penerimaan->harga_beli}}"
                                                    name="harga_beli[{{ $loop->iteration }}]"
                                                    class="form-control harga_beli-{{ $loop->iteration }}"
                                                    data="{{ $loop->iteration }}"
                                                    onkeyup="hitung(this), HowAboutIt(this)" placeholder="0"
                                                    id="harga_beli" required="">

                                                @error('harga_beli')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" value="{{$penerimaan->total}}"
                                                    name="total[{{ $loop->iteration }}]" disabled
                                                    class="form-control total-{{ $loop->iteration }} total-form"
                                                    placeholder="0" required="">

                                                @error('total')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" value="{{$penerimaan->purchase->status_barang}}"
                                                    name="status_barang[{{ $loop->iteration }}]" id="status_barang"
                                                    class="form-control status_barang-{{ $loop->iteration }} status-form"
                                                    placeholder="Status Barang" required="">
                                                @error('status_barang')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="row invoice-payment">
                                    <div class="col-sm-4 offset-sm-8">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="text" id="sub_total" name="total" readonly
                                                        class="form-control"
                                                        value="{{ $penerimaans->sum('total') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function hitung(e) {
                                        let harga = e.value
                                        let attr = $(e).attr('data')
                                        let qty = $(`.qty-${attr}`).val()
                                        console.log(qty);
                                        let total = parseInt(harga * qty)
                                        $(`.total-${attr}`).val(total)

                                    }


                                    // function TotalAbout(e) {
                                    //     let sub_total = document.getElementById('sub_total')
                                    //     let total = 0;
                                    //     let coll = document.querySelectorAll('.total-form')
                                    //     for (let i = 0; i < coll.length; i++) {
                                    //         let ele = coll[i]
                                    //         total += parseInt(ele.value)
                                    //     }
                                    //     sub_total.value = total
                                    //     document.getElementById('grandtotal').value = total;
                                    // }

                                    function HowAboutIt(e) {
                                        let sub_total = document.getElementById('sub_total')
                                        let total = 0;
                                        let coll = document.querySelectorAll('.total-form')
                                        for (let i = 0; i < coll.length; i++) {
                                            let ele = coll[i]
                                            total += parseInt(ele.value)
                                        }
                                        sub_total.value = total
                                        // let SUB = document.getElementById('sub_total').value;
                                        // let PPN = document.getElementById('PPN').value;
                                        // console.log(PPN);
                                        // let tax = PPN / 100 * sub_total.value;
                                        // console.log(tax);
                                        // console.log(SUB);
                                        // let grand_total = parseInt(SUB) + parseInt(tax);
                                        // document.getElementById('grandtotal').value = grand_total;
                                        // console.log(grand_total);
                                    }

                                </script>

                                <div class="col-sm-1 offset-sm-8">
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-5 col-4">
                                    <h4 class="page-title">Riwayat Penerimaan Barang</h4>
                                </div>
                            </div>
                            <table class="table table-bordered  report">
                                <tr style="font-size:12px;" class="bg-success">
                                    <th class=" text-light">No.</th>
                                    <th class="text-light">Nama Barang</th>
                                    <th class="text-light">Qty</th>
                                    <th class="text-light">Harga</th>
                                    <th class="text-light"> Total</th>
                                    <th class="text-light"> Diajukan</th>
                                </tr>
                                <tbody id="dynamic_field">
                                    @foreach($penerimaans as $penerimaan)
                                    <tr class="rowComponent">
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            {{$penerimaan->barang->nama_barang}}
                                        </td>
                                        <td>
                                            {{$penerimaan->qty}}
                                        </td>
                                        <td>
                                            @currency($penerimaan->harga_beli)
                                        </td>
                                        <td>
                                            @currency($penerimaan->total)
                                        </td>
                                        <td>
                                            {{$penerimaan->admin->name}}
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
    </div>
</div>


</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    var formatter = function (num) {
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
        // let template = `
        // <tr class="rowComponent">
        //             <td hidden>
        //                 <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
        //             </td>
        //             <td>
        //                 <select required name="barang_id[${index}]" id="${index}" class="form-control select-${index}"></select>
        //             </td>
        //             <td>
        //                 <input type="number" name="qty[${index}]"  class="form-control qty-${index}" placeholder="0">
        //             </td>
        //             <td>
        //                 <input type="number" name="harga_beli[${index}]" class="form-control harga_beli-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this)">
        //             </td>
        //             <td>
        //                 <input type="number" name="total[${index}]" disabled class="form-control total-${index} total-form"  placeholder="0">
        //             </td>
        //             <td>
        //                 <button type="button" class="btn btn-danger btn-sm" onclick="remove(this)">Delete</button>
        //             </td>
        //         </tr>
        // `
        $('#dynamic_field').append(template)

        $(`.select-${index}`).select2({
            placeholder: 'Select Product',
            ajax: {
                url: `/admin/where/product`,
                processResults: function (data) {
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
    $('.remove').on('click', function () {
        $(this).parent().parent().remove()
    })


    $(document).ready(function () {
        $('#add').on('click', function () {
            form_dinamic()
        })
    })
    $(document).ready(function () {
        $('.dynamic_function').change(function () {
            var invoice = $(this).val();
            var id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(invoice);
            $.ajax({
                url: `/purchasing/where/penerimaan/search`,
                method: "get",
                data: {
                    'invoice': invoice,
                },
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        var id = data[i].id;
                        // console.log(supplier_id);
                        document.getElementById('id').value = id;

                        // var supplier_id = data[i].supplier_id;
                        // // console.log(supplier_id);
                        // document.getElementById('supplier_id').value = supplier_id;
                        // document.getElementById('supplier_id').defaultvalue = supplier_id;

                        // var project_id = data[i].project_id;
                        // // console.log(project_id);
                        // document.getElementById('project_id').value = project_id;
                        // document.getElementById('project_id').defaultvalue = project_id;

                        // var lokasi = data[i].lokasi;
                        // // console.log(lokasi);
                        // document.getElementById('lokasi').value = lokasi;
                        // document.getElementById('lokasi').defaultvalue = lokasi;

                        // var created_at = data[i].created_at;
                        // // console.log(created_at);
                        // document.getElementById('created_at').value = created_at;
                        // document.getElementById('created_at').defaultvalue = created_at;


                    };
                },
                error: function () {}
            })
        })
    })

    function testNum(e) {
        let result = 0;
        let attr = $(e).attr('data')
        let qty_received = $(`.qty_received-${attr}`).val()
        console.log(qty_received)
        let qty = $(`.qty-${attr}`).val()
        console.log(qty)

        if (qty > qty_received) {
            result = 'partial'
        } else {
            result = 'completed';
        }

        $(`.status_barang-${attr}`).val(result)

        // console.log(status_barang);
        // let coll = document.querySelectorAll('.status-form')
        // for (let i = 0; i < coll.length; i++) {
        //     let ele = coll[i]
        //     status_barang += parseInt(ele.value)
        // }
        // document.getElementById("status_barang").value = result;

        // console.log(status_barang)


    }

    // function tesNumIT(e) {


    //     let status_barang = 0;
    //     let coll = document.querySelectorAll('.status-form')
    //     for (let i = 0; i < coll.length; i++) {
    //         let ele = coll[i]
    //         status_barang += parseInt(ele.value)
    //     }
    //     let SUB = document.getElementById(status_barang);

    // }

</script>
@stop
