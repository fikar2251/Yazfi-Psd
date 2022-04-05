<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product-access'), 403);

        $products = Barang::where('jenis', 'barang')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $barang = new Barang();
        return view('admin.product.create', compact('barang'));
    }

    public function store(StoreBarangRequest $request)
    {
        abort_unless(\Gate::allows('product-create'), 403);

        $request['jenis'] = 'barang';

        $barang =  Barang::create($request->all());

        $cabangs = Cabang::get();

        foreach ($cabangs as $cabang) {
            HargaProdukCabang::create([
                'barang_id' => $barang->id,
                'cabang_id' => $cabang->id,
                'harga' => request('harga'),
                'qty' => 0
            ]);
        }
        return redirect()->route('admin.product.index')->with('success', 'Product has been added');
    }

    public function show(Barang $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Barang $product)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        return view('admin.product.edit', compact('product'));
    }

    public function update(UpdateBarangRequest $request, Barang $product)
    {
        abort_unless(\Gate::allows('product-edit'), 403);

        $product->update($request->all());

        return redirect()->route('admin.product.index')->with('success', 'Product has been updated');
    }

    public function destroy(Barang $product)
    {
        abort_unless(\Gate::allows('product-delete'), 403);

        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product has been deleted');
    }
}
