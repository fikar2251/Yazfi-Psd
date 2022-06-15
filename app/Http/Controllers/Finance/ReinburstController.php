<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Reinburst;
use App\RincianReinburst;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ReinburstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to])->where('id_user',auth()->user()->id)->get();
            $coba = DB::table('rincian_reinbursts')->leftjoin('reinbursts','rincian_reinbursts.nomor_reinburst','=','reinbursts.nomor_reinburst')->whereBetween('rincian_reinbursts.created_at', [$from, $to])->where('reinbursts.id_user',auth()->user()->id)->sum('rincian_reinbursts.total') ;
            // dd($coba);
        } else {
            $reinbursts = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
            ->select('reinbursts.id_user','reinbursts.id','reinbursts.tanggal_reinburst','reinbursts.nomor_reinburst','reinbursts.status_hrd','rincian_reinbursts.nomor_reinburst','rincian_reinbursts.total','reinbursts.status_pembayaran','reinbursts.id')
            ->orderBy('reinbursts.id','desc')
            ->groupBy('reinbursts.nomor_reinburst')
            ->where('reinbursts.id_user',auth()->user()->id)
            ->get();
            
        
        }
        
        return view('finance.accounting.reinburst.index', compact('reinbursts'));
    }

    public function ajax_reinburst(Request $request){

        if(request()->ajax()){
            if(!empty($request->from)){
                $reinbursts = Reinburst::
                leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
                'rincian_reinbursts.total','reinbursts.id')->where('reinbursts.id_user',auth()->user()->id)
                ->whereBetween('reinbursts.tanggal_reinburst', array($request->from, $request->to))
                ->groupBy('reinbursts.nomor_reinburst')
                ->orderBy('reinbursts.id', 'desc')
                ->get();
                // dd($reinbursts);

            }else{


                $reinbursts = Reinburst::
                leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
                ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
                'rincian_reinbursts.total','reinbursts.id')->where('reinbursts.id_user',auth()->user()->id)
                ->groupBy('reinbursts.nomor_reinburst')
                ->orderBy('reinbursts.id', 'desc')
                ->get();
                // dd($reinbursts);

            }

        return datatables()
            ->of($reinbursts)
            ->editColumn('no_reinburst', function ($reinburst) {
                return '<a href="' . route("marketing.reinburst.show", $reinburst->id) . '">' . $reinburst->nomor_reinburst . '</a>';
            })
            ->editColumn('tanggal', function ($reinburst) {
                return Carbon::parse($reinburst->tanggal_reinburst)->format('d/m/Y');
            })
            ->editColumn('total', function ($reinburst) {
                return \App\RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->count();
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
            ->editColumn('action', function ($data) {
                
               $reinburst = Reinburst::where('id', $data->id)->where('status_hrd', 'pending')->get();
                if (count($reinburst)==0){
                   return '<a href="' . route('finance.reinburst.pdf', $data->id) . '"class="btn btn-sm btn-secondary"><i class="fa-solid fa-print"></i></a>';
                }else {
                 return '<a href="' . route('finance.reinburst.pdf', $data->id) . '"class="btn btn-sm btn-secondary"><i class="fa-solid fa-print"></i></a>
                <a href="' . route('finance.reinburst.edit', $data->id) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                <a href="' .  route('finance.reinburst.destroy', $data->id). '" class="delete-form btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
             
                } 

            })
            ->addIndexColumn()
            ->rawColumns(['no_reinburst','status_hrd','status_pembayaran','action'])
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AWAL = 'RN';
        $noUrutAkhir = \App\Reinburst::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        $projects = Project::get();
        return view('finance.accounting.reinburst.create', compact('projects', 'nourut'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required',

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
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);
                $users = auth()->user()->id;
                $roles= DB::table('model_has_roles')
                        ->leftJoin('users','model_has_roles.model_id','=','users.id')
                        ->leftJoin('roles','model_has_roles.role_id','=','roles.id')
                        ->select('roles.id')
                        ->where('users.id',$users)->value('id');

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
                    'id_roles' => $roles
                ];
                foreach ($barang as $key => $no) {
                    $in[] = [
                        'id_user' => auth()->user()->id,
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
        return redirect()->route('finance.reinburst.index')->with('success', 'Reinburst has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reinburst $reinburst)
    {
        $reinbursts = Reinburst::where('id', $reinburst->id)->first();
        $rincianreinbursts = RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();
        return view('finance.accounting.reinburst.show', compact('reinbursts', 'rincianreinbursts', 'reinburst'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reinburst $reinburst)
    {
        $reinbursts = Reinburst::where('id', $reinburst->id)->get();
        $peng = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts', 'reinbursts.nomor_reinburst', '=', 'rincian_reinbursts.nomor_reinburst')
            ->where('rincian_reinbursts.nomor_reinburst', $reinburst->nomor_reinburst)
            ->select('rincian_reinbursts.harga_beli', 'rincian_reinbursts.total', 'rincian_reinbursts.catatan', 'rincian_reinbursts.no_kwitansi')
            ->get();
        $projects = Project::get();

        return view('finance.accounting.reinburst.edit', compact('reinburst', 'reinbursts', 'peng', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reinburst $reinburst)
    {
        $files = $request->file('file');

        if ($request->hasFile('file')) {
            $files = $request->file('file');

            $filelama = public_path('uploads/file/reinburst/' . $reinburst->file);
            File::delete($filelama);
            Reinburst::where('nomor_reinburst',$request->nomor_reinburst)->delete();
            foreach ($files as $file) {
     
                $AWAL = 'PD';
                $noUrutAkhir = \App\Reinburst::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir)) . '/' . sprintf("%05s", abs($noUrutAkhir));
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);
                $users = auth()->user()->id;
                $roles= DB::table('model_has_roles')
                        ->leftJoin('users','model_has_roles.model_id','=','users.id')
                        ->leftJoin('roles','model_has_roles.role_id','=','roles.id')
                        ->select('roles.id')
                        ->where('users.id',$users)->value('id');

                Reinburst::create([
                   'nomor_reinburst' => $request->nomor_reinburst,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' => auth()->user()->id_perusahaan,
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'id_jabatans' => $request->id_jabatans,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => $roles

                ]);
            }
            
             $barang = $request->input('no_kwitansi', []);
                DB::beginTransaction();
                RincianReinburst::where('nomor_reinburst',$request->nomor_reinburst)->delete();
                foreach ($barang as $key => $no) {
                    $rincian_reinburst = RincianReinburst::create([
                        'id_user' => auth()->user()->id,
                        'no_kwitansi' => $request->no_kwitansi[$key],
                        'harga_beli' => $request->harga_beli[$key],
                        'catatan' => $request->catatan[$key],
                        'total' => $request->harga_beli[$key],
                        'nomor_reinburst' => $request->nomor_reinburst,
                    ]);
                    //   dd($rincian_reinburst);
                    
                }
        }
        
        DB::commit();

        return redirect()->route('finance.reinburst.index')->with('success', 'Reinburst has been updated');
    }

    public function pdf($id)
    {
        $reinbursts = Reinburst::where('id', $id)->first();
        // dd($reinbursts);
        // $rincianreinbursts = RincianReinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();
        return view('finance.accounting.reinburst.pdf', compact('reinbursts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reinbursts = Reinburst::where('id', $id)->get();


        foreach ($reinbursts as $pur) {
            RincianReinburst::where('nomor_reinburst', $pur->nomor_reinburst)->delete();
              $filelama = public_path('uploads/file/reinburst/' . $pur->file);
            File::delete($filelama);
            $pur->delete();
        }


        return redirect()->route('supervisor.reinburst.index')->with('success', 'Reinburst has been deleted');
    }
}
