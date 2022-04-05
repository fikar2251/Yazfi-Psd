<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Komisi;
use App\Spr;
use App\TeamSales;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KomisiController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {
            // $user = User::where('id', 20)->get();

            $id = auth()->user()->id;
            $user = TeamSales::where('user_id', $id)->get();
            $komisi = Komisi::orderBy('id', 'desc')->get(); 

            return view('supervisor.komisi.index', compact('user', 'komisi'));
        }

    }

    public function komisiJson()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {
            $user = User::where('id_roles', 4)->get();

            $komisi = Komisi::orderBy('id', 'desc')->get(); 

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

    public function show($id)
    {
        $spr = Spr::orderBy('id_transaksi', 'desc')->where('id_sales', $id)->get();
        // foreach ($spr as $sp) {
        //     $hj = $sp->harga_jual;
        // }
        $authid = auth()->user()->id;
        $manager = TeamSales::where('user_id', $authid)->first();
        $nospr = request()->get('no_transaksi');
        if ($nospr) {

            $harga = Spr::where('no_transaksi', $nospr)->first();
            $hj = $harga->harga_jual;
            $kom = Komisi::where('no_spr', $nospr)->first();
            if ($kom) {
                # code...
                $sprno = $kom->no_spr;
            }else {
                $sprno = 'No data';
            }

            $pph = $hj * (2.5 / 100);
            $bphtb = $hj * (2.5 / 100);
            $pll = $hj * (2.5 / 100);

            $potongan = [
                'pph' => $pph,
                'bphtb' => $bphtb,
                'pll' => $pll,
            ];

            $dasar = $hj - ($pph + $bphtb + $pll);

            $totalfee = $pph + $bphtb + $pll;

            $kmsales = $dasar * (0.1 / 100);

            $kmspv = $dasar * (0.1 / 100);

            $kmmanager = $dasar * (0.1 / 100);

            $komisi = [
                'sales' => $kmsales,
                'spv' => $kmspv,
                'manager' => $kmmanager,
            ];

            return view('supervisor.komisi.show', compact('spr', 'potongan', 'dasar', 'totalfee', 'komisi', 'sprno', 'hj', 'manager'));
        } else {
            return view('supervisor.komisi.show', compact('spr', 'id'));
        }
    }

    public function storeKomisi(Request $request)
    {
        $tgl = Carbon::now()->format('d-m-Y');
        Komisi::create([
            'no_komisi' => $request->no_komisi,
            'tanggal_komisi' => $tgl,
            'no_spr' => $request->no_transaksi,
            'sales' => $request->nama_sales,
            'nominal_sales' => $request->nominal_sales,
            'spv' => $request->nama_spv,
            'nominal_spv' => $request->nominal_spv,
            'manager' => $request->nama_manager,
            'nominal_manager' => $request->nominal_manager,
            'status_pembayaran' => 'unpaid',
            'is_active' => 1,
        ]);

        return redirect('/supervisor/komisi');
    }

    

    // public function show(Booking $komisi)
    // {
    //     
    // }

    // public function edit(RincianKomisi $komisi)
    // {
    //   
    // }

    // public function update(RincianKomisi $komisi)
    // {
    //  
    // }

    // public function change(RincianKomisi $komisi)
    // {
    //   
    // }

    // public function updatechange($id)
    // {
        
    // }

    // public function destroy(RincianKomisi $komisi)
    // {
    //     $komisi->delete();
    //     return back()->with('success', 'Komisi berhasil didelete');
    // }
}
