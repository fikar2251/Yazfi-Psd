<?php

namespace App\Http\Controllers\Marketing;

use App\Barang;
use App\Booking;
use App\Cabang;
use App\Customer;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\User;
use Carbon\Carbon;
use Exception;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    public function GetCabang()
    {
        try {
            $response = [
                'message' => 'success',
                'resource' => Cabang::get()
            ];
            return response()->json($response);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
    public function GetBook($id, $dokter_id)
    {
        try {
            $jadwal = Jadwal::join('users', 'users.id', '=', 'jadwals.user_id')
                ->join('shifts', 'shifts.id', '=', 'jadwals.shift_id')
                ->join('cabangs', 'cabangs.id', '=', 'jadwals.cabang_id')
                ->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')
                ->where('jadwals.id', $id)
                ->first();
            $pasien = Customer::where('cabang_id', auth()->user()->cabang_id)->get();
            $dokter = User::findOrFail($dokter_id);
            $count = Jadwal::findOrFail($id)->booking->count();
            if ($count == 0) {
                $booking = Jadwal::findOrFail($id)->shift->waktu_mulai;
            } else {
                $booking = Jadwal::findOrFail($id)->booking->last()->jam_selesai;
            }
            $response = [
                'jadwal' => $jadwal,
                'pasien' => $pasien,
                'dokter' => $dokter,
                'booking' => $booking
            ];
            return response()->json($response);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }

    public function GetBookNow($id, $dokter_id)
    {
        $jadwal = Jadwal::join('users', 'users.id', '=', 'jadwals.user_id')
            ->join('shifts', 'shifts.id', '=', 'jadwals.shift_id')
            ->join('cabangs', 'cabangs.id', '=', 'jadwals.cabang_id')
            ->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')
            ->where('jadwals.id', $id)
            ->first();
        $count = Jadwal::findOrFail($id)->booking->count();

        if ($count == 0) {
            $current = Carbon::now()->format('H:i:s');
            $booking = Jadwal::find($id)->shift->waktu_mulai;
            if ($booking < $current) {
                $booking = $current;
            } else {
                $booking = $booking;
            }
        } else {
            $booking = Jadwal::findOrFail($id)->booking->last()->jam_selesai;
            $current = Carbon::now()->format('H:i:s');
            if ($booking < $current) {
                $booking = $current;
            } else {
                $booking = $booking;
            }
        }
        $pasien = Customer::where('cabang_id', auth()->user()->cabang_id)->get();
        $dokter = User::findOrFail($dokter_id);
        $response = [
            'jadwal' => $jadwal,
            'pasien' => $pasien,
            'dokter' => $dokter,
            'booking' => $booking
        ];
        return response()->json($response);
    }
    public function GetCustomer($id)
    {
        try {
            $user = Customer::findOrFail($id);
            return response()->json($user);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
    public function GetTime($jadwal_id, $minutes, $waktu_mulai)
    {
        try {
            if ($minutes == 0) {
                return response()->json($waktu_mulai);
            }
            $jadwal = Jadwal::findOrFail($jadwal_id);

            $waktu_mulai = Carbon::parse($waktu_mulai)->format('H:i:s');
            $waktu_selesai = Carbon::parse($waktu_mulai)->addMinutes($minutes)->format('H:i:s');
            $waktu_batas = Carbon::parse($jadwal->shift->waktu_selesai)->subMinutes(20)->format('H:i:s');

            if ($waktu_selesai >= $waktu_batas) {
                return response()->json('Waktu Melebihi Waktu Shift');
            }
            return response()->json($waktu_selesai);
            // $count = Jadwal::findOrFail($jadwal_id)->booking->count();
            // if ($count == 0) {
            //     $booking = Jadwal::findOrFail($jadwal_id)->shift->waktu_mulai;
            //     if (Jadwal::findOrFail($jadwal_id)->tanggal == Carbon::now()->format('Y-m-d')) {
            //         $time = Carbon::parse($waktu_mulai)->addMinutes($minutes)->format('H:i:s');
            //         $jadwal = Jadwal::findOrFail($jadwal_id);
            //         if ($time >= Carbon::parse($jadwal->shift->waktu_selesai)->subMinutes(20)->format('H:i:s')) {
            //             return response()->json("time exceeds the doctor's shift limit");
            //         } else {
            //             return response()->json($time);
            //         }
            //         return response()->json($time);
            //     }
            // } else {
            //     $booking = Jadwal::findOrFail($jadwal_id)->booking->last()->jam_selesai;
            // }

            // $jadwal = Jadwal::findOrFail($jadwal_id);

            // $time = Carbon::parse($booking)->addMinute($minutes)->format('H:i:s');

            // if ($time >= Carbon::parse($jadwal->shift->waktu_selesai)->subMinutes(20)->format('H:i:s')) {
            //     return response()->json("time exceeds the doctor's shift limit");
            // } else {
            //     return response()->json($time);
            // }


        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }
    public function GetProduct($id)
    {
        try {
            $product = HargaProdukCabang::join('barangs', 'barangs.id', '=', 'harga_produk_cabangs.barang_id')
                ->where('harga_produk_cabangs.id', $id)->first();
            return response()->json($product);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
    public function GetProducts()
    {
        try {
            $products = HargaProdukCabang::join('barangs', 'barangs.id', '=', 'harga_produk_cabangs.barang_id')
                ->join('cabangs', 'cabangs.id', '=', 'harga_produk_cabangs.cabang_id')
                ->select(['cabangs.*', 'harga_produk_cabangs.id as unique', 'barangs.*'])
                ->where('cabang_id', auth()->user()->cabang_id)
                ->get();
            return response()->json($products);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
    public function WhereCustomer(Request $request)
    {
        $data = [];
        $pasien = Customer::where('nama', 'like', '%' . $request->q . '%')->orWhere('nik_ktp', 'like', '%' . $request->q . '%')->get();
        foreach ($pasien as $row) {
            $data[] = ['id' => $row->id, 'text' => $row->nama . '-' . $row->nik_ktp];
        }
        return response()->json($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  HargaProdukCabang::join('barangs', 'barangs.id', '=', 'harga_produk_cabangs.barang_id')
            ->join('cabangs', 'cabangs.id', '=', 'harga_produk_cabangs.cabang_id')
            ->select(['cabangs.*', 'harga_produk_cabangs.id as unique', 'barangs.*'])
            ->where('cabang_id', auth()->user()->cabang_id)
            ->where('barangs.nama_barang', 'like', '%' . $request->q . '%')
            ->orderBy('barangs.nama_barang', 'asc')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->unique, 'text' => $row->nama_barang];
        }
        return response()->json($data);
    }
    public function DataTableAppointment()
    {
        $resource = Booking::where('cabang_id', auth()->user()->cabang_id)->get();
        dd($resource);
        return datatables()
            ->of($resource)
            ->editColumn('action', function ($row) {
                return '<a href="" class="btn btn-primary">Edit</a>';
            })
            ->make(true);
    }
}
