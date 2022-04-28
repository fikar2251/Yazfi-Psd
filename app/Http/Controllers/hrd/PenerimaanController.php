<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;

use App\Perusahaan;use App\Project;use App\Reinburst;
use App\RincianReinburst;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index(Reinburst $reinburst, Request $request)
    {
        abort_unless(\Gate::allows('reinburst-access'), 403);
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to])->get();
            $coba = DB::table('rincian_reinbursts')->leftjoin('reinbursts', 'rincian_reinbursts.nomor_reinburst', '=', 'reinbursts.nomor_reinburst')->whereBetween('rincian_reinbursts.created_at', [$from, $to])->sum('rincian_reinbursts.total');
            // dd($coba);
        } else {
            $reinbursts = DB::table('reinbursts')
                ->leftJoin('rincian_reinbursts', 'reinbursts.nomor_reinburst', '=', 'rincian_reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user', 'reinbursts.id', 'reinbursts.tanggal_reinburst', 'reinbursts.nomor_reinburst', 'reinbursts.status_hrd', 'rincian_reinbursts.nomor_reinburst', 'rincian_reinbursts.total', 'reinbursts.status_pembayaran', 'reinbursts.id')
                ->orderBy('reinbursts.id', 'desc')
                ->groupBy('reinbursts.nomor_reinburst')
                ->get();

        }
        return view('hrd.penerimaan.index', compact('reinbursts'));
    }

    public function show(Reinburst $reinburst)
    {$reinbursts = Reinburst::where('id', $reinburst->id)->first();
        $rincianreinbursts = RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();
        return view('hrd.penerimaan.show', compact('reinbursts', 'rincianreinbursts', 'reinburst'));
    }

    public function update($id)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);

        $reinbursts = Reinburst::where('id', $id)->get();

        DB::table('reinbursts')->whereIn('id', $reinbursts)->update(array(
            'status_hrd' => 'review'));

        return redirect()->route('hrd.penerimaan.index')->with('success', 'Update Status berhasil');
    }

    public function statuscompleted($id)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);
        $reinbursts = Reinburst::where('id', $id)->get();

        $reinburstss = Reinburst::
            leftJoin('rincian_reinbursts', 'reinbursts.nomor_reinburst', '=', 'rincian_reinbursts.nomor_reinburst')
            ->select('reinbursts.id_user', 'reinbursts.nomor_reinburst', 'reinbursts.status_hrd', 'reinbursts.status_pembayaran', 'reinbursts.tanggal_reinburst',
                'rincian_reinbursts.total', 'reinbursts.id')->where('reinbursts.status_hrd', '!=', 'completed')
            ->whereIn('reinbursts.id', $reinbursts)
            ->groupBy('reinbursts.nomor_reinburst')
            ->orderBy('reinbursts.id', 'desc')
            ->get();

        DB::table('reinbursts')->whereIn('id', $reinbursts)->update(array(
            'status_hrd' => 'completed'));

        $hutang = DB::table('new_chart_of_account')->where('id', 28)->select('balance')->first();
        $beban = DB::table('new_chart_of_account')->where('id', 59)->select('balance')->first();

        foreach ($reinburstss as $key) {
            # code...
            $transaction = [
                ['chart_id' => 28,
                    'no_transaksi' => $key->nomor_reinburst,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' => $key->total,
                    'debit' => '',
                    'last_balance' => $key->total + $hutang->balance,
                    'template_id' => 3,
                    'is_active' => 1,

                ],
                ['chart_id' => 59,
                    'no_transaksi' => $key->nomor_reinburst,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' => '',
                    'debit' => $key->total,
                    'last_balance' => $beban->balance - $key->total,
                    'template_id' => 4,
                    'is_active' => 1,
                ],
            ];
            DB::table('transactions')->insert($transaction);
            DB::table('new_chart_of_account')->where('id', 28)->update([
                'balance' => $key->total + $hutang->balance,
            ]);
            DB::table('new_chart_of_account')->where('id', 59)->update([
                'balance' => $beban->balance - $key->total,
            ]);

        }

        return redirect()->route('hrd.penerimaan.index')->with('success', 'Update Status berhasil');
    }

}
