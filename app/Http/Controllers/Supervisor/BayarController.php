<?php

namespace App\Http\Controllers\Supervisor;

use App\Alasan;
use App\BayarTagihan;
use App\Http\Controllers\Controller;
use App\PembatalanUnit;
use App\Pembayaran;
use App\Refund;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use App\TeamSales;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->distinct()->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        return view('supervisor.payment.index', compact('spr', 'getSpr', 'tagihan', 'bayar'));
    }

    public function show($id)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->where('id_sales', $id)->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();
        
        $total = Pembayaran::where('no_detail_transaksi', $no)
                ->where('status_approval', 'paid')->sum('nominal');
        
        $totaltg = Tagihan::where('no_transaksi', $no)->sum('jumlah_tagihan');
        $sisa = $totaltg - $total;
        
        return view('supervisor.payment.create', compact('spr', 'getSpr', 'tagihan', 'bayar', 'id','total', 'sisa'));
    }

    public function sales()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {

            // $user = User::where('id', 20)->get();
            $id = auth()->user()->id;
            $user = TeamSales::where('user_id', $id)->get();

            return view('supervisor.cancel.index', compact('user'));

        }

    }

    public function batalJson()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {
            $user = User::where('id', 20)->get();

            $batal = PembatalanUnit::orderBy('no_pembatalan', 'desc')->get();

            return DataTables::of($batal)
                ->editColumn('refund', function ($batal) {
                    if ($batal->refund == 'unpaid') {
                        return '<span class="badge badge-danger">' . $batal->refund . '</span>';
                    } elseif ($batal->refund == 'paid') {
                        return '<span class="badge status-green">' . $batal->refund . '</span>';
                    }
                })
                ->editColumn('type', function ($batal) {
                    return $batal->spr->unit->type;
                })
                ->editColumn('no_transaksi', function ($batal) {
                    return $batal->spr->no_transaksi;
                })
                ->editColumn('harga_net', function ($batal) {
                    return $batal->spr->harga_net;
                })
                ->editColumn('konsumen', function ($batal) {
                    return $batal->spr->nama;
                })
                ->editColumn('sales', function ($batal) {
                    return $batal->spr->user->name;
                })
                ->editColumn('diajukan', function ($batal) {
                    return auth()->user()->name;
                })
                ->addIndexColumn()
                ->rawColumns(['no_transaksi', 'type', 'harga_net', 'konsumen', 'sales', 'diajukan', 'refund'])
                ->make(true);

        }
    }

    public function cancel($id)
    {
        $no = request()->get('no_transaksi');

        $spr = Spr::where('id_sales', $id)->orderBy('id_transaksi', 'desc')->get();
        $attr[] = [
            'no' => ['1', '2'],
        ];
        $cekbatal = DB::table('pembatalan_unit')
            ->whereIn('spr_id', [1, 2])
            ->get();

        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        // $alasan = Alasan::all();
        if ($no) {

            $notf = Spr::select('id_transaksi')->where('no_transaksi', $no)->get();
            foreach ($notf as $no) {
                # code...
            }
            $idtf = $no->id_transaksi;
            $batal = PembatalanUnit::where('spr_id', $idtf)->first();
            if ($batal) {
                # code...
                $idbatal = $batal->spr->no_transaksi;
                return view('supervisor.cancel.cancel', compact('getSpr', 'spr', 'idbatal'));
            } else {
                $idbatal = '';
                return view('supervisor.cancel.cancel', compact('getSpr', 'spr', 'idbatal'));
            }

        } else {
            # code...
            return view('supervisor.cancel.cancel', compact('getSpr', 'spr', 'id'));
        }

    }

    public function storeBatal(Request $request)
    {

        $spv = auth()->user()->name;

        $tgl = Carbon::now()->format('d-m-Y');
        $AWAL = 'PB';
        $noUrutAkhir = PembatalanUnit::max('id');

        $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

        PembatalanUnit::create([
            'tanggal' => $tgl,
            'no_pembatalan' => $nourut,
            'spr_id' => $request->id_spr,
            'alasan_pembatalan' => $request->alasan,
            'diajukan' => $spv,
            'status' => 'pending',
            'refund' => 'unpaid',
        ]);

        return redirect()->route('supervisor.cancel.index');
    }

    public function nominal(Request $request)
    {
        $no = request()->get('no_transaksi');

        // $where = array($request->rincian_id);
        $where = array($request->rincian_id);
        // return $where;
        $sum = implode(",", $request->rincian_id);
        $count = count($request->rincian_id);

        $data = DB::table('rincian_tagihan_spr')
            ->select('rincian_tagihan_spr.id_rincian', 'rincian_tagihan_spr.jumlah_tagihan')
        // ->groupBy('rincian_tagihan_spr.jumlah_tagihan', 'rincian_tagihan_spr.id_rincian')
        // ->whereIn('id_rincian', [4,5])->where('tipe', 3)->sum('jumlah_tagihan');
            ->whereIn('id_rincian', $request->input('rincian_id', []))->sum('jumlah_tagihan');

        $data1 = Pembayaran::where('rincian_id', $where)->first();

        if ($data1) {
            # code...
            $nominal = $data1->nominal;
            $jumlah_tagihan = $data1->rincian->jumlah_tagihan;
            if ($data1->status_approval == 'paid') {
                # code...
                $data2 = $jumlah_tagihan - $nominal;
                return $data2;
            } else {
                return $data;
            }

        } elseif ($data) {

            return $data;
        }

    }

    public function storeBayar(Request $request)
    {
        $tgl = Carbon::now()->format('d-m-Y');
        $rincian = $request->get('rincian_id');
        $count = count($rincian);

        $sum = implode(",", $request->rincian_id);

        $bayar = Pembayaran::firstOrCreate([
            'id_admin' => auth()->user()->id,
            'no_detail_transaksi' => $request->no_transaksi,
            'tanggal_konfirmasi' => $tgl,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'rincian_id' => $sum,
            'nominal' => $request->nominal,
            'bank_tujuan' => $request->bank_tujuan,
            'id_perusahaan' => '1',
            'status_approval' => 'pending',
        ]);
        if ($bayar->wasRecentlyCreated) {

            for ($i = 0; $i < $count; $i++) {
                BayarTagihan::create([
                    'pembayaran_id' => $bayar->id,
                    'rincian_id' => $rincian[$i],
                ]);
            }
        } 

        return redirect()->back();

    }

    public function hapuskonfirmasi($id)
    {
        $check = Pembayaran::select('rincian_id')->where('id', $id)->first();
        $id_rincian = $check->rincian_id;
        $tagihan = Tagihan::where('id_rincian', $id_rincian)->first();
        $tagihan->status_pembayaran = 'unpaid';
        $tagihan->save();

        $idspr = $tagihan->id_spr;
        $spr = Spr::where('id_transaksi', $idspr)->first();
        $spr->status_booking = 'unpaid';
        $spr->save();

        $idunit = $spr->id_unit;
        $unit = Rumah::where('id_unit_rumah', $idunit)->first();
        $unit->status_penjualan = 'Available';
        $unit->save();
        // dd($test);

        // if ($delete) {
        DB::table('pembayaran_unit')->where('id', $id)->delete();
        // dd($tagihan);
        // }
        return redirect()->back();
    }
}
