<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Pembatalan;
use App\PembatalanUnit;
use App\Pembayaran;
use App\Refund;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RefundController extends Controller
{
    public function index()
    {
        $getno = request()->get('no_pembatalan');
        $batal = PembatalanUnit::orderBy('id', 'desc')->get();
        if ($getno) {

            $singlebatal = PembatalanUnit::where('no_pembatalan', $getno)->first();
            $idspr = $singlebatal->spr_id;

            $rincianid = Tagihan::where('id_spr', $idspr)->first();
            $getrincianid = $rincianid->id_rincian;

            $singlebayar = Pembayaran::where('rincian_id', $getrincianid)->first();
            $notrs = $singlebatal->spr->no_transaksi;

            $totalbayar = Pembayaran::whereHas('rincian', function ($r) {
                $getno = request()->get('no_pembatalan');
                $singlebatal = PembatalanUnit::where('no_pembatalan', $getno)->first();
                $notrs = $singlebatal->spr->no_transaksi;

                $r->where('no_transaksi', $notrs);
                $r->whereIn('tipe', [2, 3]);
            })->where('status_approval', 'paid')->sum('nominal');

            // dd($contoh);

            $idbatal = $singlebatal->no_pembatalan;
            $account = DB::table('chart_of_account')->select('id_chart_of_account', 'nama_bank')->get();

            $refund = Refund::where('no_pembatalan', $getno)->first();
            if ($refund) {
                $idbatal1 = $refund->no_pembatalan;

                return view('finance.refund.index', compact('batal', 'singlebatal', 'singlebayar', 'idbatal1', 'totalbayar', 'account'));
            } else {
                $idbatal1 = '';
                return view('finance.refund.index', compact('batal', 'singlebatal', 'singlebayar', 'idbatal1', 'totalbayar', 'account'));
            }

        } else {
            $batal = PembatalanUnit::orderBy('id', 'desc')->get();

            return view('finance.refund.index', compact('batal'));

        }

    }

    public function storeRefund(Request $request)
    {

        $tgl = Carbon::now()->format('d-m-Y');
        Refund::create([
            'no_refund' => $request->no_refund,
            'tanggal_refund' => $tgl,
            'no_pembatalan' => $request->no_pembatalan,
            'diajukan' => $request->diajukan,
            'total_refund' => $request->total_refund,
            'status' => 'unpaid',
            'sumber_pembayaran' => $request->sumber_pembayaran,
            'rekening_tujuan' => $request->rekening,
            'pembatalan_id' => $request->pembatalan_id,
        ]);

        return redirect('finance/refund/daftar');
    }

    function list() {
        $refund = Refund::orderBy('no_refund', 'desc')->where('status', 'paid')->get();

        return view('finance.refund.list', compact('refund'));
    }

    public function listRefund()
    {

        $refund = Refund::orderBy('no_refund', 'desc')->whereIn('status', ['unpaid', 'reject'])->get();

        $account = DB::table('chart_of_account')->select('id_chart_of_account', 'nama_bank')->get();

        return view('finance.refund.daftar', compact('refund', 'account'));

    }
    public function refundJson(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $refund = Refund::orderBy('no_refund', 'desc')->where('status', 'paid')
                    ->whereBetween('tanggal_pembayaran', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $refund = Refund::orderBy('no_refund', 'desc')->where('status', 'paid')->get();
            }

            return DataTables::of($refund)
                ->editColumn('refund', function ($refund) {
                    if ($refund->status == 'unpaid') {
                        return '<span class="badge badge-danger">' . $refund->status . '</span>';
                    } elseif ($refund->status == 'paid') {
                        return '<span class="badge status-green">' . $refund->status . '</span>';
                    }
                })
                ->editColumn('konsumen', function ($refund) {
                    return $refund->pembatalan->spr->nama;
                })
                ->editColumn('sales', function ($refund) {
                    return $refund->pembatalan->spr->user->name;
                })
                ->addIndexColumn()
                ->rawColumns(['refund', 'konsumen', 'sales'])
                ->make(true);
        }
    }

    public function storeListRefund(Request $request)
    {
        $status = $request->get('status');
        $itemid = $request->get('id');
        $sumber = $request->get('sumber_pembayaran');
        $tgl = $request->get('tanggal_pembayaran');
        // dd($tgl);
        $count_status = count($status);

        for ($i = 0; $i < $count_status; $i++) {
            $change = Refund::where('id', $itemid[$i])->first();

            $change->update([
                'status' => $status[$i],
                'tanggal_pembayaran' => $tgl[$i],
                'sumber_pembayaran' => $sumber[$i],
            ]);
            $idbatal = $change->pembatalan_id;

            $batal = PembatalanUnit::where('id', $idbatal)->first();
            $batal->refund = 'paid';
            $batal->save();

        }
        if ($change->status == 'paid') {
            # code...
            return redirect('finance/refund/list');
        } else {
            return redirect()->back();
        }

    }

    public function updateStatus($id)
    {
        $refund = Refund::find($id);
        $refund->status = 'paid';
        $refund->save();

        $idbatal = $refund->pembatalan_id;

        $batal = PembatalanUnit::where('id', $idbatal)->first();
        $batal->refund = 'paid';
        $batal->save();

        return redirect()->back();
    }

}
