<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenerimaanRequest;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use App\TukarFaktur;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenerimaanBarangController extends Controller
{
    public function index(PenerimaanBarang $penerimaan, Request $request)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $penerimaans = PenerimaanBarang::groupBy('no_penerimaan_barang')->whereBetween('tanggal_penerimaan', [$from, $to])->where('id_user',auth()->user()->id)->get();
            $status = PenerimaanBarang::where('status_tukar_faktur', 'completed')->get();
        } else {
            $penerimaans = PenerimaanBarang::groupBy('no_penerimaan_barang')
            ->where('id_user',auth()->user()->id)
            ->orderBy('tanggal_penerimaan', 'desc')->get();

            $total = PenerimaanBarang::groupBy('no_penerimaan_barang')
            ->where('id_user',auth()->user()->id)
            ->orderBy('tanggal_penerimaan', 'desc')->first();

            // $total_all = PenerimaanBarang::where('id_user',auth()->user()->id)->groupBy('no_penerimaan_barang')->get()->sum('grandtotal');
            // dd($total_all);
            $status = PenerimaanBarang::where('status_tukar_faktur', 'completed')->where('id', $penerimaan->id)->first();
            // dd($status);
            
        }

        return view('purchasing.penerimaan-barang.index', compact('penerimaans','total','status'));
    }
    public function show($id)
    {

        
        $penerimaan = PenerimaanBarang::where('id', $id)->first();
  
        // $purchase = DB::table('penerimaan_barangs')
        // ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        // ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        // ->leftJoin('projects','purchases.project_id','=','projects.id')
        // ->select('penerimaan_barangs.grandtotal','penerimaan_barangs.ppn','purchases.unit','penerimaan_barangs.no_penerimaan_barang','penerimaan_barangs.id')
        // ->where('penerimaan_barangs.id',$id)
        // ->first();


        // $purchase = PenerimaanBarang::where('no_penerimaan_barang', $purchases->no_penerimaan_barang)->first();
        // dd($purchase);
 
        return view('purchasing.penerimaan-barang.show', compact('penerimaan'));
    }
    public function search(Request $request)
    {
        $data = [];
        $tukar = Purchase::select(
            "id"
            // "invoice",
            // "grand_total",
            // "supplier_id",
            // "status_barang",
            // "total",
            // "harga_beli",
            // "created_at",
            // "project_id",
            // "lokasi",
            // "barang_id",
            // "qty",
            // "PPN"
        )->where('status_barang', 'pending')->where('invoice', $request->invoice)->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'id' => $value->id,
                    // 'project_id' => $value->project->nama_project,
                    // 'lokasi' => $value->lokasi,
                    // 'created_at' => $value->created_at,
                    // 'supplier_id' => $value->supplier->nama,
              
                ];
            }
        }
        return $data;
    }
    public function create(Purchase $penerimaan,Request $request)
    {
        // $tukar = Purchase::where('status_barang', 'pending')->where('invoice', $purchase->invoice)->get();

      
        $purchases = Purchase::where('status_barang', 'pending')->where('invoice',$request->invoice)->get();

        $gudang = PenerimaanBarang::where('no_po', $request->invoice)->first();


        $penerimaan = DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('barangs','barangs.id','=','penerimaan_barangs.barang_id')
        ->leftJoin('users','users.id','=','purchases.user_id')
        ->select('purchases.id','purchases.PPN','users.name','purchases.total','purchases.harga_beli','purchases.status_barang','barangs.nama_barang','penerimaan_barangs.qty_partial','penerimaan_barangs.qty_received','purchases.qty','purchases.barang_id','penerimaan_barangs.barang_id')
        ->where('purchases.status_barang', 'partial')
        ->where('purchases.invoice',$request->invoice)
        ->get();
        // dd($penerimaan);
        $warehouses = Warehouse::get();


        $inout = InOut::where('invoice',$request->invoice)->get();
        // dd($inout);

        $status_barang = PenerimaanBarang::where('no_po',$request->invoice)->first();
        // dd( $status_barang );
        $ppn = Purchase::where('status_barang', 'pending')->where('invoice',$request->invoice)->first();
        $ppn_partial= Purchase::where('status_barang', 'partial')->where('invoice',$request->invoice)->first();

        $AWAL = 'PN';
        $noUrutAkhir = \App\PenerimaanBarang::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        
        $purchase = Purchase::groupBy('invoice')->where('status_barang','!=','completed')->get();
        
      
      
        // dd($tukar);
        return view('purchasing.penerimaan-barang.create', compact('ppn', 'purchases', 'purchase','nourut','status_barang','inout','penerimaan','gudang','ppn_partial','warehouses'));
    
    }


    public function store(StorePenerimaanRequest $request)
    {
        $request->validate([
            'id_user' => 'required',
            'no_penerimaan_barang' => 'required',
            'tanggal_penerimaan' => 'required',
            'harga_beli' => 'required',
            'total' => 'required',
            'qty_received' => 'required',
        ]);

        $barang = $request->input('barang_id', []);
        // dd($barang);
    
        $attr = [];
  
      
        DB::beginTransaction();
        $status_barang = Purchase::where('status_barang', 'pending')->where('barang_id', $request->barang_id)->first();
        // dd($status_barang);
      
        if ($status_barang == 'pending') {
            return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Penerimaan barang berhasil');
        }else{

        foreach ($barang as $key => $no) {
            // $purchases = Purchase::select('id')->where('invoice',$request->no_po)->get();
            // dd($purchases);
         
            $attr []= [
                'id_user' => $request->id_user,
                'no_po' => $request->no_po,
                'no_penerimaan_barang' => $request->no_penerimaan_barang,
                'barang_id' => $no,
                'id_purchase' => $request->id_purchase[$key],
                'qty' => $request->qty[$key],
                'qty_partial' => $request->qty_partial[$key],
                'qty_received' => $request->qty_received[$key],
                'harga_beli' => $request->harga_beli[$key],
                'total' => $request->total,
                'tanggal_penerimaan' => $request->tanggal_penerimaan,
                'status_tukar_faktur' => 'pending',
                'ppn' => $request->ppn,
                'grandtotal' => $request->grandtotal
            ];
                // dd($attr);
           
                DB::table('purchases')->where('id', $request->id_purchase[$key])->update(array( 
                'status_barang' => $request->status_barang[$key],
                'id_warehouse' => $request->id_warehouse
            ));

            // dd($request->all());
        }
        
        PenerimaanBarang::insert($attr);
        DB::commit();

         return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Penerimaan barang berhasil');

        }
    }


    public function edit($id,Purchase $purchase,Request $request )
    {
        
        $penerimaans = PenerimaanBarang::where('id', $id)->get();

         
        $purchase = DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        ->leftJoin('projects','purchases.project_id','=','projects.id')
        ->select('penerimaan_barangs.id','suppliers.nama','purchases.created_at','purchases.lokasi','projects.nama_project')
        ->first();
        // dd($purchase);
        
        $AWAL = 'PN';
        $noUrutAkhir = \App\PenerimaanBarang::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        
        // $purchase = Purchase::groupBy('invoice')->get();
        return view('purchasing.penerimaan-barang.edit', compact('nourut', 'purchase','penerimaan','penerimaans'));
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
        $attr = [];
        // $in = [];
        $id = [];
        $purchases = Purchase::where('invoice', $purchase->invoice)->pluck('id');
        dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr []= [
                'id_user' => $request->id_user,
                'id_purchase' => $request->id_purchase,
                'no_penerimaan_barang' => $request->no_penerimaan_barang,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'qty_received' => $request->qty_received[$key],
                'harga_beli' => $request->harga_beli[$key],
                'total' => $request->total,
                'tanggal_penerimaan' => $request->tanggal_penerimaan,
            ];
        //   dd($attr);

            $purchases = Purchase::where('id', $request->id_purchase)->where('barang_id', $no)->first();
            // dd($purchases);
            $purchases->update([
                'qty' => $request->qty[$key],
                // 'harga_beli' =>$request->harga_beli[$key],
                // 'total' => $request->harga_beli[$key] * $request->qty[$key],
                'status_barang' => $request->status_barang[$key]
            ]);
            $id[] = $purchases[$key];
            // dd($attr);
           
        }
        PenerimaanBarang::updateOrInsert([
            'id' => $id
        ], $attr);
        DB::commit();
       
        return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Update Penerimaan barang berhasil');
    }

    public function hapus( $id)
    {
        // $post = PenerimaanBarang::findOrFail($id);
        // $purchase = Purchase::where('id', $post)->first();
        $penerimaans = PenerimaanBarang::where('id', $id)->get();
        // dd($penerimaans);
        foreach ($penerimaans as $pur) {
            
           
            // dd($purchase);
         
        
            // dd($purchase);
            DB::table('purchases')->whereIn('invoice', $pur)->update(array( 
         
            'status_barang' => 'pending',
            'id_warehouse' => 0));
        
            PenerimaanBarang::where('no_po', $pur->no_po)->delete();
        }
            
        return redirect()->route('purchasing.penerimaan-barang.index')->with('success', 'Penerimaan Barang barang didelete');
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
        $product =  Barang::where('jenis', 'barang_id')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return redirect()->route('logistik.purchase.index')->with('success', 'Purchase barang didelete');
    }
}
