<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\{Cabang, Barang, HargaProdukCabang, Ruangan};

class CabangController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('cabang-access'), 403);

        $cabangs = Cabang::get();
        return view('admin.cabang.index', compact('cabangs'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('cabang-create'), 403);

        $cabang = new Cabang();

        return view('admin.cabang.create', compact('cabang'));
    }

    public function store(StoreWarehouseRequest $request)
    {
        abort_unless(\Gate::allows('cabang-create'), 403);

        $request['is_active'] = 1;
        $request['status_pajak'] = request('pajak');
        $request['ppn'] = request('ppn');
        Cabang::create($request->all());

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang has been added');
    }

    public function show(Cabang $cabang)
    {
        $products = HargaProdukCabang::with('cabang', 'product')->where('cabang_id', $cabang->id)->whereHas('product', function ($query) {
            return $query->where('jenis', 'barang');
        })->get();

        $services = HargaProdukCabang::with('cabang', 'product')->where('cabang_id', $cabang->id)->whereHas('product', function ($query) {
            return $query->where('jenis', 'service');
        })->get();

        return view('admin.cabang.show', compact('cabang', 'products', 'services'));
    }

    public function edit(Cabang $cabang)
    {
        abort_unless(\Gate::allows('cabang-edit'), 403);

        return view('admin.cabang.edit', compact('cabang'));
    }

    public function update(UpdateWarehouseRequest $request, Cabang $cabang)
    {
        abort_unless(\Gate::allows('cabang-edit'), 403);

        $request['status_pajak'] = request('pajak');
        $request['ppn'] = request('ppn');

        $cabang->update($request->all());

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang has been updated');
    }

    public function destroy(Cabang $cabang)
    {
        abort_unless(\Gate::allows('cabang-delete'), 403);

        $cabang->delete();

        return redirect()->route('admin.cabang.index')->with('success', 'Cabang has been deleted');
    }

    public function ruangan(Cabang $cabang)
    {
        $ruangan = Ruangan::with('cabang')->where('cabang_id', $cabang->id)->get();
        return view('admin.cabang.ruangan', compact('cabang', 'ruangan'));
    }
}
