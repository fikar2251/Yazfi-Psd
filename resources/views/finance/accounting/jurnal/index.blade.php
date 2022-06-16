@extends('layouts.master', ['title' => 'Jurnal Voucher'])

@section('content')
<div class="row">
    <div class="col-md-4">
        <h1 class="page-title">Jurnal Voucher</h1>
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

                <form action="{{route('finance.jurnal.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="nomor_reinburst">No Voucher <span style="color: red">*</span></label>
                                        <input  type="text" name="no_voucher" value="{{$nourut}}" id="nomor_reinburst" class="form-control" readonly >
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="nama">Name <span style="color: red">*</span></label>
                                        <input type="text" value="{{ auth()->user()->name }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" value="{{ auth()->user()->id_jabatans }}" name="id_jabatans" id="id_jabatans" class="form-control" readonly>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                       <label for="tanggal">Tanggal <span style="color: red">*</span></label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                        <label for="cabang">Description <span style="color: red">*</span></label>
                                       {{-- <select name="id_project" id="id_project" class="form-control" required>
                                            <option value="">-- Select Project --</option>
                                        </select> --}}
                                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="col-sm-6 col-sg-4 m-b-4">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="form-group">
                                       <label for="file">Lampiran <span style="color: red">*</span></label>
                                        <input type="file" name="file[]" multiple="true" required class="form-control">
                                        <label style="font-size:12px;"for="password"> <i class="fa-solid fa-triangle-exclamation"></i> file pdf (digabungkan dalam satu file jika mengisi lebih dari satu reinburst )</label>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
                    </div>

                    <button type="button" id="add" class="btn btn-primary mb-2">Tambah Row Baru</button>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover border" id="table-show">
                                    <tr class="bg-success">
                                        <th class="text-light">Account Name</th>
                                        <th class="text-light">Debit</th>
                                        <th class="text-light">Credit</th>
                                        <th class="text-light">Memo</th>
                                        <th class="text-light">#</th>
                                    </tr>
                                    <tbody id="dynamic_field">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-info">*Mohon Untuk Input Dengan Benar dan Berurut : <span class="badge badge-primary" id="counter"></span></p> --}}
                    <div class="row d-flex justify-content-end">
                        <div class="col-lg-3">
                            <h6>Total due</h6>
                            
                                    <div class="form-group">
                                        <label>Total Debit</label>
                                        <input type="text" id="sub_total1" name="total" required readonly class="form-control">
                                    </div>
                               
                        </div>
                        <div class="col-lg-3">
                            <h6>Total due</h6>
                           
                            
                                    <div class="form-group">
                                        <label>Total Credit</label>
                                        <input type="text" id="sub_total" name="total" required readonly class="form-control">
                                    </div>
                               
                        </div>
                    </div>
                    
                    <div class=" float-right">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</html>
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
        // document.getElementById('counter').innerHTML = index
        let template = `
                <tr class="rowComponent">
                    <td hidden>
                        <input type="hidden" name="barang_id[${index}]" class="barang_id-${index}">
                    </td>
                    <td>
                        
                        <select required name="account_name[]" id="${index}" class="form-control select-${index}"></select>
                    </td>
                    <td>
                         <input  type="number" name="debit[]"   class="form-control debit-${index}" placeholder="0" data-debit="${index}" onkeyup="hitung1(this), TotalAbout1(this)">
                         <input  type="number" required name="total1[${index}]" disabled class="form-control total1-${index} total-form1"  placeholder="0">
                    </td>
                    <td>
                         <input  type="number" id="rupiah" name="credit[]" class="form-control credit-${index} waktu" placeholder="0"  data="${index}" onkeyup="hitung(this), TotalAbouts(this)">
                         <input  type="number" required name="total[${index}]" disabled class="form-control totals-${index} total-forms"  placeholder="0">
                    </td>
                    <td>
                        <input type="text" name="memo[${index}]"  class="form-control memo-${index} total-form2"  placeholder="Memo">
                       
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="remove(this)">Delete</button>
                    </td>
                </tr>
        `
        $('#dynamic_field').append(template)

        $(`.select-${index}`).select2({
            placeholder: 'Account Name',
            ajax: {
                url: `/finance/acc/name`,
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
        let beli = $(`.credit-${attr}`).val()
        console.log(beli);
        let total = parseInt(beli);
        console.log(total);
        $(`.total-${attr}`).val(total)


    }
    

    function TotalAbout(e) {
        let sub_total = document.getElementById('sub_total')
        let total = 0;
        let coll = document.querySelectorAll('.total-form')
        for (let i = 0; i < coll.length; i++) {
            let ele = coll[i]
            total += parseInt(ele.value)
        }
        sub_total.value = total
        document.getElementById('grandtotal').value = total;
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
        let SUB = document.getElementById('sub_total').value;
        let PPN = document.getElementById('PPN').value;
        console.log(PPN);
        let tax = PPN / 100 * sub_total.value;
        console.log(tax);
        console.log(SUB);
        let grand_total = parseInt(SUB) + parseInt(tax);
        document.getElementById('grandtotal').value = grand_total;
        console.log(grand_total);
    }
    $(document).ready(function() {
        $('#add').on('click', function() {
            form_dinamic()
        })
    })
</script>
@stop


