@extends('layouts.master', ['title' => 'Balance of Sheet'])
@section('auto')
    <style>
        table.dataTable td {
            font-size: 12px;
            font-family: Helvetica;
        }

    </style>
@endsection
@section('content')
    <div>
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Balance of Sheet</h4>
        </div>
    </div>
    <x-alert></x-alert>
    <br />
    <div>
        <a href="{{route('finance.transactions')}}" class="btn btn-success mb-2">
            Back
        </a> <br>
        <hr>
        <b> ASSETS </b>
        <hr>
    </div>
    <div>
        <b> CASH & BANK </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th>Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cash = 0;
                @endphp
                @foreach ($balance as $bl)
                    <tr>
                        <td style="text-align: center"> {{ $loop->iteration }} </td>
                        <td>
                            {{ $bl->kode }}
                        </td>
                        <td> {{ $bl->deskripsi }} </td>
                        <td> {{ $bl->nama_cat }} </td>
                        <td>
                            @currency($bl->balance)
                            
                        </td>
                    </tr>
                    @php
                        $cash += $bl->balance;
                        
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> ACCOUNT RECEIVABLE </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $acc = 0;
                    $accs = 0;
                    $total = 0;
                @endphp
                @foreach ($parent as $pr)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $pr->kode }}
                        </td>
                        <td> {{ $pr->deskripsi }} </td>
                        <td> {{ $pr->category->nama_cat }} </td>
                        <td>
                            @currency($pr->balance)
                        </td>
                    </tr>
                    @php
                    $acc += $pr->balance;
                    
                @endphp
                    @foreach ($pr->children as $child)
                        <tr>
                            <td style="text-align: center"> {{ ++$i }} </td>
                            <td>
                                {{ $child->kode }}
                            </td>
                            <td> {{ $child->deskripsi }} </td>
                            <td> {{ $child->category->nama_cat }} </td>
                            <td>
                                @currency($child->balance)
                            </td>
                        </tr>
                        @php
                        $accs += $child->balance;
                        $total += $acc += $accs;
                    @endphp
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> INVENTORY </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $inv = 0;
                @endphp
                @foreach ($inventory as $in)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $in->kode }}
                        </td>
                        <td> {{ $in->deskripsi }} </td>
                        <td> {{ $in->nama_cat }} </td>
                        <td>
                            @currency($in->balance)
                        </td>
                    </tr>
                    @php
                        $inv += $in->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> OTHER CURRENT ASSET </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $ass = 0;
                @endphp
                {{-- @foreach ($inventory as $in)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $in->kode }}
                        </td>
                        <td> {{ $in->deskripsi }} </td>
                        <td> {{ $in->nama_cat }} </td>
                        <td>
                            @currency($in->balance)
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <div>
        <b> FIXED ASSET </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $fix = 0;
                @endphp
                @foreach ($fixed as $fx)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $fx->kode }}
                        </td>
                        <td> {{ $fx->deskripsi }} </td>
                        <td> {{ $fx->nama_cat }} </td>
                        <td>
                            @currency($fx->balance)
                        </td>
                    </tr>
                    @php
                        $fix =+ $fx->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> ACCUMULATED DEPRECIATION </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $accumu = 0;
                @endphp
                @foreach ($accumulated as $acc)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $acc->kode }}
                        </td>
                        <td> {{ $acc->deskripsi }} </td>
                        <td> {{ $acc->nama_cat }} </td>
                        <td>
                            @currency($acc->balance)
                        </td>
                    </tr>
                    @php
                        $accumu =+ $acc->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> OTHER ASSETS </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $oth = 0;
                @endphp
                @foreach ($other as $ot)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $ot->kode }}
                        </td>
                        <td> {{ $ot->deskripsi }} </td>
                        <td> {{ $ot->nama_cat }} </td>
                        <td>
                            @currency($ot->balance)
                        </td>
                    </tr>
                    @php
                        $oth =+ $ot->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-5">
        <b>
         TOTAL AKTIVA / ASSET = @currency($cash + $total + $inv + $fix + $accumu + $oth)
        </b>
    </div>

    <div>
        <b> LIABILITY </b>
        <hr>
    </div>
    <div>
        <b> ACCOUNT PAYABLE </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th>Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $payable = 0;
                @endphp
                @foreach ($hutang as $ht)
                    <tr>
                        <td style="text-align: center"> {{ $loop->iteration }} </td>
                        <td>
                            {{ $ht->kode }}
                        </td>
                        <td> {{ $ht->deskripsi }} </td>
                        <td> {{ $ht->nama_cat }} </td>
                        <td>
                            @currency($ht->balance)
                            
                        </td>
                    </tr>
                    @php
                        $payable += $ht->balance;
                        
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>


    <div>
        <b> OTHER CURRENT LIABILITY </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $lia = 0;
                @endphp
                @foreach ($liability as $lb)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $lb->kode }}
                        </td>
                        <td> {{ $lb->deskripsi }} </td>
                        <td> {{ $lb->nama_cat }} </td>
                        <td>
                            @currency($lb->balance)
                        </td>
                    </tr>
                    @php
                        $lia += $lb->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b> LONG TERM LIABILITY </b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $ass = 0;
                @endphp
                {{-- @foreach ($inventory as $in)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $in->kode }}
                        </td>
                        <td> {{ $in->deskripsi }} </td>
                        <td> {{ $in->nama_cat }} </td>
                        <td>
                            @currency($in->balance)
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <div>
        <b> EQUITY </b>
        @php
            $baya = 0;
        @endphp
        @foreach ($biaya as $by)
            @php
                $baya += $by->balance;
            @endphp
        @endforeach
       
    </div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table table-striped" id="transactions" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">No</th>
                    <th style="width: 10%">Account No</th>
                    <th style="width: 27%">Name</th>
                    <th style="width: 27.6%">Type</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $equ = 0;
                @endphp
                @foreach ($equity as $eq)
                    <tr>
                        <td style="text-align: center"> {{ ++$i }} </td>
                        <td>
                            {{ $eq->kode }}
                        </td>
                        <td> {{ $eq->deskripsi }} </td>
                        <td> {{ $eq->nama_cat }} </td>
                        <td>
                            @currency($eq->balance)
                        </td>
                    </tr>
                    @php
                        $equ += $eq->balance;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <b>
         TOTAL KEWAJIBAN / LIABILITY = @currency($payable + $lia + $equ + ($rev->balance - $cogs->balance - $baya))
    </div>
@stop
