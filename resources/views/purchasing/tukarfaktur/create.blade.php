@extends('layouts.master', ['title' => 'Create Tukar Faktur'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Tukar Faktur</h4>
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

                                    <label for="no_po">Berdasarkan Pilihan : </label>


                                    <input style="width:15px;" id="myCheck" type="radio" name="myCheck"
                                        onclick="myFunction()" value="1" class="detail" data-binding-checked="">
                                    <label class="form-check-label" for="myCheck">No Penerimaan Barang</label>

                                    <input style="width:15px;" id="myCheck2" type="radio" name="myCheck"
                                        onclick="myFunction()" value="1" class="detail" data-binding-checked="">
                                    <label class="form-check-label" for="myCheck">SPK</label>

                                </div>

                            </li>
                        </ul>
                    </div>

                </div>



            </div>
        </div>
    </div>
</div>

<div id="text" style="display:none">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" id="card">
                <div class="card-body">

                    <form action="{{ route('purchasing.tukarfaktur.store') }}" name="form1" method="post">
                        @csrf

                        <div class="row">

                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_faktur">Number Faktur <span
                                                    style="color: red">*</span></label>
                                            <input type="text" readonly name="no_faktur" value="{{ $nourutTF }}"
                                                id="no_faktur" class="form-control">

                                            @error('no_faktur')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="tanggal_tukar_faktur">Tanggal Tukar Faktur <span
                                                    style="color: red">*</span></label>
                                            <input type="date" name="tanggal_tukar_faktur" id="tanggal_tukar_faktur"
                                                required="" class="form-control">

                                            @error('tanggal_tukar_faktur')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_invoice">Number Invoice <span
                                                    style="color: red">*</span></label>
                                            <input type="text" name="no_invoice" value="" id="no_invoice"
                                                class="form-control" required="">

                                            @error('no_invoice')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <input type="hidden" name="po_spk" value="1" class="form-control">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <table class="table table-bordered  report">
                            <tr style="font-size:12px;" class="bg-success">
                                <th style="text-align:center;" class=" text-light">No.</th>
                                <th style="text-align:center;" class="text-light">Kelengkapan
                                    Dokumen</th>
                                <th style="width:10px; text-align:center;" class="text-light">
                                    Ada</th>
                                <th style="width:80px;text-align:center;" class="text-light">
                                    Tidak Ada</th>
                                <th style="text-align:center;" class="text-light"> Catatan</th>
                            </tr>
                            <tbody>
                                @foreach($purchasing as $barang)
                                <tr style="font-size:12px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" value="{{$barang->nama_dokumen}}" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }} disabled"
                                            placeholder="Nama Dokumen" style="font-size:13px;">
                                        <input type="hidden" value="{{$barang->id}}"
                                            name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }}"
                                            placeholder="Nama Dokumen" style="font-size:13px;">

                                        @error('id_dokumen')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="Y"
                                            data-binding-checked="" style=" width:1.2em; text-align:center;" ;>

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="T"
                                            data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="catatan[{{ $loop->iteration }}]" id="catatan"
                                            class="form-control catatan-{{ $loop->iteration }}" placeholder="catatan"
                                            style="font-size:13px;">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow" id="card">
                                    <div class="table-responsive">
                                        <div class="col-md-12">

                                            <br>
                                            <br>
                                            <div class="col-sm-5 col-4">
                                                <h4 class="page-title">Riwayat Penerimaan Barang
                                                </h4>
                                            </div>
                                            <table class="table table-bordered  report">
                                                <tr style="font-size:12px;" class="bg-success">
                                                    <th class=" text-light">No.</th>
                                                    <th class="text-light">No. Penerimaan Barang</th>
                                                    <th class="text-light">Tanggal Penerimaan</th>
                                                    <th class="text-light">Total Item</th>
                                                    <th class="text-light"> Total</th>
                                                    <th class="text-light"></th>

                                                </tr>
                                                <tbody id="dynamic_field">
                                                    @foreach($purchases as $purchase)
                                                    <tr class="rowComponent">
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('purchasing.penerimaan-barang.show', $purchase->id) }}">{{ $purchase->no_penerimaan_barang }}

                                                                {{-- Nama Barang --}}

                                                                <input type="hidden" value="{{ $purchase->nama_barang}}"
                                                                    name="nama_barang[{{ $loop->iteration }}]"
                                                                    id="nama_barang" required=""
                                                                    class="form-control nama_barang-{{ $loop->iteration }}"
                                                                    style="font-size:13px;">


                                                                {{-- supplier --}}
                                                                <input type="hidden" value="{{$purchase->supplier_id}}"
                                                                    name="id_supplier[{{ $loop->iteration }}]"
                                                                    id="id_supplier" required=""
                                                                    class="form-control id_supplier-{{ $loop->iteration }}"
                                                                    style="font-size:13px;">

                                                                {{-- project --}}
                                                                <input type="hidden" value="{{$purchase->project_id}}"
                                                                    name="id_project[{{ $loop->iteration }}]"
                                                                    id="id_project" required=""
                                                                    class="form-control id_project-{{ $loop->iteration }}"
                                                                    style="font-size:13px;">

                                                                {{-- no_po --}}
                                                                <input type="hidden" value="{{$purchase->no_po}}"
                                                                    name="no_po_vendor[{{ $loop->iteration }}]"
                                                                    id="no_po_vendor" required=""
                                                                    class="form-control no_po_vendor-{{ $loop->iteration }}"
                                                                    style="font-size:13px;">
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($purchase->tanggal_penerimaan)->format("d/m/Y") }}
                                                        </td>
                                                        <td>{{ \App\PenerimaanBarang::where('no_penerimaan_barang', $purchase->no_penerimaan_barang)->count() }}
                                                        <td>
                                                            @currency($purchase->total / 100 * $purchase->ppn +
                                                            $purchase->total)
                                                            <input type="text" value="0"
                                                                class="form-control total_all-{{ $loop->iteration }} total-form"
                                                                placeholder="0">
                                                            <input type="text" value="0"
                                                                class="form-control total_out-{{ $loop->iteration }} total-out"
                                                                placeholder="0">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox"
                                                                class="form-control total-{{ $loop->iteration }}"
                                                                name="total[{{ $loop->iteration }}]"
                                                                data="{{ $loop->iteration }}" id="total"
                                                                value="{{$purchase->total / 100 * $purchase->ppn + $purchase->total}}"
                                                                onclick="totalAll(this), totalAll_out(this)"
                                                                style=" width:1.2em; text-align:center;">
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td rowspan="3"></td>
                                                        <td colspan="1" rowspan="3"><b>Total Pembelian : </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><b>Grand Total: </b></td>
                                                        <td colspan="3">
                                                            <input type="text" name="nilai_invoice" id="nilai_invoice"
                                                                class="form-control" value="0">

                                                            <input type="text" id="nilai_invoice_out"
                                                                class="form-control" value="0">

                                                            <input type="text" id="nilai_total"  class="form-control"
                                                                value="0"> 
                                                           
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="form-group text-right">
                                                <div class="col-sm-12 col-sg-6 col-md-12 m-b-6">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="submit">Submit</button>
                                                </div>
                                            </div>
                                            <script>
                                                function totalAll(e) {
                                                    let nilai_invoice = document
                                                        .getElementById('nilai_invoice')
                                                    let nilai_invoice_out = document
                                                        .getElementById('nilai_invoice_out')


                                                    let attr = $(e).attr('data')
                                                    let total = $(`.total-${attr}`)
                                                        .val()
                                                    let updated_total = parseInt(total)
                                                    $(`.total_all-${attr}`).val(
                                                        updated_total)
                                                  

                                                    nilai_invoice.value = updated_total
                                                    // nilai_total.value = updated_total


                                                    let total_all = 0;
                                                    let coll = document.querySelectorAll('.total-form')

                                                    $(document).ready(function () {
                                                        $('input[type="checkbox"]').click(function () {
                                                            if ($(this).is(":checked")) {
                                                                // $("#result").html(
                                                                //     "Checkbox is checked.");

                                                                for (let i = 0; i < coll.length; i++) {
                                                                    let ele = coll[i]
                                                                    total_all += parseFloat($(ele).val()
                                                                        .replace(/,/g, ''))
                                                                    // console.log(total_all);

                                                                }
                                                                $('#nilai_invoice').val(total_all)
                                                                $('#nilai_total').val(total_all * 0)
                                                                $(`.total_out-${attr}`).val(
                                                                    total_all*0)
                                                                $('#nilai_invoice_out').val(total_all)



                                                            }

                                                        });
                                                    });

                                                }

                                                function totalAll_out(e) {
                                                    let nilai_total = document
                                                        .getElementById('nilai_total')
                                                    


                                                    let attr_out = $(e).attr('data')
                                                    let total_out_all = $(`.total-${attr_out}`)
                                                        .val()
                                                    let updated_total_out = parseInt(total_out_all)
                                                    $(`.total_out-${attr_out}`).val(
                                                        updated_total_out)
                                                  

                                                    nilai_total.value = updated_total_out
                                                
                                                    let total_out = 0;
                                                    let coll = document.querySelectorAll('.total-out')

                                                    $(document).ready(function () {
                                                        $('input[type="checkbox"]').click(function () {
                                                            if ($(this).is(
                                                                    ":not(:checked)")) {

                                                                for (let i = 0; i < coll.length; i++) {
                                                                    let ele = coll[i]
                                                                    total_out += parseFloat($(ele).val()
                                                                        .replace(/,/g, ''))
                                                                    // console.log(total_all);

                                                                }
                                                                 
                                                                $('#nilai_total').val(total_out)
                                                                $(`.total_all-${attr_out}`).val(
                                                                    total_out * 0)
                                                        
                                                                WeCanSumSallary_out()


                                                            }

                                                        });
                                                    });

                                                }


                                                // function WeCanSumSallary(e) {
                                                //     let attr = $(e).attr('data')
                                                //     let total = $(`.total-${attr}`)
                                                //         .val()                                                        

                                                //     $('#nilai_invoice_all').val(parseFloat($(`#nilai_invoice_out`).val()
                                                //         .replace(/,/g, '')) - parseFloat($('#nilai_total').val()
                                                //         .replace(/,/g, '')))
                                                // }
                                                function WeCanSumSallary_out(e) {

                                                    $('#nilai_invoice').val(parseFloat($(`#nilai_invoice_out`).val()
                                                        .replace(/,/g, '')) - parseFloat($('#nilai_total').val()
                                                        .replace(/,/g, '')))
                                                }

                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>






