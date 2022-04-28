<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\MstPenerimaan;
use App\MstPotongan;
use App\Pegawai;
use App\User;
use App\Penggajian;
use App\RincianGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penggajians= Penggajian::orderBy('id','desc')->get();
        return view('hrd.gaji.index',compact('penggajians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $noUrutAkhir = Penggajian::max('id');
        $nama ='SL';
        // dd($noUrutAkhir);
         
        return view('hrd.gaji.create', [
            'pegawais' => User::get(),
            'penerimaan' => MstPenerimaan::get(),
            'potongan' => MstPotongan::get(),
            'nourut' => $nama . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $this->validate($request, [
            'pegawai_id' => 'required',
            'tanggal' => 'required|date',
            'total_penerimaan' => 'required',
            'total_potongan' => 'required',
            'total' => 'required'
        ]);
        $pegawai = Penggajian::select('pegawai_id','bulan_tahun')->where('pegawai_id',$request->pegawai_id)->where('bulan_tahun',$request->bulan_tahun)->get();
        // dd($pegawai);
    
        // DB::beginTransaction();
        if (count($pegawai) == 0) {
            $penggajian = Penggajian::create([
                'pegawai_id' => $request->pegawai_id,
                'tanggal' => $request->tanggal,
                'divisi' => $request->roles,
                'bulan_tahun' => $request->bulan_tahun, 
                'tanggal' => $request->tanggal,
                'gaji_pokok' => str_replace(',', '', $request->penerimaan['Gaji Pokok']),
                'jabatan' => $request->jabatans,
                'perusahaan' => $request->perusahaans,
                'slip_gaji' => $request->slip_gaji,
                'note' => $request->note,
                'admin' => auth()->user()->name,
                'status_penerimaan' => 'pending',
            ]);
            // dd($penggajian);
            foreach ($request->penerimaan as $key => $value) {
                RincianGaji::create([
                    'penggajian_id' => $penggajian->id,
                    'nama' => $key,
                    'tipe' => 'penerimaan',
                    'nominal' => str_replace(',', '', $value)
                ]);
            }
            foreach ($request->potongan as $key => $value) {
                RincianGaji::create([
                    'penggajian_id' => $penggajian->id,
                    'nama' => $key,
                    'tipe' => 'potongan',
                    'nominal' => str_replace(',', '', $value)
                ]);
            }

            $beban = DB::table('new_chart_of_account')->where('id', 59)->select('balance')->first();
            $hutang = DB::table('new_chart_of_account')->where('id', 28)->select('balance')->first();
    
            $transaction = [
                ['chart_id' => 59,
                    'no_transaksi' => $request->slip_gaji,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' =>'',
                    'debit' =>  $request->total,
                    'last_balance' => $beban->balance - $request->total ,
                    'template_id' => 7,
                    'is_active' => 1
    
                ],
                ['chart_id' => 28,
                    'no_transaksi' => $request->slip_gaji,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' =>  $request->total,
                    'debit' => '',
                    'last_balance' => $hutang->balance + $request->total,
                    'template_id' => 8,
                    'is_active' => 1
                ],
            ];
            DB::table('transactions')->insert($transaction);
            DB::table('new_chart_of_account')->where('id', 59)->update([
                'balance' => $beban->balance - $request->total
            ]);
            DB::table('new_chart_of_account')->where('id', 28)->update([
                'balance' => $hutang->balance + $request->total
            ]);

            DB::commit();
            return redirect()->route('hrd.gaji.index')->with('success', 'Penggajian has been added');
        } else {
            
            return back()->with('error', 'Data Pegawai Sudah Pernah Dibuat');
            
        }
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        return view('hrd.gaji.show', [
            'penggajian' => Penggajian::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('hrd.gaji.edit', [
             'pegawais' => User::get(),
                'penggajian' => Penggajian::findOrFail($id)
        ]);
      
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
        $this->validate($request, [
            'pegawai' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'total_penerimaan' => 'required',
            'total_potongan' => 'required',
            'total' => 'required'
        ]);
        
        DB::beginTransaction();
        
            Penggajian::findOrFail($id)->update([
                'pegawai_id' => $request->pegawai,
                'tanggal' => $request->tanggal,
                'divisi' => $request->roles,
                'bulan_tahun' => $request->bulan_tahun, 
                'tanggal' => $request->tanggal,
                'gaji_pokok' => str_replace(',', '', $request->penerimaan['Gaji Pokok']),
                'jabatan' => $request->jabatans,
                'note' => $request->note,
                'perusahaan' => $request->perusahaans,
                'admin' => auth()->user()->name,
            ]);
            RincianGaji::where('penggajian_id', $id)->where('tipe','penerimaan')->delete();
            foreach ($request->penerimaan as $key => $value) {
                RincianGaji::create([
                    'penggajian_id' => $id,
                    'nama' => $key,
                    'tipe' => 'penerimaan',
                    'nominal' => str_replace(',', '', $value)
                ]);
            }
            RincianGaji::where('penggajian_id', $id)->where('tipe', 'potongan')->delete();
            foreach ($request->potongan as $key => $value) {
                RincianGaji::create([
                    'penggajian_id' => $id,
                    'nama' => $key,
                    'tipe' => 'potongan',
                    'nominal' => str_replace(',', '', $value)
                ]);
            }

            $beban = DB::table('new_chart_of_account')->where('id', 59)->select('balance')->first();
            $hutang = DB::table('new_chart_of_account')->where('id', 28)->select('balance')->first();
    
            $transaction = [
                ['chart_id' => 59,
                    'no_transaksi' => $request->slip_gaji,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' =>'',
                    'debit' =>  $request->total,
                    'last_balance' => $beban->balance - $request->total ,
                    'template_id' => 7,
                    'is_active' => 1
    
                ],
                ['chart_id' => 28,
                    'no_transaksi' => $request->slip_gaji,
                    'month' => Carbon::now()->format('m'),
                    'year' => Carbon::now()->format('Y'),
                    'date' => Carbon::now()->format('d-m-Y'),
                    'time' => Carbon::now()->format('h:i:s'),
                    'credit' =>  $request->total,
                    'debit' => '',
                    'last_balance' => $hutang->balance + $request->total,
                    'template_id' => 8,
                    'is_active' => 1
                ],
            ];
            DB::table('transactions')->insert($transaction);

            DB::commit();
            return redirect()->route('hrd.gaji.index')->with('success', 'Penggajian has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
       $penggajian = Penggajian::where('id',$id)->get();
        foreach ($penggajian as $peng) {
            RincianGaji::where('penggajian_id', $peng->penggajian_id)->delete();
        
            $peng->delete();
        }
        
       
      return redirect()->route('hrd.gaji.index')->with('success', 'Penggajian has been deleted');
    }
    public function filter(Request $request)
    {
        $this->validate($request,[
            'start' => 'required',
            'end' => 'required'
        ]);
        return view('hrd.gaji.index', [
            'penggajians' => Penggajian::whereBetween('tanggal',[$request->start,$request->end])->get()
        ]);
    }
    public function print($id)
    {
        return view('hrd.gaji.print',[
            'gaji' => Penggajian::findOrFail($id)
        ]);
    }
    public function searchPegawai(Request $request)
    {
        $data = [];
        $tukar = User::select(
            "id",
            "name",
            "id_jabatans",
            "id_perusahaan", 
            "id_roles") 
            ->where('id',$request->id)
            ->get();
            $roles= DB::table('model_has_roles')
            ->leftJoin('users','model_has_roles.model_id','=','users.id')
            ->leftJoin('roles','model_has_roles.role_id','=','roles.id')
            ->leftJoin('jabatans','jabatans.id','=','users.id_jabatans')
            ->leftJoin('gajians','gajians.id_role','=','model_has_roles.role_id')
            ->leftJoin('perusahaans','perusahaans.id','=','users.id_perusahaan')
            ->select('users.id','gajians.gaji','users.id_jabatans','users.id_perusahaan','jabatans.nama','users.name','roles.key','perusahaans.nama_perusahaan')
            ->where('users.id',$request->id)->get();
            // dd($roles);
            

            foreach ($roles as $value) {
                $data[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'id_jabatans' => $value->nama,
                    'id_roles' => $value->key,
                    'id_perusahaan' => $value->nama_perusahaan,
                    'gaji' => $value->gaji,
                ];
            }
          
        return response()->json($data);
    }

    
      public function loadpegawai(Request $request)
    {
        $data = [];
        $pegawai =  User::select('name','id')
            ->where('name', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($pegawai as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->name];
        }
    		return response()->json($data);
        

    }
}
