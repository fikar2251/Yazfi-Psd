@extends('layouts.master', ['title' => 'Show Reinburst'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Reinburst</h4>
    </div>
</div>


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
                                <h6><span style="font-size: 15px; color:white; background-color:blue;">{{$reinbursts->nomor_reinburst}}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2><span style="color:blue; text-decoration: underline; font-size: 20px">Pengajuan Reimburse</span></h2>
                            </div>
                        </div> <br />
                        <div class="payment-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p style="font-size: 12px">Nama :
                                        <a>
                                            {{ $reinbursts->admin->name }}
                                        </a>
                                    </p style="font-size: 12px">
                                    <p style="font-size: 12px">Jabatan :
                                        <a style="font-size: 12px">
                                            {{ $reinbursts->jabatan->nama }}
                                        </a>
                                    </p>
                                    <p style="font-size: 12px">Divisi :
                                        <a style="font-size: 12px">
                                            {{ $reinbursts->roles->name }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-6 tex-right">
                                    <div class="form-group">
                                        <p style="font-size: 12px">Tanggal : <a style="font-size: 12px">{{ Carbon\Carbon::parse($reinbursts->tanggal_reinburst)->isoFormat('dddd, D MMMM Y') }}
                                            </a></p>
                                    </div>
                                    <div class="form-group">
                                        <p style="font-size: 12px">Lampiran : <a style="font-size: 12px">{{$reinbursts->nomor_reinburst}}/{{ $reinbursts->file }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  ">
                                        <tr class="bg-success" style="font-size:12px; text-align:center;" >
                                            <th class="text-light" style="font-size:12px; text-align:left;">No.</th>
                                            <th class="text-light">Nota / BON / Kwitansi</th>
                                            <th class="text-light">Catatan</th>
                                            <th class="text-light">Jumlah</th>
                                        </tr>
                                        <tbody>

                                            @php
                                            $total = 0
                                            @endphp
                                            @foreach(App\RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get() as $rein)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rein->no_kwitansi }}</td>
                                                <td>{{ $rein->catatan }}</td>
                                               <td style="font-size:12px; text-align:right;" >@currency($rein->harga_beli)</td>
                                            </tr>
                                            @php
                                            $total += $rein->total
                                            @endphp
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"><strong>Total Reimburse<strong> </td>
                                               <td style="font-size:12px; text-align:right;" ><b>@currency($total)</b></td>
                                                
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <p class="text-center">Diajukan Oleh,</p>
                                                </td>
                                                <td colspan="2">
                                                    <p class="text-center">DiPeriksa dan DiSetujui,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-left">Manager</p>
                                                    <p class="text-right" style="margin-top: -37px;">Keuangan</p>
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
    @stop