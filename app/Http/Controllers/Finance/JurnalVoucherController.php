<?php

namespace App\Http\Controllers\Finance;

use App\ChartOfAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JurnalVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
       return view('finance.accounting.jurnal.index');
        // dd($end);
        // return max($end,0);
    }

    public function ajax_jurnal()
    {
        $transactions = DB::table('transactions AS tr')
        ->leftJoin('template_accounting', 'template_accounting.id', '=', 'tr.template_id')
        ->leftJoin('new_chart_of_account AS chart', 'chart.id', '=', 'tr.chart_id')
        ->select('template_accounting.name','tr.id as ids', 'tr.no_transaksi', 
        'tr.date', 'chart.deskripsi', 'tr.credit', 
        'tr.debit', 'tr.last_balance')->where('template_id', 25)
        ->get();
        // dd($transactions);

        return datatables()
            ->of($transactions)
            ->editColumn('sumber', function ($transactions) {
                return ' ' . $transactions->name . ' ' . $transactions->no_transaksi . ' ';
            })
            ->editColumn('tanggal', function ($transactions) {
               $tanggal = Carbon::parse($transactions->date)->format('d-m-Y');
               return $tanggal;
            })
            ->editColumn('deskripsi', function ($transactions) {
               return $transactions->deskripsi;
            })

            ->editColumn('debit', function ($transactions) {
                if ($transactions->debit == '') {
                    return ' ';
                }else{
                    return $transactions->debit;
                }
            })
            ->editColumn('credit', function ($transactions) {
                if ($transactions->credit == '') {
                    return ' ';
                }else{
                    return $transactions->credit;
                }
            })
            ->editColumn('saldo', function ($transactions) {
                if ($transactions->last_balance == '') {
                    return ' ';
                }else{
                    return $transactions->last_balance;
                }
            })
            ->editColumn('action', function ($transactions) {
                return
                ' <form method="post" action="' . "/finance/jurnal/$transactions->ids" .  '">
                <input type="hidden" class="form-control" name="_method" value="DELETE">
                <input type="hidden" class="form-control" name="_token" value="' . csrf_token() . '">
               
                <button type="submit" class="btn btn-danger"><i
                        class="fa fa-trash"></i>
                </button>
            
                </form>';
            })

            ->addIndexColumn()
            ->rawColumns(['sumber', 'tanggal', 'deskripsi' , 'debit', 'credit', 'saldo', 'action'])
            ->make(true);
    }

    public function accName(Request $request)
    {
        $data = [];
        $product =  ChartOfAccount::where('deskripsi', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->deskripsi];
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AWAL = 'JV';
        $noUrutAkhir = \App\Reinburst::max('id');
        $max = DB::table('transactions')->min('id');
        $date = Carbon::now()->format('Ymd');
        $noawal = 0;
        $nourut = ($AWAL) . ($date) . 0 . ($noawal + 1);
        $end = substr($nourut, 11);
        if ($end == 0) {
            return view('finance.accounting.jurnal.create', compact('nourut'));
        }elseif($end != 0){
            // return 'false';
            $query = DB::table('transactions')->select('no_transaksi')->where('no_transaksi', 'like', '%JV%')->max('no_transaksi');
            $last =  substr($query, 11);
            $nourut = ($AWAL) . ($date) . 0 . ($last + 1);
            return view('finance.accounting.jurnal.create', compact('nourut'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'supplier_id' => 'required',
        //     'barang_id' => 'required',
        //     'qty' => 'required',
        //     'harga_beli' => 'required',
        //     'invoice' => 'required',
        // ]);

        $account = $request->input('account_name', []);

        // $debit = DB::table('new_chart_of_account')->where('id', $account)->select('balance')->first();
        // $credit = DB::table('new_chart_of_account')->where('id', $account)->select('balance')->first();
        
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();
        $sum = 0;
        foreach ($account as $key => $no) {
            $debits = DB::table('new_chart_of_account')->where('id', $request->account_name[$key])->get();
            foreach ($debits as $deb) {
                # code...
                $attr[] = [
                    'chart_id' => $request->account_name[$key],
                    'debit' => $request->debit[$key] ? $request->debit[$key] : '',
                    'credit' => $request->credit[$key] ? $request->credit[$key] : '',
                    'no_transaksi' => $request->no_voucher,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'last_balance' => $request->debit[$key] != 0 ? $deb->balance - $request->debit[$key] :  (
                        $request->credit[$key] != 0 ? $deb->balance + $request->credit[$key] : ''
                    ),
                    'template_id' => 25,
                    'is_active' => 1,
                    'transaksi_id' => 0,
                ];
               
                if ($request->debit[$key] != '') {
                    if ($request->total == $request->totals) {
                        DB::table('new_chart_of_account')->where('id', $request->account_name[$key])->update([
                            'balance' => $deb->balance - $request->debit[$key],
                        ]);
                    }else{
                        return redirect()->back();
                    }
                }elseif ($request->credit[$key] != 0) {
                    if ($request->total == $request->totals) {
                       
                        DB::table('new_chart_of_account')->where('id', $request->account_name[$key])->update([
                            'balance' => $deb->balance + $request->credit[$key],
                        ]);
                    }else{
                        return redirect()->back();
                    }
                }
            } 
            // return  $request->credit[$key];
            
        }
        if ($request->total == $request->totals) {
           
            DB::table('transactions')->insert($attr);
        }else{
            return redirect()->back();
        }
        // return $request->totals;
        
        // return $attr;

        DB::commit();

        return redirect()->route('finance.jurnal.index')->with('success', 'Add voucher berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = DB::table('transactions')->where('transactions.id', $id)
            ->leftJoin('new_chart_of_account', 'new_chart_of_account.id', '=', 'transactions.chart_id')
            ->first();
            
            if ($test->credit != '') {
                DB::table('new_chart_of_account')->where('id', $test->chart_id)
                    ->update([
                        'balance' => $test->balance - $test->credit,
                    ]);
            } elseif ($test->debit != '') {
                DB::table('new_chart_of_account')->where('id', $test->chart_id)
                    ->update([
                        'balance' => $test->balance + $test->debit,
                    ]);
            }

       
        DB::table('transactions')->where('transaksi_id', $id)->delete();

        return redirect()->back();
    }
}