{{-- Form SPK --}}
<div id="text2" style="display: none;">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" id="card">
                <div class="card-body">

                    <form action="{{ route('purchasing.tukarfaktur.store') }}" name="form2" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_invoice">Number Bukti <span
                                                    style="color: red">*</span></label>
                                            <input type="text" required="" name="no_invoice" id="no_invoice"
                                                class="form-control">


                                            @error('no_invoice')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_faktur">Number Tukar Faktur<span
                                                    style="color: red">*</span></label>
                                            <input type="text" name="no_faktur" value="{{$nourutTF}}" id="no_faktur"
                                                class="form-control" readonly>

                                            @error('no_faktur')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="id_supplier">Supplier <span style="color: red">*</span></label>
                                            <select name="id_supplier" id="id_supplier" class="form-control select2">
                                                <option disabled selected>-- Select Supplier --</option>
                                                @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->nama }}
                                                </option>
                                                @endforeach

                                                @error('id_supplier')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="id_project">Project <span style="color: red">*</span></label>
                                            <select name="id_project" id="id_project"
                                                class="form-control input-lg dynamic" data-dependent="alamat_project"
                                                required="">
                                                <option disabled selected>-- Select Project --</option>
                                                @foreach($project as $projects)
                                                <option value="{{ $projects->id }}">
                                                    {{ $projects->nama_project }}
                                                </option>
                                                @endforeach

                                                @error('id_project')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="invoice">Lokasi <span style="color: red">*</span></label>
                                            <input type="text" id="lokasi" class="form-control" readonly>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="tanggal_tukar_faktur">Tanggal<span
                                                    style="color: red">*</span></label>
                                            <input type="date" required="" name="tanggal_tukar_faktur"
                                                id="tanggal_tukar_faktur" class="form-control">

                                            @error('tanggal_tukar_faktur')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="col-sm-6 col-sg-4 m-b-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="form-group">
                                            <label for="no_invoice">No Invoice<span style="color: red">*</span></label>
                                            <input type="text" required="" name="no_invoice" id="no_invoice"
                                                class="form-control">

                                            @error('no_invoice')
                                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        </li>
                        </ul>
                </div> --}}
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
                                <input type="text" name="nama_barang" class="form-control">

                                @error('nama_barang')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="nilai_invoice">Nilai Invoice <span style="color: red">*</span></label>
                                <input type="text" id="nilai_invoice" name="nilai_invoice" required=""
                                    class="form-control">


                                @error('nilai_invoice')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">

                                <input type="hidden" value="{{auth()->user()->id}}" name="id_user" id="id_user" readonly
                                    class="form-control">

                                @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <input type="hidden" name="po_spk" value="2" class="form-control">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered  report">
                            <tr style="font-size:12px;" class="bg-success">
                                <th style="text-align:center;" class=" text-light">No.</th>
                                <th style="text-align:center;" class="text-light">Kelengkapan
                                    Dokumen
                                </th>
                                <th style="width:10px; text-align:center;" class="text-light">Ada
                                </th>
                                <th style="width:60px;text-align:center;" class="text-light">Tidak
                                    Ada
                                </th>
                                <th style="text-align:center;" class="text-light"> Catatan</th>
                            </tr>
                            <tbody>
                                @foreach($purchasing as $barang)
                                <tr style="font-size:12px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" value="{{$barang->nama_dokumen}}" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }} disabled"
                                            placeholder="Nama Dokumen" style="font-size:13px;">
                                        <input type="hidden" value="{{$barang->id}}"
                                            name="id_dokumen[{{ $loop->iteration }}]" id="id_dokumen" required=""
                                            class="form-control id_dokumen-{{ $loop->iteration }}"
                                            placeholder="Nama Dokumen" style="font-size:13px;">

                                        @error('id_dokumen')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }}"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="Y"
                                            data-binding-checked="" style=" width:1.2em; text-align:center;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </td>
                                    <td>
                                        <input type="radio" name="pilihan[{{ $loop->iteration }}]"
                                            class="form-control pilihan-{{ $loop->iteration }} text-center"
                                            data="{{ $loop->iteration }}" required="" id="pilihan" value="T"
                                            data-binding-checked="" style="width:1.2em;   padding: 0.25em 0.5em;">

                                        @error('pilihan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="keterangan[{{ $loop->iteration }}]" id="keterangan"
                                            class="form-control keterangan-{{ $loop->iteration }}" placeholder="Catatan"
                                            style="font-size:13px;">

                                        {{-- @error('keterangan')
                                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-sg-4 m-b-4">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    function submit_form() {
        document.form1.submit();
        document.form2.submit();
    }

    function myFunction() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("text");
        var checkBox2 = document.getElementById("myCheck2");
        var text2 = document.getElementById("text2");

        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }

        if (checkBox2.checked == true) {
            text2.style.display = "block";
        } else {
            text2.style.display = "none";
        }
    }


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

    var rupiah = document.getElementById('nilai_invoice');
    if (rupiah) {
        rupiah.addEventListener('change', function (e) {
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    $(document).ready(function () {
        $('#add').on('click', function () {
            form_dinamic()
        })
    })
    $(document).ready(function () {
        $('.dynamic').change(function () {
            var id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            var alamat = "";
            var lokasi = "";
            $.ajax({
                url: `/logistik/where/project`,
                method: "get",
                data: {
                    'id': id
                },
                success: function (data) {
                    console.log(data);
                    op += '<input value="0" disabled>';
                    for (var i = 0; i < data.length; i++) {
                        var alamat = data[i].alamat_project;
                        document.getElementById('lokasi').value =
                            alamat;
                    };
                },
                error: function () {}
            })
        })
    })
    $(document).ready(function () {
        $('.dynamic_function').change(function () {
            var no_penerimaan_barang = $(this).val();
            var id = $(this).val();
            var div = $(this).parent();
            var op = " ";
            console.log(no_penerimaan_barang);
            $.ajax({
                url: `/purchasing/where/tukar/search`,
                method: "get",
                data: {
                    'id': id,
                    'no_penerimaan_barang': no_penerimaan_barang,
                },
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        var id = data[i].id;
                        // console.log(supplier_id);
                        document.getElementById('id').value = id;
                        var no_penerimaan_barang = data[i]
                            .no_penerimaan_barang;
                        // console.log(supplier_id);
                        document.getElementById('no_penerimaan_barang')
                            .value =
                            no_penerimaan_barang;
                    };
                },
                error: function () {}
            })
        })
    })

</script>

<script>
    $(document).ready(function () {
        $('.submit').on('click', function () {
            e.preventDefault();

            const nama_barang = [];
            const id_project = [];
            const id_supplier = [];
            const total_all = [];
            const total = [];
            const no_po_vendor = [];


            $('.total').each(function () {
                if ($(this).is(":checked")) {
                    total.push(($this).val());
                }


            });

            $('input[name^="nama_barang"]').each(
                function () {
                    nama_barang.push($(this).val);
                });
            $('input[name^="id_project"]').each(
                function () {
                    id_project.push($(this).val);
                });
            $('input[name^="id_supplier"]').each(
                function () {
                    id_supplier.push($(this).val);
                });
            $('input[name^="total_all"]').each(function () {
                total_all.push($(this).val);
            });
            $('input[name^="total"]').each(function () {
                nama_barang.push($(this).val);
            });
            $('input[name^="no_po_vendor"]').each(
                function () {
                    no_po_vendor.push($(this).val);
                });

            $.ajax({
                url: `/tukarfaktur/create/store`,
                type: 'POST',
                data: {

                    "_token": "{{ csrf_token() }}",
                    nama_barang: nama_barang,
                    id_project: id_project,
                    id_supplier: id_supplier,
                    total_all: total_all,
                    nama_barang: nama_barang,
                    no_po_vendor: no_po_vendor,
                },

                success: function (response) {
                    console.log('error');

                },
                error: function (response) {
                    console.log('error');
                }
            });


        });
    });

</script>
@stop
