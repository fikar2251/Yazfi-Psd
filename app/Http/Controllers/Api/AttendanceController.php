<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jadwal;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function GetDetailOfAttendance($id)
    {
        $resource = Jadwal::findOrFail($id);
        return response()->json($resource);
    }
}
