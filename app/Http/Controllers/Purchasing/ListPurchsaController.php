<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Project;
use App\Purchase;
use Carbon\Carbon;

class ListPurchsaController extends Controller
{
    public function index(Request $request)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $purchases = DB::table('purchases')
            ->leftJoin('tukar_fakturs','purchases.invoice','=','tukar_fakturs..no_po_vendor')
            ->leftJoin('users','purchases.user_id','=','users.id')
            ->select('purchases.id','users.name','purchases.invoice','purchases.created_at','purchases.grand_total','tukar_fakturs.nilai_invoice','tukar_fakturs.no_po_vendor')
            ->groupBy('purchases.invoice')
            ->whereBetween('purchases.created_at', [$from, $to])
            ->orderBy('purchases.id','desc')->get();
            
        } else {
            $purchases = DB::table('purchases')
            ->leftJoin('tukar_fakturs','purchases.invoice','=','tukar_fakturs..no_po_vendor')
            ->leftJoin('users','purchases.user_id','=','users.id')
            ->select('tukar_fakturs.status_pembayaran','purchases.id','users.name','purchases.invoice','purchases.created_at','purchases.grand_total','tukar_fakturs.nilai_invoice','tukar_fakturs.no_po_vendor')
            ->groupBy('purchases.invoice')
            ->orderBy('purchases.id','desc')->get();
        }
        
        // $purchases = Purchase::groupBy('invoice')
        // ->orderBy('id','desc')->get();
        return view('purchasing.listpurchase.index', compact('purchases'));
    }

    public function show($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        return view('purchasing.listpurchase.show', compact('purchase'));
    }
}
