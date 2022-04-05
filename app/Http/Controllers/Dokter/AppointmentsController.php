<?php

namespace App\Http\Controllers\Dokter;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Booking::where('cabang_id', auth()->user()->cabang_id)->where('dokter_id', auth()->user()->id)->orderBy('tanggal_status', 'desc')->get();
        // $appointments = Booking::where('cabang_id', auth()->user()->cabang_id)->orderBy('tanggal_status', 'desc')->get();
        $count = Booking::where('cabang_id', auth()->user()->cabang_id)->where('dokter_pengganti_id', auth()->user()->id)->get()->count();

        return view('dokter.appointments.index', [
            'appointments' => $appointments,
            'count' => $count
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $customer = $booking->pasien;
        return view('dokter.appointments.show', [
            'customer' => $customer,
            'booking' => $booking
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
        $appointments = Booking::where('cabang_id', auth()->user()->cabang_id)->where('dokter_pengganti_id', $id)->orderBy('tanggal_status', 'desc')->get();
        // $appointments = Booking::where('cabang_id', auth()->user()->cabang_id)->orderBy('tanggal_status', 'desc')->get();

        return view('dokter.appointments.edit', [
            'appointments' => $appointments
        ]);
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
        //
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
