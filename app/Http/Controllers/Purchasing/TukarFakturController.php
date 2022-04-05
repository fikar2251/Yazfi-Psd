<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\DetailTukarFaktur;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use App\TukarFaktur;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class TukarFakturController extends Controller
{
    public function index(Request $request)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $tukar = DB::table('tukar_fakturs')
            ->whereBetween('tanggal_tukar_faktur', [$from, $to])
            ->where('id_user',auth()->user()->id)
            ->groupBy('tukar_fakturs.no_faktur')
            ->orderBy('tukar_fakturs.id','desc')
            ->get();    

            
            // $tukar = DB::TukarFaktur::groupBy('no_faktur')->whereBetween('tanggal_tukar_faktur', [$from, $to])->where('id_user',auth()->user()->id)->get();
            // dd($purchases);
        } else {

            $tukar = DB::table('tukar_fakturs')
            ->where('id_user',auth()->user()->id)
            ->groupBy('tukar_fakturs.no_faktur')
            ->orderBy('tukar_fakturs.id','desc')
            ->get();    

           
            // dd($status);
            
            $tukars = TukarFaktur::groupBy('no_faktur')->where('no_faktur',$request->no_faktur)
            ->where('id_user',auth()->user()->id)->get();
                
        }
        // dd($tukars);
        return view('purchasing.tukarfaktur.index', compact('tukar','tukars'));
    }
    

    public function create(Request $request)
    {
        $purchasing = DB::table('dokumen_tukar_faktur')->get();
        
        // $purchases = DB::table('penerimaan_barangs')
        // ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        // ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        // ->leftJoin('barangs','penerimaan_barangs.barang_id','=','barangs.id')
        // ->leftJoin('users','users.id','=','penerimaan_barangs.id_user')
        // ->select('penerimaan_barangs.ppn','purchases.status_pembayaran','penerimaan_barangs.status_tukar_faktur','purchases.status_barang','purchases.project_id','purchases.invoice','penerimaan_barangs.total','penerimaan_barangs.id','purchases.supplier_id','barangs.nama_barang','penerimaan_barangs.id_purchase','penerimaan_barangs.qty',
        // 'penerimaan_barangs.harga_beli','penerimaan_barangs.barang_id','penerimaan_barangs.qty_received','users.name','suppliers.nama','penerimaan_barangs.no_penerimaan_barang')
        // ->where('penerimaan_barangs.status_tukar_faktur','pending')
        // ->get();

       $purchases = DB::table('penerimaan_barangs')
       ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
       ->leftJoin('barangs','penerimaan_barangs.barang_id','=','barangs.id')
    //    ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
    //    ->leftJoin('projects','purchases.project_id','=','projects.id')
       ->select('penerimaan_barangs.tanggal_penerimaan','penerimaan_barangs.ppn','penerimaan_barangs.total',
       'penerimaan_barangs.no_penerimaan_barang','penerimaan_barangs.id','barangs.nama_barang','purchases.supplier_id','purchases.project_id','penerimaan_barangs.no_po')
        ->where('penerimaan_barangs.status_tukar_faktur','pending')
        ->groupBy('penerimaan_barangs.no_penerimaan_barang')
        ->get();
        // dd($purchases);
        // $purchases = Purchase::where('status_barang', 'pending')->where('invoice',$request->invoice)->get();
      
        $suppliers = Supplier::get();
        $project = Project::get();
        //no PO
        $barangs = Barang::where('id_jenis', '1')->get();
        $AWALPO = 'PO';
        $noUrutAkhirPO = \App\Purchase::max('id');
        $nourutPO = $AWALPO . '/' .  sprintf("%02s", abs($noUrutAkhirPO + 1)) . '/' . sprintf("%05s", abs($noUrutAkhirPO + 1));
        //nomor tukarfaktur

        $tukarfaktur = 'TF';
        $noUrutAkhirTF = \App\TukarFaktur::max('id');
        // dd($noUrutAkhir);
        $nourutTF = $tukarfaktur . '/' .  sprintf("%02s", abs($noUrutAkhirTF + 1)) . '/' . sprintf("%05s", abs($noUrutAkhirTF + 1));

        // dd($purchases);
        $penerimaans = DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        ->leftJoin('barangs','penerimaan_barangs.barang_id','=','barangs.id')
        ->leftJoin('users','users.id','=','penerimaan_barangs.id_user')
        ->select('purchases.PPN','penerimaan_barangs.status_tukar_faktur','purchases.status_barang','purchases.project_id','purchases.invoice','penerimaan_barangs.total','penerimaan_barangs.id','purchases.supplier_id','barangs.nama_barang','penerimaan_barangs.id_purchase','penerimaan_barangs.qty',
        'penerimaan_barangs.harga_beli','penerimaan_barangs.barang_id','penerimaan_barangs.qty_received','users.name','suppliers.nama','penerimaan_barangs.no_penerimaan_barang')
        ->where('penerimaan_barangs.no_penerimaan_barang', $request->no_penerimaan_barang)
        ->first();

        // dd($penerimaans);
        if($request->has('no_penerimaan_barang')){
        
           
            $purchase = PenerimaanBarang::where('no_penerimaan_barang',$request->get('no_penerimaan_barang'))->groupBy('no_penerimaan_barang')->get();

    	}else{
            $purchase = PenerimaanBarang::get();

    	}
 
        

    
        
        return view('purchasing.tukarfaktur.create', compact('purchasing','penerimaans','purchase','purchases','suppliers', 'barangs', 'project', 'nourutPO','nourutTF'));
    }

    public function store(Request $request)
    {

        // dd($request->all());

        // $request->validate([
        //     'no_faktur' => 'required',
        //     'id_supplier' => 'required',
        //     'no_po_vendor' => 'required',
        //     'no_invoice' => 'required',
        //     'nilai_invoice' => 'required',
        //     'tanggal_tukar_faktur' => 'required',
        //     'id_dokumen' => 'required',
        //     'id_project' => 'required',
        //     'pilihan' => 'required',
        //     'nama_barang' => 'required',
        // ]);

        $dokumen = $request->input('id_dokumen', []);
        // dd($dokumen);
        $barang = $request->input('nama_barang', []);
        // dd($barang);
        $checked_array = $request->total;
       
       
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();

        $tukar_faktur = 1; 
        $spk = 2 ;
    if($tukar_faktur == request('po_spk')){

        foreach($checked_array as $bar => $barangs){
    
          
            $attr[] = [
                'no_faktur' => $request->no_faktur,
                'id_supplier' => $request->id_supplier[$bar],
                'id_project' => $request->id_project[$bar],
                // 'no_pn' => $request->no_pn[$key],
                'no_po_vendor' => $request->no_po_vendor[$bar],
                'po_spk' => $request->po_spk,
                'no_invoice' => $request->no_invoice,
                'total' => $request->total[$bar],
                // 'total_all' => $request->total_all[$key],
                'nama_barang' => $request->nama_barang[$bar],
                'nilai_invoice' => $request->nilai_invoice,
                'status_pembayaran' => 'pending',
                'id_user' => Auth::user()->id,
                'tanggal_tukar_faktur' => $request->tanggal_tukar_faktur,
                'is_active' =>1,
                
            ];
            //  dd($attr);
            //  dd($request->all());
            $penerimaan = PenerimaanBarang::select('id')->where('no_po', $request->no_po_vendor[$bar])->get();
            // dd($penerimaan);
           DB::table('penerimaan_barangs')->whereIn('id', $penerimaan)->update(array( 
           'status_tukar_faktur' => 'completed'));
    
           
      
        }
        foreach ($dokumen as $key => $no) {
          
            $in[] = [
                'no_faktur' => $request->no_faktur,
                'id_dokumen' => $no,
                'catatan' => $request->catatan[$key] ,
                'pilihan' => $request->pilihan[$key],
                'is_active' => 1,
            ];
            // dd($in);
        }
         }elseif($spk == request('po_spk')){
             
         
                 $attr[] = [
                        'no_faktur' => $request->no_faktur,
                        'id_supplier' => $request->id_supplier,
                        'id_project' => $request->id_project,
                        'po_spk' => $request->po_spk,
                        'no_po_vendor' => $request->no_po_vendor,
                        'no_invoice' => $request->no_invoice,
                        'nilai_invoice' => $request->nilai_invoice,
                        'nama_barang' => $request->nama_barang,
                        'id_user' => auth()->user()->id,
                        'tanggal_tukar_faktur' => $request->tanggal_tukar_faktur,
                        'status_pembayaran' => 'pending',
                        'is_active' =>1,
                        
                    ];
                    //  dd($attr);
                    foreach ($dokumen as $key => $no) {
                 $in[] = [
                        'no_faktur' => $request->no_faktur,
                        'id_dokumen' => $no,
                        'catatan' => $request->catatan[$key] ,
                        'pilihan' => $request->pilihan[$key],
                        'is_active' => 1,
                    ];
                    // dd($in);
                   
                }

    }
    DB::table('tukar_fakturs')->insert($attr);
    DB::table('detail_tukar_fakturs')->insert($in);

    DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Tukar Faktur barang berhasil');
    }
    public function search(Request $request)
    {
        $data = [];
        $tukar =  DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->select('purchases.status_barang','penerimaan_barangs.id_purchase','purchases.id','penerimaan_barangs.no_penerimaan_barang')
        ->where('penerimaan_barangs.no_penerimaan_barang', $request->no_penerimaan_barang)
        ->where('purchases.status_barang', 'completed')
        ->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'id' => $value->id,
                    'no_penerimaan_barang' => $value->no_penerimaan_barang,
                 
                ];
            }
        }
        return $data;
    }

    public function show($id, Request $request)
    {
      
       
            $detail = DB::table('tukar_fakturs')
            ->leftJoin('penerimaan_barangs','penerimaan_barangs.no_po','=','tukar_fakturs.no_po_vendor')
            ->leftJoin('suppliers', 'tukar_fakturs.id_supplier', '=', 'suppliers.id')
            ->leftJoin('detail_tukar_fakturs', 'tukar_fakturs.no_faktur', '=', 'detail_tukar_fakturs.no_faktur')
            ->leftJoin('purchases','tukar_fakturs.no_po_vendor','=','purchases.invoice')
            ->leftJoin('dokumen_tukar_faktur','detail_tukar_fakturs.id_dokumen','=','dokumen_tukar_faktur.id')
            ->select('purchases.barang_id','purchases.invoice','po_spk','tukar_fakturs.no_po_vendor','penerimaan_barangs.no_penerimaan_barang','tukar_fakturs.no_faktur','tukar_fakturs.status_pembayaran','suppliers.nama',
            'tukar_fakturs.no_faktur','tukar_fakturs.id','tukar_fakturs.nilai_invoice',
            'detail_tukar_fakturs.pilihan','dokumen_tukar_faktur.nama_dokumen', 'detail_tukar_fakturs.catatan','tukar_fakturs.tanggal_tukar_faktur')
            ->where('tukar_fakturs.id',$id)
            ->groupBy('detail_tukar_fakturs.id_dokumen')
            ->get();
            // dd($detail);

            $tukar = TukarFaktur::where('id',$id)
            ->select('tukar_fakturs.no_faktur')
            ->get();
            // dd($tukar);

            $purchases = TukarFaktur::leftjoin('purchases','tukar_fakturs.no_po_vendor','=','invoice')
            ->whereIn('tukar_fakturs.no_faktur',$tukar)
            ->select('tukar_fakturs.nilai_invoice','purchases.barang_id','purchases.invoice','tukar_fakturs.total')
            ->get();
            // dd($purchases);


        return view('purchasing.tukarfaktur.show', compact('detail','purchases'));
    }

    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $suppliers = Supplier::get();
        $project = Project::get();
        $barangs = Barang::where('jenis', 'barang')->get();

        return view('purchasing.tukarfaktur.edit', compact('project', 'purchase', 'suppliers', 'barangs', 'purchases'));
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
        // dd("ok");
        // dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'status_pembayaran' => 'pending',
                'status_barang' => 'pending'
            ];
            $id[] = $purchases[$key];
        }

        // Purchase::updateOrInsert([
        //     'id' => $id
        // ], $attr);

        // InOut::insert($in);

        DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Purchase barang berhasil');
    }

    public function destroy($id)
    {
        $tukar_fakturs = TukarFaktur::where('id', $id)->get();
        // dd($tukar_fakturs);

        foreach ($tukar_fakturs as $tukar) {

            $tukars= TukarFaktur::where('no_faktur', $tukar->no_faktur)->select('no_po_vendor')->get();
            // dd($tukars);
           
       
            DB::table('penerimaan_barangs')->whereIn('no_po', $tukars)->update(array( 
                'status_tukar_faktur' => 'pending'));
        
            $tukars= TukarFaktur::where('no_faktur', $tukar->no_faktur)->select('no_po_vendor')->delete();
        }
        // dd($purchases);
    

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Tukar Faktur barang didelete');
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
        $purchases = DB::table('penerimaan_barangs')
        ->leftJoin('tukar_fakturs','penerimaan_barangs.no_po','=','tukar_fakturs.no_po_vendor')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('barangs','penerimaan_barangs.barang_id','=','barangs.id')
        // ->where('tukar_fakturs.id',$id)
        ->where('tukar_fakturs.no_faktur',$request->no_faktur)
        ->select('penerimaan_barangs.ppn','barangs.nama_barang','purchases.harga_beli','purchases.qty','penerimaan_barangs.no_po')
         ->get();
        foreach ($purchases as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return $data;
        dd($data);
    }


    public function pdf($id)
    {
        $detail = DB::table('tukar_fakturs')
        ->leftJoin('penerimaan_barangs','penerimaan_barangs.no_po','=','tukar_fakturs.no_po_vendor')
     
        ->leftJoin('suppliers', 'tukar_fakturs.id_supplier', '=', 'suppliers.id')
        ->leftJoin('detail_tukar_fakturs', 'tukar_fakturs.no_faktur', '=', 'detail_tukar_fakturs.no_faktur')
        ->leftJoin('dokumen_tukar_faktur','detail_tukar_fakturs.id_dokumen','=','dokumen_tukar_faktur.id')
        ->select('penerimaan_barangs.no_penerimaan_barang','tukar_fakturs.no_faktur','tukar_fakturs.status_pembayaran','suppliers.nama',
        'tukar_fakturs.no_faktur','tukar_fakturs.id','tukar_fakturs.nilai_invoice',
        'detail_tukar_fakturs.pilihan','dokumen_tukar_faktur.nama_dokumen', 'detail_tukar_fakturs.catatan','tukar_fakturs.tanggal_tukar_faktur')
        ->where('tukar_fakturs.id',$id)
        ->groupBy('detail_tukar_fakturs.id_dokumen')
        ->get();
        return view('purchasing.tukarfaktur.pdf',compact('detail'));
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
}
