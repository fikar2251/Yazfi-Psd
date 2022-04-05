<?php

namespace App\Http\Controllers\Logistik;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\{InOut};
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $barangs = [];
        $from = '';
        $to = '';

        if (request('from') && request('to')) {

            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');

            $barangs = InOut::whereBetween('created_at', [$from, $to])->where('user_id',auth()->user()->id)->get();
        } else {
            $barangs = InOut::where('user_id',auth()->user()->id)->get();
        }

        return view('logistik.product.index', compact('barangs', 'from', 'to'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $projects = DB::table('projects')
            ->where('nama_project', 'like', "%" . $cari . "%")
            ->paginate();
        return view('logistik.product.index', ['projects' => $projects]);
    }
    public function show(Barang $product)
    {
        return view('logistik.product.show', compact('product'));
    }


}
