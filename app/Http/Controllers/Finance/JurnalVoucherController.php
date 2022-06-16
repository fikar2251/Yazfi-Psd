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
        $AWAL = 'JV';
        $noUrutAkhir = \App\Reinburst::max('id');
        $max = DB::table('transactions')->min('id');
        $date = Carbon::now()->format('Ymd');
        $noawal = 0;
        $nourut = ($AWAL) . ($date) . 0 . ($noawal + 1);
        $end = substr($nourut, 11);
        if ($end == 1) {
            return view('finance.accounting.jurnal.index', compact('nourut'));
        }else{
            return 'false';
            return view('finance.accounting.jurnal.index');
        }
        // dd($end);
        // return max($end,0);
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
        //
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
        
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();
        foreach ($account as $key => $no) {
            $attr[] = [
                'chart_id' => $request->account_name[$key],
                'debit' => $request->debit[$key],
                'credit' => $request->credit[$key],
                'no_transaksi' => $request->no_voucher,
                'month' => Carbon::now()->format('m'),
                'year' => Carbon::now()->format('Y'),
                'date' => Carbon::now()->format('d-m-Y'),
                'time' => Carbon::now()->format('h:i:s'),
                'last_balance' => 0,
                'template_id' => 23,
                'is_active' => 1,
                'transaksi_id' => 0,
            ];

           
        }

        DB::table('transactions')->insert($attr);

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
        //
    }
}
