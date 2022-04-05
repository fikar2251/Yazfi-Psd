<?php

namespace App\Http\Controllers\Marketing;

use App\{Barang, Booking, Customer, Holidays, InOut, Jadwal, Tindakan, User};
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Session;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('marketing.appointments.index');
    }

    public function ajax()
    {
        $appointments = Booking::with('pasien', 'dokter', 'cabang')->where('cabang_id', auth()->user()->cabang_id)->get();

        return datatables()
            ->of($appointments)
            ->editColumn('no_booking', function ($appointment) {
                return '<a href="' . route('marketing.appointments.show', $appointment->id) . '"><span class="badge badge-success">' . $appointment->no_booking . '</span></a>';
            })
            ->editColumn('pasien', function ($appointment) {
                return $appointment->pasien->nama;
            })
            ->editColumn('dokter', function ($appointment) {
                return $appointment->dokter->name;
            })
            ->editColumn('umur', function ($appointment) {
                return Carbon::now()->format('Y') - Carbon::parse($appointment->pasien->tgl_lahir)->format('Y');
            })
            ->editColumn('cabang', function ($appointment) {
                return $appointment->cabang->nama;
            })
            ->editColumn('tgl_status', function ($appointment) {
                return Carbon::parse($appointment->tgl_status)->format('d/m/Y');
            })
            ->editColumn('waktu', function ($appointment) {
                return Carbon::parse($appointment->jam_status)->format('H:i') . ' - ' . Carbon::parse($appointment->jam_selesai)->format('H:i');
            })
            ->editColumn('kedatangan', function ($appointment) {
                return '<span class="custom-badge status-' . $appointment->kedatangan->warna . '">' . $appointment->kedatangan->status . '</span>';
            })
            ->editColumn('tindakan', function ($data) {
                $tindakan = Tindakan::where('booking_id', $data->id)->where('status', 0)->count();
                if ($tindakan > 0) {
                    return '<span class="custom-badge status-red d-flex justify-content-between">
                    Belum
                    <span>' . $tindakan . '</span>
                </span>';
                } else {
                    return '<span class="custom-badge status-green">
                    Selesai
                </span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['no_booking', 'kedatangan', 'tindakan'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "no_booking" => "required",
            "date_booking" => "required",
            "customer_id" => "required",
            "tanggal_status" => "required",
            "jadwal_id" => "required",
            "_token" => "required",
            "_method" => "required",
            "dokter_id" => "required",
            "barang_id.*" => 'required',
            "item.*" => 'required',
            "price.*" => 'required',
            "time.*" => 'required',
            "type.*" => 'required',
            "quantity.*" => 'required',
            "total.*" => 'required',
            "waktu_mulai" => "required",
            "waktu_selesai" => "required"
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard')->with('error', $validator->getMessageBag());
        }
        $form = $request->except(['_token', '_method', 'table-show_length']);
        $form['barang_id'] = array_values($request->barang_id);
        $form['item'] = array_values($request->item);
        $form['price'] = array_values($request->price);
        $form['time'] = array_values($request->time);
        $form['duration'] = array_values($request->duration);
        $form['type'] = array_values($request->type);
        $form['quantity'] = array_values($request->quantity);
        $form['total'] = array_values($request->total);
        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'no_booking' => $form['no_booking'],
                'marketing_id' => auth()->user()->id,
                'dokter_id' => $form['dokter_id'],
                'resepsionis_id' => 0,
                'ob_id' => 0,
                'perawat_id' => 0,
                'cabang_id' => auth()->user()->cabang->id,
                'customer_id' => $form['customer_id'],
                'jadwal_id' => $form['jadwal_id'],
                'status_pembayaran' => 0,
                'tanggal_status' => $form['tanggal_status'],
                'jam_status' => $form['waktu_mulai'],
                'jam_selesai' => $form['waktu_selesai'],
                'status_kedatangan_id' => 1,
                'is_active' => 1
            ]);
            for ($i = 0; $i < count($form['barang_id']); $i++) {
                $barang = Barang::findOrFail($form['barang_id'][$i]);
                if ($barang->type) {
                    $wtf = Booking::where('customer_id', $form['customer_id'])->get();
                    foreach ($wtf as $row) {
                        foreach ($row->tindakan as $data) {
                            if ($data->item->type) {
                                if ($data->booking->dokter->is_active == 1) {
                                    if ($data->booking->dokter->name != User::find($form['dokter_id'])->name) {
                                        DB::rollBack();
                                        return redirect('/dashboard')->with('error', 'Tidak bisa booking karena service bertype lanjutan, harus dokter yang sama!');
                                    }
                                }
                            }
                        }
                    }
                }
                Tindakan::create([
                    'booking_id' => $booking->id,
                    'tindakan_id' => $barang->id,
                    'durasi' => $form['time'][$i],
                    'qty' => $form['quantity'][$i],
                    'dokter_id' => $form['dokter_id'],
                    'nominal' => $form['total'][$i],
                    'status' => 0
                ]);

                if ($barang->jenis == 'barang') {
                    InOut::create([
                        'barang_id' => $barang->id,
                        'customer_id' => $booking->customer_id,
                        'user_id' => auth()->user()->id,
                        'out' => $form['quantity'][$i]
                    ]);
                }
            }
            DB::commit();
            return redirect('/dashboard')->with('success', 'Booking Berhasil!');
        } catch (Exception $err) {
            DB::rollBack();
            return redirect('/dashboard')->with('error', 'Booking Gagal : ' . $err->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('marketing.appointments.show', [
            'booking' => Booking::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
