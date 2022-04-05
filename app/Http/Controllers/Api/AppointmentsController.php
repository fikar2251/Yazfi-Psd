<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function UpdateAppointmentsFromHRD($id_booking, $dokter_pengganti_id)
    {
        if($dokter_pengganti_id == 'null'){
            Booking::findOrFail($id_booking)->update([
                'dokter_pengganti_id' => null,
                'tanggal_pengganti'=> null
            ]);
        }else{
            Booking::findOrFail($id_booking)->update([
                'dokter_pengganti_id' => $dokter_pengganti_id,
                'tanggal_pengganti' => Carbon::now()->format('Y-m-d')
            ]);
        }
        return response()->json('success');
    }
}
