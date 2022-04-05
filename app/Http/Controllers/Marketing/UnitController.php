<?php

namespace App\Http\Controllers\Marketing;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Marketing;
use App\Shift;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok = Marketing::all();
        return view('marketing.unit.index', compact('stok'));
    }

    public function json()
    {
        // $stok = Marketing::where('status_penjualan', 'Available')->get();
        $stok = Marketing::all();

        return DataTables::of($stok)
                ->editColumn('harga_jual', function($stok){
                    $raw = $stok->harga_jual;
                    $cnv = (int)$raw;
                    $hj = $cnv * 1000000;
                    return $hj;
                })
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
        // return view('marketing.doctor.show', [
        //     'doctor' => User::findOrFail($id),
        //     'booking' => Booking::where('dokter_id', $id)->get(),
        //     'shift' => Shift::get(),
        //     'attendance' => Jadwal::where('user_id', $id)->whereMonth('tanggal', Carbon::now()->format('m'))->whereYear('tanggal', Carbon::now()->format('Y'))->get()
        // ]);
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
