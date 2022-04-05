<?php

namespace App\Http\Controllers\Dokter;

use App\Booking;
use App\Customer;
use App\Fisik;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\KetOdontogram;
use App\RekamMedis;
use App\Shift;
use App\SimbolOdontogram;
use App\Tindakan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function pasien()
    {
        $pasien = Customer::where('cabang_id', auth()->user()->cabang_id)->get();
        return view('dokter.pasien.index', [
            'pasien' => $pasien
        ]);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dokter.dokter.show', [
            'dokter' => $user,
            'booking' => Booking::where('dokter_id', $user->id)->get(),
            'shift' => Shift::get(),
            'attendance' => Jadwal::where('user_id', $user->id)->whereMonth('tanggal', Carbon::now()->format('m'))->whereYear('tanggal', Carbon::now()->format('Y'))->get()
        ]);
    }
    public function ajax($id, $value, $id_booking)
    {
        Tindakan::where('id', $id)->update([
            'status' => $value,
            'dokter_id' => auth()->user()->id,
            'waktu_selesai' => Carbon::now()->format('H:i:s')
        ]);

        $response = [
            'dokter' => auth()->user()->name,
            'status' => Booking::findOrFail($id_booking)->status->status,
            'updated_at' => Carbon::parse(Tindakan::find($id)->updated_at)->format('Y-m-d H:i:s')
        ];
        return response()->json($response);
    }
    public function AjaxPasien()
    {
        $cabang_id = auth()->user()->cabang_id;
        $pasien = Customer::where('cabang_id', auth()->user()->cabang_id)->get();
        return datatables()
            ->of($pasien)
            ->addIndexColumn()
            ->editColumn('umur', function ($data) {
                return (int)Carbon::now()->format('Y') - (int)Carbon::parse($data->tgl_lahir)->format('Y') . ' Tahun';
            })
            ->editColumn('action', function ($data) {
                return "<div class='btn-group'><a href='" . route('dokter.history', $data->id) . "' class='btn btn-danger'><i class='fa fa-table'></i></a><a href='" . route('dokter.fisik', $data->id) . "' class='btn btn-warning text-light'><i class='fa fa-user'></i></a></div>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function AjaxPasienPost(Request $request)
    {
        return response()->json($request);
    }

    public function odontogram(Customer $customer)
    {
        $ketodonto = KetOdontogram::where('customer_id', $customer->id)->first();
        $riwayat = RekamMedis::with('simbol')->where('customer_id', $customer->id)->get();

        return view('dokter.pasien.odontogram', compact('customer', 'ketodonto', 'riwayat'));
    }

    public function cekfisik(Customer $customer)
    {
        return view('dokter.pasien.cekfisik', compact('customer'));
    }

    public function storefisik(Request $request, Customer $customer)
    {
        $customer->fisik()->update($request->except('_token'));
        return redirect()->route('dokter.pasien.cekfisik', $customer->id)->with('success', 'Pemeriksaan berhasil');
    }

    public function cetakodontogram(Customer $customer)
    {
        return view('dokter.pasien.cetakodonto', compact('customer'));
    }

    public function cetakriwayat(Customer $customer)
    {
        $riwayat = RekamMedis::where('customer_id', $customer->id)->get();
        return view('dokter.pasien.cetakriwayat', compact('customer', 'riwayat'));
    }

    public function simbol($warna)
    {
        $simbol =  SimbolOdontogram::where('warna', $warna)->first();

        return response()->json([
            'warna' => $simbol->warna,
            'nama' => $simbol->nama_simbol,
            'singkatan' => $simbol->singkatan,
        ], 200);
    }

    public function history($id)
    {
        $customer = Customer::findOrFail($id);
        $riwayat = RekamMedis::with('simbol')->where('customer_id', $customer->id)->get();
        return view('dokter.pasien.history', compact('riwayat', 'customer'));
    }
    public function fisik($id)
    {
        $fisik = Fisik::where('customer_id', $id)->get();
        return view('dokter.pasien.fisik', compact('fisik'));
    }
}
