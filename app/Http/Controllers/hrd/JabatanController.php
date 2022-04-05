<?php

namespace App\Http\Controllers\hrd;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Jabatan;
use App\Perusahaan;
use Carbon\Carbon;
use App\Http\Requests\{StoreJabatanRequest, UpdateJabatanRequest};
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    public function index()
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');

            $jabatan = Jabatan::groupBy('nama')->whereBetween('created_at', [$from, $to])->get();
        } else {
            $jabatan = Jabatan::groupBy('nama')->get();
        }

        return view('hrd.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        $jabatan = new Jabatan();
        $perusahaans = Perusahaan::get();
        return view('hrd.jabatan.create', compact('jabatan', 'perusahaans'));
    }

    public function store(StoreJabatanRequest $request)
    {
   
        $jabatan = Jabatan::create($request->all());
        return redirect()->route('hrd.jabatan.index')->with('success', 'Nama Jabatan has been added');
    }

    public function edit($id)
    {
         $jabatan = Jabatan::findOrFail($id);
        $perusahaans = Perusahaan::get();
        return view('hrd.jabatan.edit', compact('jabatan','perusahaans'));
    }

    public function update(UpdateJabatanRequest $request, $id)
    {

         Jabatan::find($id)->update($request->all());
        return redirect()->route('hrd.jabatan.index')->with('success', 'Nama Jabatan has been updated');
    }

    public function destroy(Jabatan $jabatan)
    {
       $jabatan->delete();
        return redirect()->route('hrd.jabatan.index')->with('success', 'Nama Jabatan has been deleted');
    }

   
}
