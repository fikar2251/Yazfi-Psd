<?php

namespace App\Http\Controllers\hrd;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\{User, Cabang, Pengajuan, Perusahaan, Reinburst, RincianPengajuan, RincianReinburst};
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReinburstController extends Controller
{
    public function index(Reinburst $reinburst,Request $request)
    {
        abort_unless(\Gate::allows('reinburst-access'), 403);
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to])->where('id_user',auth()->user()->id)->get();
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
        return view('hrd.reinburst.index', compact('reinbursts'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('reinburst-create'), 403);
        $AWAL = 'RN';
        $noUrutAkhir = \App\Reinburst::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        $projects = Project::get();
        return view('hrd.reinburst.create', compact('projects', 'nourut'));
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('reinburst-create'), 403);
        $request->validate([
            'no_kwitansi' => 'required',
            'harga_beli' => 'required',
            'nomor_reinburst' => 'required',
        ]);

        $barang = $request->input('no_kwitansi', []);
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $AWAL = 'RN';
                $noUrutAkhir = \App\Reinburst::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);

                $attr[] = [
                    'nomor_reinburst' => $request->nomor_reinburst,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' => auth()->user()->id_perusahaan,
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'id_jabatans' => $request->id_jabatans,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => auth()->user()->id_roles
                ];
                foreach ($barang as $key => $no) {
                    $in[] = [
                        'no_kwitansi' => $request->no_kwitansi[$key],
                        'harga_beli' => $request->harga_beli[$key],
                        'catatan' => $request->catatan[$key],
                        'total' => $request->harga_beli[$key],
                        'nomor_reinburst' => $request->nomor_reinburst,
                   
                    ];
                }
                Reinburst::insert($attr);
                RincianReinburst::insert($in);
            }
        }
        DB::commit();
        return redirect()->route('hrd.reinburst.index')->with('success', 'Reinburst barang berhasil');
    }

    public function show(Reinburst $reinburst)
    {   $reinbursts = Reinburst::where('id', $reinburst->id)->first();
        $rincianreinbursts = RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();
        return view('hrd.reinburst.show', compact('reinbursts','rincianreinbursts','reinburst'));
    }

    public function edit(Reinburst $reinburst)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);
        $reinbursts = Reinburst::where('id', $reinburst->id)->get();
        $peng = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts', 'reinbursts.id', '=', 'rincian_reinbursts.id')
            ->select('rincian_reinbursts.harga_beli', 'rincian_reinbursts.total', 'rincian_reinbursts.catatan','rincian_reinbursts.no_kwitansi')
            ->get();
          $projects= Project::get();

        return view('hrd.reinburst.edit',compact('reinburst', 'reinbursts', 'peng','projects'));
    }

    public function update(Request $request, Reinburst $reinburst)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);
        $request->validate([
            'no_kwitansi' => 'required',
            'harga_beli' => 'required',
            'nomor_reinburst' => 'required',
        ]);

        $barang = $request->input('no_kwitansi', []);
        $attr = [];
     
        $reinburst = Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->pluck('id');
        // dd("ok");
        // dd($reinburst);
     
        $attr = [];
  
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $AWAL = 'RN';
                $noUrutAkhir = \App\Reinburst::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);

                $attr[] = [
                    'nomor_reinburst' => $request->nomor_reinburst,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' => auth()->user()->id_perusahaan,
                    'id_jabatans' => $request->id_jabatans,
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => auth()->user()->id_roles
                ];
                dd($attr);
            
                foreach ($barang as $key => $no) {
                    $reinburst = \App\Reinburst::max('id');
                    $id = $reinburst + 1;
                    $rincian_reinburst = RincianReinburst::where('no_kwitansi', auth()->user()->id_reinburst)->where('no_kwitansi', $no)->first();
                    dd($rincian_reinburst);
    
                $rincian_reinburst->update([
                        'no_kwitansi' =>$rincian_reinburst->no_kwitansi + $request->no_kwitansi[$key],
                        'harga_beli' =>$rincian_reinburst->harga_beli + $request->harga_beli[$key],
                        'catatan' => $rincian_reinburst->catatan + $request->catatan[$key],
                        'total' => $rincian_reinburst->total + $request->harga_beli[$key],
                        'id_reinburst' => $id,
                      
                 
                ]);
            
                }
                Reinburst::updateOrInsert([
                    'id' => $id
                ], $attr);
            }
        }

    

        DB::commit();


        return redirect()->route('hrd.reinburst.index')->with('success', 'Pengajuan barang berhasil');
    }

    public function destroy(Reinburst $reinburst)
    {
        abort_unless(\Gate::allows('reinburst-delete'), 403);
        $reinbursts = Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();

        foreach ($reinbursts as $pur) {
            RincianReinburst::where('nomor_reinburst', $pur->nomor_reinburst)->delete();
            // $harga = HargaProdukCabang::where('barang_id', $pur->barang_id)->where('project_id', auth()->user()->project_id)->first();

            // // $harga->update([
            // //     'qty' => $harga->qty - $pur->qty
            // // ]);
            $pur->delete();
        }
          

        return redirect()->route('hrd.reinburst.index')->with('success', 'Purchase barang didelete');
    }
}
