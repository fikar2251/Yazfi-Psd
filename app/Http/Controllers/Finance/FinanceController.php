<?php
namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Komisi;
use App\Pembayaran;
use App\PenerimaanBarang;
use App\Pengajuan;
use App\Penggajian;
use App\Reinburst;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use App\TukarFaktur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FinanceController extends Controller
{
    public function index()
    {
        $bayar = Pembayaran::where('status_approval', 'paid')->get();

        return view('finance.payment.index', compact('bayar'));
    }

    public function paymentJson(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                # code...
                $bayar = Pembayaran::where('status_approval', 'paid')
                ->whereBetween('tanggal_pembayaran', array($request->from_date, $request->to_date))
                ->get();
            }else {
                $bayar = Pembayaran::where('status_approval', 'paid')->get();
            }
        

            return DataTables::of($bayar)
                    ->editColumn('status_approval', function($bayar){
                        if ($bayar->status_approval == 'pending'){
                        return '<span class="badge badge-danger">' . $bayar->status_approval . '</span>';
                        }elseif ($bayar->status_approval == 'paid'){
                        return '<span class="badge status-green">' . $bayar->status_approval. '</span>';
                        }
                    })
                    ->editColumn('bank_tujuan', function($bayar){
                        if ($bayar->bank_tujuan == 'Bri'){
                        return 'BRI';
                        }elseif ($bayar->bank_tujuan == 'Bca'){
                        return 'BCA';
                        }else {
                            return 'Mandiri';
                        }
                    })
                    ->editColumn('keterangan', function($bayar){
                        return $bayar->rincian->keterangan;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['status_approval', 'bank_tujuan', 'keterangan'])
                    ->make(true);
        }
    }

    public function komisiFinance()
    {
        $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', 'paid')->get();
        return view('finance.komisi.index', compact('komisi'));
    }

    public function komisiJson(Request $request)
    {
        if (request()->ajax()) {
            if(!empty($request->from_date)) {
            $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', 'paid')
            ->whereBetween('tanggal_pembayaran', array($request->from_date, $request->to_date))
            ->get();           
            }else {
                $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', 'paid')->get();
            }

            return DataTables::of($komisi)
            ->editColumn('status_pembayaran', function($komisi){
                if ($komisi->status_pembayaran == 'unpaid'){
                return '<span class="badge badge-danger">' . $komisi->status_pembayaran . '</span>';
                }elseif ($komisi->status_pembayaran == 'paid'){
                return '<span class="badge status-green">' . $komisi->status_pembayaran. '</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status_pembayaran'])
            ->make(true);
        }
    }

    public function listKomisi(Request $request)
    {
        $komisi = Komisi::orderBy('id', 'desc')->whereIn('status_pembayaran', ['unpaid','reject'])->get();
        return view('finance.komisi.daftar', compact('komisi'));
    }

    public function storeKomisi(Request $request)
    {
        $status = $request->get('status');
        $itemid = $request->get('id');
        $count_status = count($status);

        for ($i=0; $i <$count_status ; $i++) { 
            $change = Komisi::where('id', $itemid[$i])->first();

            $change->update([
                'status_pembayaran' => $status[$i],
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
            ]);
        }
        if ($change->status_pembayaran == 'paid') {
            
            return redirect('/finance/komisi');
        }else {
            return redirect()->back();
        }
    }

    public function listPayment()
    {
        $bayar = Pembayaran::whereIn('status_approval', ['pending', 'reject'])->orderBy('id', 'desc')->get();
        return view('finance.payment.daftar', compact('bayar'));
    }

    public function storePayment(Request $request)
    {

        $status = $request->get('status');
        $itemid = $request->get('id');
        $count_status = count($status);

        for ($i = 0; $i < $count_status; $i++) {
            $change = Pembayaran::where('id', $itemid[$i])->first();

            $change->update([
                'status_approval' => $status[$i],
            ]);

            $tagihan = Tagihan::where('id_rincian', $change->rincian_id)->first();
            $bayar = Pembayaran::where('rincian_id', $change->rincian_id)->sum('nominal');
            $sum = (int) $bayar;

            if ($change->status_approval == 'paid') {
                # code...
                if ($change->nominal == $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'paid';
                } elseif ($change->nominal < $tagihan->jumlah_tagihan && $sum < $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'partial';
                } elseif ($sum == $tagihan->jumlah_tagihan) {
                    $tagihan->status_pembayaran = 'paid';
                }
                $tagihan->save();

                $spr = $tagihan->id_spr;
                $spr1 = Spr::where('id_transaksi', $spr)->first();
                if ($tagihan->tipe == 1) {
                    $spr1->status_booking = 'paid';
                } elseif ($tagihan->tipe == 2) {
                    $spr1->status_dp = 'paid';
                }
                $spr1->save();

                $unit = $spr1->id_unit;
                $rumah = Rumah::where('id_unit_rumah', $unit)->first();
                $rumah->status_penjualan = 'Sold';
                $rumah->save();
            }

        }
        // dd($change);
        if ($change->status_approval == 'paid') {
            # code...
            return redirect('/finance/payment');
        }else {
            return redirect()->back();
        }

    }

    public function ubahStatus($id)
    {
        $bayar = Pembayaran::find($id);
        $bayar->status_approval = 'paid';
        $bayar->save();

        $bayar = Pembayaran::select('nominal', 'rincian_id')
            ->where('id', $id)->first();

        $where = [
            // 'nominal' => $bayar->nominal,
            'id_rincian' => $bayar->rincian_id,
        ];

        $tagihan = Tagihan::where($where)->first();

        $rincianid = $bayar->rincian_id;
        $nominal = $bayar->nominal;
        $bayar1 = Pembayaran::where('rincian_id', $rincianid)->sum('nominal');
        $sum = (int) $bayar1;

        if ($bayar->nominal == $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'paid';
        } elseif ($bayar->nominal < $tagihan->jumlah_tagihan && $sum < $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'partial';
        } elseif ($sum == $tagihan->jumlah_tagihan) {
            $tagihan->status_pembayaran = 'paid';
        }
        $tagihan->save();

        $spr = $tagihan->id_spr;
        $spr1 = Spr::where('id_transaksi', $spr)->first();
        if ($tagihan->tipe == 1) {
            $spr1->status_booking = 'paid';
        } elseif ($tagihan->tipe == 2) {
            $spr1->status_dp = 'paid';
        }
        $spr1->save();

        $unit = $spr1->id_unit;
        $rumah = Rumah::where('id_unit_rumah', $unit)->first();
        $rumah->status_penjualan = 'Sold';
        $rumah->save();

        return redirect()->back();
    }

    public function updateKomisi($id)
    {
        $tglBayar = Carbon::now()->format('d-m-Y');
        $komisi = Komisi::find($id);
        $komisi->status_pembayaran = 'paid';
        $komisi->tanggal_pembayaran = $tglBayar;
        $komisi->save();

        return redirect()->back();
    }

    public function tukarFaktur()
    {
        
        return view('finance.tukar-faktur.index');
    }

    public function ajax_faktur(Request $request)
    {
     if(request()->ajax())
     {
        if (!empty($request->from)) {
            $tukar = DB::table('tukar_fakturs')
            ->whereBetween('tanggal_tukar_faktur', array($request->from, $request->to))
            // ->where('id_user',auth()->user()->id)
            ->groupBy('tukar_fakturs.no_faktur')
            ->orderBy('tukar_fakturs.id','desc')
            ->get();    

        
        } else {

            $tukar = DB::table('tukar_fakturs')
            // ->where('id_user',auth()->user()->id)
            ->groupBy('tukar_fakturs.no_faktur')
            ->orderBy('tukar_fakturs.id','desc')
            ->get();   
            // dd($tukar);
                
        }
        // dd($penerimaans);
        return datatables()
            ->of($tukar)
            ->editColumn('no_tukar', function ($tukars) {
                return '<a href="' . route("purchasing.tukarfaktur.show", $tukars->id) . '">' . $tukars->no_faktur . '</a>';
            })
            ->editColumn('status_po', function ($tukars) {
                if($tukars->po_spk == '1'){
               return '<a class="custom-badge status-orange">PO</a>';
               }
                if($tukars->po_spk == '2'){
                    return '<a class="custom-badge status-green">SPK</a>';
                }
               
            })
            ->editColumn('tanggal', function ($tukars) {
                return Carbon::parse($tukars->tanggal_tukar_faktur)->format('d/m/Y');
            })
            ->editColumn('invoice', function ($tukars) {
                return $tukars->no_invoice;
            })
            
            ->editColumn('total', function ($tukars) {
                return  \App\TukarFaktur::where('no_faktur', $tukars->no_faktur)->count();
            })
            ->editColumn('pembelian', function ($tukars) {
                return $tukars->nilai_invoice;
            })
            ->editColumn('status', function ($tukars) {
                if($tukars->status_pembayaran == 'pending'){
               return '<a class="custom-badge status-red">pending</a>';
               }
                if($tukars->status_pembayaran == 'completed'){
                    return '<a class="custom-badge status-green">completed</a>';
                }
               
            })
            ->editColumn('action', function ($tukars) {
                
                TukarFaktur::where('id', $tukars->id)->get();
            
                
                return '<a href="' . route('finance.tukar.update', $tukars->id) . '"   class="delete-form btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>';
             

            })
            ->addIndexColumn()
            ->rawColumns(['no_tukar', 'status','status_po','action'])
            ->make(true);
            // ->addColumn('action', function ($row) {
            //     $html = '<a href="" class="btn btn-xs btn-secondary">Edit</a> ';
            //     $html .= '<button data-rowid="'.$row->id.'" class="btn btn-xs btn-danger">Del</button>';
            //     return $html;
            // })
            
            // ->toJson()
     }
    }

    public function destroy($id)
    {
        $tukar_fakturs = TukarFaktur::where('id', $id)->get();

        foreach ($tukar_fakturs as $tukar) {

            $penerimaan= TukarFaktur::whereIn('no_faktur', $tukar)->select('no_po_vendor', 'no_faktur')->get();
            // dd($penerimaan);
            // $nofaktur = $tukar->no_faktur;
            
            // dd($penerimaan);
            DB::table('tukar_fakturs')->whereIn('no_faktur', $penerimaan)->update(array( 
                'status_pembayaran' => 'completed'));
                
            // $tukar->delete();
           
        }
        // dd($purchases);
    

        return redirect()->route('finance.tukar')->with('success', 'Status Pembayaran Complete');
    }

    public function pengajuan(Pengajuan $pengajuan, Request $request)
    {
        
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->whereBetween('tanggal_pengajuan', [$from, $to])->get();
          
        } else {
            $pengajuans = Pengajuan::orderBy('id','desc')
            ->groupBy('nomor_pengajuan')
            ->get();
            }
   
            return view('finance.pengajuan.index', compact('pengajuans'));
        }

        public function ajax_pengajuan(Request $request){

            if(request()->ajax()){
    
                if(!empty($request->from_date))
                {
                    
                    $pengajuans = Pengajuan::
                    leftJoin('rincian_pengajuans','pengajuans.nomor_pengajuan','=','rincian_pengajuans.nomor_pengajuan')
                    ->leftJoin('roles','pengajuans.id_roles','=','roles.id')
                    ->select('roles.name','pengajuans.id','pengajuans.status_approval','pengajuans.id_user','pengajuans.nomor_pengajuan','pengajuans.tanggal_pengajuan',
                    'rincian_pengajuans.grandtotal','pengajuans.id_perusahaan','pengajuans.id_roles')
                    ->whereBetween('pengajuans.tanggal_pengajuan', array($request->from_date, $request->to_date))
                    ->groupBy('pengajuans.nomor_pengajuan')
                    ->orderBy('pengajuans.id', 'desc')
                    ->get();
                    // dd($pengajuans);
    
                }else{
                    $pengajuans = Pengajuan::
                    leftJoin('rincian_pengajuans','pengajuans.nomor_pengajuan','=','rincian_pengajuans.nomor_pengajuan')
                    ->leftJoin('roles','pengajuans.id_roles','=','roles.id')
                    ->select('roles.name','pengajuans.id','pengajuans.status_approval','pengajuans.id_user','pengajuans.nomor_pengajuan','pengajuans.tanggal_pengajuan',
                    'rincian_pengajuans.grandtotal','pengajuans.id_perusahaan','pengajuans.id_roles')
                    ->orderBy('pengajuans.id', 'desc')
                    ->get();
                    // dd($pengajuans);
                }
                return datatables()
                    ->of($pengajuans)
                    ->editColumn('no_pengajuan', function ($pengajuan) {
                        return '<a href="' . route("logistik.pengajuan.show", $pengajuan->id) . '">' . $pengajuan->nomor_pengajuan . '</a>';
                    })
                    ->editColumn('perusahaan', function ($pengajuan) {
                        return $pengajuan->perusahaan->nama_perusahaan;
                    })
                    ->editColumn('tanggal', function ($pengajuan) {
                        return Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y');
                    })
                    ->editColumn('divisi', function ($pengajuan) {
                        return $pengajuan->roles->name;
                    })
                    ->editColumn('nama', function ($pengajuan) {
                        return $pengajuan->admin->name;
                    })
                    ->editColumn('total', function ($pengajuan) {
                        return \App\Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->count();
                    })
                    ->editColumn('pembelian', function ($pengajuan) {
                        return $pengajuan->grandtotal;
                    })
                    ->editColumn('status', function ($pengajuan) {
                        if($pengajuan->status_approval == 'pending'){
                       return '<a class="custom-badge status-red">pending</a>';
                       }
                        if($pengajuan->status_approval == 'completed'){
                            return '<a class="custom-badge status-green">completed</a>';
                        }
                       
                    })
                    ->editColumn('action', function ($data) {
                        
                        Pengajuan::where('id', $data->id)->get();
                       
                        return '<a href="' . route('finance.pengajuan.update', $data->id) . '"   class=" delete-form btn btn-sm btn-warning"><i class="fa fa-check"></i></a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['no_pengajuan','status','action'])
                    ->make(true);
            }
        }

        public function updatePengajuan($id)
        {
           

            $update = Pengajuan::find($id);
            $update->status_approval = 'completed';
            $update->save();
          
            
            return redirect()->route('finance.pengajuan')->with('success', 'Status Approval Complete');
        }

        public function reinburst(Reinburst $reinburst,Request $request)
        {
           
            if (request('from') && request('to')) {
                $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
                $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
                $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to]);
                $coba = DB::table('rincian_reinbursts')->leftjoin('reinbursts','rincian_reinbursts.nomor_reinburst','=','reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user','reinbursts.id','reinbursts.tanggal_reinburst','reinbursts.nomor_reinburst','reinbursts.status_hrd','rincian_reinbursts.nomor_reinburst','rincian_reinbursts.total','reinbursts.status_pembayaran','reinbursts.id')
                ->whereBetween('rincian_reinbursts.created_at', [$from, $to])->where('reinbursts.status_hrd','completed')
                ->groupBy('reinbursts.nomor_reinburst')->sum('rincian_reinbursts.total') ;
                // dd($coba);
            } else {
                $reinbursts = DB::table('reinbursts')
                ->leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user','reinbursts.id','reinbursts.tanggal_reinburst','reinbursts.nomor_reinburst','reinbursts.status_hrd','rincian_reinbursts.nomor_reinburst','rincian_reinbursts.total','reinbursts.status_pembayaran','reinbursts.id')
                ->orderBy('reinbursts.id','desc')
                ->groupBy('reinbursts.nomor_reinburst')
                ->where('reinbursts.status_hrd','completed')
                ->get();
                
            
            }
            return view('finance.reinburst.index', compact('reinbursts'));
        }

          //rekap reinburst
        public function ajax_rekap_reinburst(Request $request)
        {
            if(request()->ajax())
            {
                if(!empty($request->from_date))
                {
                $reinbursts = Reinburst::
                leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
                'rincian_reinbursts.total','reinbursts.id')
                ->whereBetween('reinbursts.tanggal_reinburst', array($request->from_date, $request->to_date))
                ->groupBy('reinbursts.nomor_reinburst')
                ->orderBy('reinbursts.id', 'desc')->where('reinbursts.status_hrd','completed')
                ->get();
                // dd($reinbursts);
                }
                else
                {
                    $reinbursts = Reinburst::
                    leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
                    ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
                    'rincian_reinbursts.total','reinbursts.id')
                    ->groupBy('reinbursts.nomor_reinburst')
                    ->orderBy('reinbursts.id', 'desc')->where('reinbursts.status_hrd','completed')
                    ->get();

                }

                return datatables()
                    ->of($reinbursts)
                    ->editColumn('no_reinburst', function ($reinburst) {
                        return '<a href="' . route("admin.reinburst.show", $reinburst->id) . '">' . $reinburst->nomor_reinburst . '</a>';
                    })
                    ->editColumn('tanggal', function ($reinburst) {
                        return Carbon::parse($reinburst->tanggal_reinburst)->format('d/m/Y');
                    })
                    ->editColumn('total', function ($reinburst) {
                        return \App\Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->count();
                    })
                    ->editColumn('pembelian', function ($reinburst) {
                        return $reinburst->total;
                    })
                    ->editColumn('status_hrd', function ($reinburst) {
                        if($reinburst->status_hrd == 'pending'){
                    return '<a class="custom-badge status-red">pending</a>';
                    }
                        if($reinburst->status_hrd == 'completed'){
                            return '<a class="custom-badge status-green">completed</a>';
                        }
                        if($reinburst->status_hrd == 'review'){
                            return '<a class="custom-badge status-orange">review</a>';
                        }
                    })
                    ->editColumn('status_pembayaran', function ($reinburst) {
                        if($reinburst->status_pembayaran == 'pending'){
                            return '<a class="custom-badge status-red">pending</a>';
                            }
                            if($reinburst->status_pembayaran == 'completed'){
                                return '<a class="custom-badge status-green">completed</a>';
                            }
                            if($reinburst->status_pembayaran == 'review'){
                                return '<a class="custom-badge status-orange">review</a>';
                            }
                    })
                    ->editColumn('action', function ($reinburst) {
            
                        Reinburst::where('id', $reinburst->id)->get();
                        $button = '<a href="' . route('finance.reinburst.update', $reinburst->id) . '"  class="custom-badge status-green"><i class="fa-solid fa-check-to-slot"></i></a>';
                        return $button;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['no_reinburst','pembelian','status_hrd','status_pembayaran','action'])
                    ->make(true);
            }

        }

        public function updateReinburst($id)
        {
           
            $update = Reinburst::find($id);
            $update->status_pembayaran = 'completed';
            $update->save();
          
            
            return redirect()->route('finance.reinburst')->with('success', 'Status Pembayaran Complete');
        }
        
          public function gaji()
        {
            $penggajians= Penggajian::orderBy('id','desc')->get();
            
            return view('finance.gaji.index',compact('penggajians'));
        }

        public function ajax_gaji( Request $request)
        {
            if(request()->ajax()){
                if(!empty($request->from_date))
                {
                    $gaji = Penggajian::whereBetween('tanggal', array($request->from_date, $request->to_date))->orderBy('id', 'desc')->get();
    
                }else{
                    $gaji = Penggajian::orderBy('id', 'desc')->get();
                }
                return datatables()
                    ->of($gaji)
                    ->editColumn('pegawai', function ($gajian) {
                        return $gajian->pegawai->name;
                    })
                    ->editColumn('tanggal', function ($gajian) {
                        return Carbon::parse($gajian->tanggal)->format('d/m/Y');
                    })
                    ->editColumn('bulan_tahun', function ($gajian) {
                        return Carbon::parse($gajian->bulan_tahun)->format('F/Y');
                    })
                    ->editColumn('gaji_pokok', function ($gajian) {
                        return $gajian->gaji_pokok;
                    })
                    ->editColumn('penerimaan', function ($gajian) {
                        return $gajian->penerimaan->sum('nominal') - $gajian->gaji_pokok;
                    })
                    ->editColumn('potongan', function ($gajian) {
                        return $gajian->potongan->sum('nominal');
                    })
                    ->editColumn('total', function ($gajian) {
                        return $gajian->gaji_pokok + (($gajian->penerimaan->sum('nominal') - $gajian->gaji_pokok) - $gajian->potongan->sum('nominal'));
                    })
                    ->editColumn('jabatan', function ($gajian) {
                        return $gajian->jabatan;
                    })
                    ->editColumn('divisi', function ($gajian) {
                        return $gajian->divisi;
                    })
                    ->editColumn('admin', function ($gajian) {
                        return $gajian->admin;
                    })
                    ->editColumn('status', function ($gajian) {
                       if($gajian->status_penerimaan == 'pending'){
                            return '<a class="custom-badge status-red">pending</a>';
                            }
                             if($gajian->status_penerimaan == 'paid'){
                                 return '<a class="custom-badge status-green">paid</a>';
                             }
                             if($gajian->status_penerimaan == 'reject'){
                                 return '<a class="custom-badge status-orange">reject</a>';
                             }
                    })
                    ->editColumn('action', function ($gajian) {
                        
                        Penggajian::where('id', $gajian->id)->get();
                
                        
                        return '<a href="' . route('hrd.gaji.print', $gajian->id) . '"class="btn btn-sm btn-secondary"><i class="fa-solid fa-print"></i></a>
                         <a href="' . route('hrd.gaji.show', $gajian->id) . '"class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
                        <a href="' . route('hrd.gaji.edit', $gajian->id) . '"class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> 
                        <a href="' . route('hrd.gaji.hapus', $gajian->id) . '"   class="delete-form btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['pegawai','action', 'status'])
                    ->make(true);
            }
        }

}
