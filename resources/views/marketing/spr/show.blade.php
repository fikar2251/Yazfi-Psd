@extends('layouts.master', ['title' => 'Detail SPR'])
@section('content')

    <div class="text-center">
        <h4 style="font-size: 30px; font-weight: 500; text-decoration: underline" class="page-title mb-3">SURAT PEMESANAN
            RUMAH</h4>
    </div>

    <div class=" row d-flex justify-content-center" style="margin-left: 100px">
        <div class="col-sm-5">
            <table class="table table-borderless" style="border: none">
                <tbody>
                    <tr>
                        <td style="width: 100px">No</td>
                        <td style="width: 20px">:</td>
                        <td> {{ $spr->no_transaksi }} </td>
                    </tr>
                    <tr>
                        <td style="width: 100px">Tanggal</td>
                        <td style="width: 20px">:</td>
                        <td> {{ $spr->tanggal_transaksi }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title">I. Data Pembeli</h4>
                    <div class="table-responsive container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 200px">Konsumen</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->nama }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">No KTP</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->no_ktp }} </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">No NPWP</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->npwp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">No Tlp</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->no_tlp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">No HP</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->no_hp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Email</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Alamat</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $add->alamat }}, <br>
                                        {{ $add->desa->name }}, {{ $add->kecamatan->name }},
                                        {{ $add->kota->name }}, {{ $add->provinsi->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Pekerjaan</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->pekerjaan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="card-title mt-5">II. Data Unit Rumah</h4>
                    <div class="table-responsive container">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 200px">Type</td>
                                    <td style="width: 20px">:</td>
                                    <td colspan="4"> {{ $spr->unit->type }}

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Blok</td>
                                    <td style="width: 20px">:</td>
                                    <td> {{ $spr->unit->blok }}

                                        {{-- <tr> --}}
                                    <td style="width: 200px">No</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->unit->no }}
                                    </td>
                                    {{-- </tr> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Luas tanah</td>
                                    <td style="width: 20px">:</td>
                                    <td colspan="4">
                                        {{ $spr->unit->lt }} M<sup>2</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Luas Bangunan</td>
                                    <td style="width: 20px">:</td>
                                    <td colspan="4">
                                        {{ $spr->unit->lb }} M<sup>2</sup>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Penambahan Luas Tanah</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        @if ($spr->unit->nstd = '-')
                                            -
                                        @else
                                            {{ $spr->unit->nstd }} M<sup>2</sup>
                                        @endif

                                    <td style="width: 200px">Total</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        {{ $spr->unit->total }} M<sup>2</sup>
                                    </td>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 200px">Harga Jual</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        @currency($spr->harga_jual)

                                    <td style="width: 200px">Harga Net</td>
                                    <td style="width: 20px">:</td>
                                    <td>
                                        @currency($spr->harga_net)
                                    </td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-t-20 text-center">
        <a href="{{ route('marketing.spr.cetakspr', $spr->id_transaksi) }}" target="_blank"
            class="btn btn-primary submit-btn btnprn"><i class="fa fa-save"></i> Cetak
        </a>
    </div>
@stop
