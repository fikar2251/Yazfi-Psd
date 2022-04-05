@extends('layouts.doc', ['title' => 'Struk Pembayaran'])

@section('body')

<body onload="" class="struk">
    <section class="sheet padding-1mm">
        <div class="header-doc">
            <div class="">
                <img src="{{ asset('/storage/' . \App\Setting::find(1)->logo) }}" alt="" width="100px" style="display: block; margin: auto;">
            </div>
            <div class="title" style="text-align: center; font-family: Arial, Helvetica, sans-serif; margin-top: 20px;">
                <span style="text-transform: uppercase;">{{ \App\Setting::find(1)->web_name }} {{ $appointment->cabang->nama }}</span><br>
                <span style="text-transform: uppercase; font-size: 14px;">{{ $appointment->cabang->alamat }}</span><br>
                <span style="text-transform: uppercase; font-size: 14px;">{{ $appointment->cabang->telpon }}</span>
            </div>
        </div>


        <table style="display: inline-block; font-size: 14px; margin-top: 20px;">
            <tr>
                <td width="100px">No </td>
                <td>:</td>
                <td>{{ $appointment->no_booking }}</td>
            </tr>
            <tr>
                <td width="100px">Receptionis</td>
                <td>:</td>
                <td>{{ $appointment->resepsionis->name }}</td>
            </tr>
            <tr>
                <td width="100px">Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($appointment->tanggal_status)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td width="100px">Tanggal Lahir</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($appointment->pasien->tgl_lahir)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td width="100px">Pasien</td>
                <td>:</td>
                <td>{{ $appointment->pasien->nama }}</td>
            </tr>
        </table>

        <table style=" font-size: 14px; margin-top: 20px;" border="1" cellspacing="0" width="100%">
            <tr>
                <th>Qty </th>
                <th>Desc</th>
                <th>Amount</th>
            </tr>
            @php
            $subtotal = 0;
            $pajak = $appointment->cabang->ppn
            @endphp
            @foreach($appointment->tindakan as $tindakan)
            <tr>
                <td style="text-align: center;">{{ $tindakan->qty }} </td>
                <td>{{ $tindakan->item->nama_barang }} </td>
                @php
                $harga = \App\HargaProdukCabang::where('barang_id', $tindakan->item->id)->where('cabang_id', $appointment->cabang_id)->first();
                $subtotal += $tindakan->qty * $harga->harga
                @endphp
                <td style="text-align: end;">@rp($tindakan->qty * $harga->harga) </td>
            </tr>
            @endforeach
        </table>
        @php
        $pajak = $appointment->cabang->ppn * $subtotal / 100
        @endphp
        <table style=" font-size: 14px; margin-top: 20px;" cellspacing="0" width="100%">
            <tr>
                <td>Subtotal </td>
                <td> : </td>
                <td style="text-align: end;"> @rp($subtotal)
                <td>
            </tr>
            <tr>
                <td>Pajak </td>
                <td> : </td>
                <td style="text-align: end;"> @rp($pajak)
                <td>
            </tr>
            <tr>
                <td>Grand Total </td>
                <td> : </td>
                <td style="text-align: end;"> @rp($subtotal + $pajak)
                <td>
            </tr>
        </table>

        <table style=" font-size: 14px; margin-top: 20px;" cellspacing="0" width="100%">
            <tr>
                <td>Pembayaran </td>
                <td> </td>
                <td style="text-align: end;">
                <td>
            </tr>
            @foreach($appointment->rincian as $rincian)
            <tr>
                <td>
                    {{$rincian->payment->nama_metode}} ({{\Carbon\Carbon::parse($rincian->tanggal_pembayaran)->format('d/m/Y')}})
                </td>
                <td> </td>
                <td style="text-align: end;">@rp($rincian->nominal) </td>
            </tr>
            @endforeach
            @if($appointment->rincian->sum('disc_vouc') > 0)
            <tr>
                <td>
                    Voucher
                </td>
                <td> </td>
                <td style="text-align: end;">@rp($appointment->rincian->sum('disc_vouc')) </td>
            </tr>
            @endif
            <tr>
                <td>Sisa Pembayaran</td>
                <td></td>
                <td style="text-align: end;">{{ $appointment->status_pembayaran == 1 ? 'Lunas' : number_format($subtotal + $pajak - ($appointment->rincian->sum('nominal') + $appointment->rincian->sum(disc_vouc))) }}</td>
            </tr>
        </table>

    </section>
</body>
@stop