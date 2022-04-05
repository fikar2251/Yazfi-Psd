<?php

namespace App\Http\Controllers\Logistik;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(Purchase $purchase)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $purchases = Purchase::groupBy('invoice')->whereBetween('created_at', [$from, $to])->get();
        } else {
            $purchases = Purchase::where('user_id', Auth::user()->id)
            ->orderBy('id','desc')
            ->groupBy('invoice')->get();


          

            // $sum = Purchase::where('user_id', Auth::user()->id)
            // ->where('invoice',$purchase->invoice)
            // ->groupBy('invoice')->first();
            // dd($sum);
        }


        return view('logistik.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $purchase = new Purchase();
        $suppliers = Supplier::get();
        $project = Project::get();
        $unit =  DB::table('units')
        ->get();
         
        $barangs = Barang::where('id_jenis', '1')->get();
        $AWAL = 'PO';
        $noUrutAkhir = \App\Purchase::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        return view('logistik.purchase.create', compact('purchase','unit', 'suppliers', 'barangs', 'project', 'nourut'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'invoice' => 'required',
        ]);

        $barang = $request->input('barang_id', []);
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'lokasi' => $request->lokasi,
                'project_id' => $request->project_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'unit' => $request->unit[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'grand_total' => $request->grandtotal,
                'status_barang' => 'pending'
            ];

            // $hargaBarang = HargaProdukCabang::where('project_id', auth()->user()->project_id)->where('barang_id', $no)->first();

            // $hargaBarang->update([
            //     'qty' => $hargaBarang->qty + $request->qty[$key]
            // ]);

            $in[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'project_id' => $request->project_id,
                'in' => $request->qty[$key],
                'user_id' => auth()->user()->id
            ];
        }

        Purchase::insert($attr);
        InOut::insert($in);

        DB::commit();

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang berhasil');
    }

    public function show(Purchase $purchase)
    {
        $purchase = Purchase::where('invoice', $purchase->invoice)->first();
        $inout = InOut::where('invoice', $purchase->invoice)->first();
        // dd($inout);

        return view('logistik.purchase.show', compact('purchase','inout'));
    }

    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $suppliers = Supplier::get();
        $project = Project::get();
        $barangs = Barang::where('id_jenis', '1')->get();

        return view('logistik.purchase.edit', compact('project', 'purchase', 'suppliers', 'barangs', 'purchases'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'invoice' => 'required',
        ]);
        $barang = $request->input('barang_id', []);
        // dd("ok");
        // dd($purchases);
        // DB::beginTransaction();
        foreach ($barang as $key => $no) {

            $purchase = Purchase::where('id', $purchase->id)->where('barang_id', $no)->first();
            // dd($purchase);
            $purchase->update([
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'unit' => $request->unit[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'grand_total' => $request->grandtotal,
                'status_barang' => 'pending'
            ]);
     
            $inout = Purchase::where('id', $purchase->id)->where('barang_id', $no)->first();
            $inout->update([
                'invoice' => $request->invoice,
                    'supplier_id' => $request->supplier_id,
                    'barang_id' => $no,
                    'project_id' => $request->project_id,
                    'in' => $request->qty[$key],
                    'user_id' => auth()->user()->id
            ]);
        
        }

   

        return redirect()->route('logistik.purchase.index')->with('success', 'Edit Purchase barang berhasil');
    }

    public function destroy($id)
    {
        $purchases = Purchase::where('id', $id)->get();

        foreach ($purchases as $pur) {
            InOut::where('invoice', $pur->invoice)->delete();
            PenerimaanBarang::where('no_po', $pur->invoice)->delete();
            // $harga = HargaProdukCabang::where('barang_id', $pur->barang_id)->where('project_id', auth()->user()->project_id)->first();

            // // $harga->update([
            // //     'qty' => $harga->qty - $pur->qty
            // // ]);
            $pur->delete();
        }

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang didelete');
    }

    public function whereProject(Request $request)
    {
        $data = DB::table('projects')
            ->select('projects.alamat_project')
            ->groupBy('projects.alamat_project')
            ->where('projects.id', $request->id)->get();
        return $data;
        dd($data);
    }
    public function WhereProduct(Request $request)
    {
   
        $data = [];
        $product =  Barang::where('id_jenis', 'barang')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return response()->json($data);
    }
    public function WhereUnit(Request $request)
    {
        $data = [];
        $unit =  DB::table('units')
            ->where('nama', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($unit as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama];
        }

        return response()->json($data);
    }	
    public function pdf($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        return view('logistik.purchase.pdf',compact('purchase'));
    }
}
