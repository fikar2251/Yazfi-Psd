<?php

namespace App\Http\Controllers\hrd;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\{User, Cabang, Pengajuan, Perusahaan, RincianPengajuan};
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index(Pengajuan $pengajuan, Request $request)
    {
        
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d');
            $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->whereBetween('tanggal_pengajuan', [$from, $to])->get();
          
        } else {
            $pengajuans = Pengajuan::where('id_user', Auth::user()->id)
            ->orderBy('id','desc')
            ->groupBy('nomor_pengajuan')
            ->get();
            }
   
            return view('hrd.pengajuan.index', compact('pengajuans'));
        }

    public function create()
    {
        $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->get();
        $perusahaans = Perusahaan::get();
        // $barangs = Barang::where('id_jenis', '1')->get();
        $projects = Project::get();
        $AWAL = 'PD';
        $noUrutAkhir = \App\Pengajuan::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        return view('hrd.pengajuan.create', compact( 'perusahaans', 'pengajuans', 'projects', 'nourut'));
    }
    public function store(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            // 'nomor_pengajuan' => 'required',
            // 'grandtotal' => 'required',
            // 'total' => 'required',
            // 'no_kwitansi' => 'required',
            // 'nama' => 'required',
            // 'perusahaan' => 'required',
            // 'tanggal' => 'required',
            // 'lampiran.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        ]);

        $barang = $request->input('barang_id', []);
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $files = $request->file('file');

            foreach ($files as $file) {
                $AWAL = 'PD';
                $noUrutAkhir = \App\Pengajuan::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/pengajuan', $name);

                $attr[] = [
                    'nomor_pengajuan' => $request->nomor_pengajuan,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' =>  $request->id_perusahaan,
                    'tanggal_pengajuan' => $request->tanggal,
                    'approval_time' => $request->tanggal,
                    'status_approval' => 'pending',
                    'approval_by' => 'pending',
                    'id_roles' => 8,

                ];
                // dd($attr);
                foreach ($barang as $key => $no) {
                    $in[] = [
                        'barang_id' => $no,
                        'PPN' => $request->PPN,
                        'harga_beli' => $request->harga_beli[$key],
                        'keterangan' => $request->keterangan[$key],
                        'qty' => $request->qty[$key],
                        'total' => $request->harga_beli[$key] * $request->qty[$key],
                        'nomor_pengajuan' => $request->nomor_pengajuan,
                        'grandtotal' => $request->grandtotal,
                        'unit' => $request->unit[$key],
                        'no_kwitansi' => $request->no_kwitansi,
                        'tanggal_pengajuan' => $request->tanggal,
                        'id_user' => auth()->user()->id,
                    ];
                    // dd($in);
                }
                RincianPengajuan::insert($in);
                Pengajuan::insert($attr);
            }
        }
        DB::commit();
        return redirect()->route('hrd.pengajuan.index')->with('success', 'Pengajuan Dana barang berhasil');
    }

    public function pdf($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->get();
        $jabatan = DB::table('users')
            ->leftJoin('jabatans', 'users.id_jabatans', '=', 'jabatans.id')
            ->leftJoin('roles', 'users.id_roles', '=', 'roles.id')
            ->leftJoin('pengajuans', 'users.id_perusahaan', '=', 'pengajuans.id_perusahaan')
            ->select('jabatans.nama', 'users.name', 'roles.name','pengajuans.id')
            ->where('pengajuans.id', $id)
            ->first();
        return view('hrd.pengajuan.pdf',compact('pengajuan','jabatan'));
    }
    public function show(Pengajuan $pengajuan)
    {

        $pengajuans = Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->get();
        $jabatan = DB::table('users')
            ->leftJoin('jabatans', 'users.id_jabatans', '=', 'jabatans.id')
            ->leftJoin('roles', 'users.id_roles', '=', 'roles.id')
            ->leftJoin('pengajuans', 'users.id_perusahaan', '=', 'pengajuans.id_perusahaan')
            ->select('jabatans.nama', 'users.name', 'roles.name')
            ->where('pengajuans.nomor_pengajuan', $pengajuan->nomor_pengajuan)
            ->first();

        return view('hrd.pengajuan.show', compact('pengajuan', 'pengajuans', 'jabatan'));
    }

    public function edit(RincianPengajuan $rincian, Pengajuan $pengajuan)
    {
        $pengajuans = RincianPengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->first();
        $rincians = RincianPengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->get();
        // dd($pengajuans);
     
        $perusahaans = Perusahaan::get();
   

        return view('hrd.pengajuan.edit', compact('perusahaans', 'pengajuan', 'pengajuans','rincians'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            // 'nomor_pengajuan' => 'required',
            // 'grandtotal' => 'required',
            // 'total' => 'required',
            // 'no_kwitansi' => 'required',
            // 'nama' => 'required',
            // 'perusahaan' => 'required',
            // 'tanggal' => 'required',
            // 'lampiran.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        ]);
       
        $barang = $request->input('barang_id', []);
       
            // $rincian_pengajuan = RincianPengajuan::where('barang_id', auth()->user()->pengajuan_id)->where('barang_id', $no)->first();
            // dd($rincian_pengajuan);

            // $rincian_pengajuan->update([
            //     'qty' => $rincian_pengajuan->qty + $request->qty[$key]
            // ]);

        if ($request->hasFile('file')) {
            $files = $request->file('file');

            foreach ($files as $file) {
                $AWAL = 'PD';
                $noUrutAkhir = \App\Pengajuan::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/pengajuan', $name);
                $pengajuan = Pengajuan::where('id', $pengajuan->id)->where('id_user', $pengajuan->id_user)->first();
               dd($pengajuan);
                $pengajuan->update([
                    'nomor_pengajuan' => $request->nomor_pengajuan,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' =>  $request->id_perusahaan,
                    'tanggal_pengajuan' => $request->tanggal,
                    'approval_time' => $request->tanggal,
                    'status_approval' => 'pending',
                    'approval_by' => 'pending',
                    'id_roles' => auth()->user()->id_roles,

                ]);
                // dd($attr);
            }
        }
        foreach ($barang as $key => $no) {
            $rincian = RincianPengajuan::where('id', $pengajuan->id)->where('barang_id', $no)->first();
        //    dd($rincian);
            $rincian->update([
                'barang_id' => $no,
                'PPN' => $request->PPN,
                'harga_beli' => $request->harga_beli[$key],
                'keterangan' => $request->keterangan[$key],
                'qty' => $request->qty[$key],
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'nomor_pengajuan' => $request->nomor_pengajuan,
                'grandtotal' => $request->grandtotal,
                'unit' => $request->unit[$key],
                'no_kwitansi' => $request->no_kwitansi,
                'tanggal_pengajuan' => $request->tanggal,
            ]);
            // dd($in);
        }
        

        return redirect()->route('hrd.pengajuan.index')->with('success', 'Pengajuan barang berhasil');
    }

    

    public function destroy($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->get();
        // dd($pengajuan);

        foreach ($pengajuan as $pur) {
            RincianPengajuan::where('nomor_pengajuan', $pur->nomor_pengajuan)->delete();
        
            $pur->delete();
        }

        return redirect()->route('hrd.pengajuan.index')->with('success', 'Pengajuan Dana barang didelete');
    }

    public function whereProject(Request $request)
    {
        $data = DB::table('projects')
            ->select('projects.alamat_project')
            ->groupBy('projects.alamat_project')
            ->where('projects.id', $request->id)->get();
        return $data;
        dd($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  Barang::where('id_jenis', 'barang_id')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return redirect()->route('hrd.pengajuan.index')->with('success', 'Pengajuan barang didelete');
    }
    public function WhereUnit(Request $request)
    {
        $data = [];
        $unit =  DB::table('units')
            ->where('nama', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($unit as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama];
        }

        return response()->json($data);
    }	
}
