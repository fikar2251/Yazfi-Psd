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

class PenerimaanController extends Controller
{
    public function index(Reinburst $reinburst,Request $request)
    {
        abort_unless(\Gate::allows('reinburst-access'), 403);
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to])->get();
            $coba = DB::table('rincian_reinbursts')->leftjoin('reinbursts','rincian_reinbursts.nomor_reinburst','=','reinbursts.nomor_reinburst')->whereBetween('rincian_reinbursts.created_at', [$from, $to])->sum('rincian_reinbursts.total') ;
            // dd($coba);
        } else {
            $reinbursts = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
            ->select('reinbursts.id_user','reinbursts.id','reinbursts.tanggal_reinburst','reinbursts.nomor_reinburst','reinbursts.status_hrd','rincian_reinbursts.nomor_reinburst','rincian_reinbursts.total','reinbursts.status_pembayaran','reinbursts.id')
            ->orderBy('reinbursts.id','desc')
            ->groupBy('reinbursts.nomor_reinburst')
            ->get();
            
        
        }
        return view('hrd.penerimaan.index', compact('reinbursts'));
    }

   
    public function show(Reinburst $reinburst)
    {   $reinbursts = Reinburst::where('id', $reinburst->id)->first();
        $rincianreinbursts = RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();
        return view('hrd.penerimaan.show', compact('reinbursts','rincianreinbursts','reinburst'));
    }

    public function update($id)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);
          
        $reinbursts = Reinburst::where('id',$id)->get();
       
        DB::table('reinbursts')->whereIn('id', $reinbursts)->update(array( 
            'status_hrd' => 'review'));

            return redirect()->route('hrd.penerimaan.index')->with('success', 'Update Status berhasil');
    }

    public function statuscompleted($id)
    {
        abort_unless(\Gate::allows('reinburst-edit'), 403);
        $reinbursts = Reinburst::where('id',$id)->get();
       
        DB::table('reinbursts')->whereIn('id', $reinbursts)->update(array( 
            'status_hrd' => 'completed'));


        return redirect()->route('hrd.penerimaan.index')->with('success', 'Update Status berhasil');
    }

}
