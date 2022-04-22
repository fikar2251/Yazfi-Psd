<?php

namespace App\Http\Controllers\Marketing;

use App\Alamat;
use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Marketing;
use App\Provinces;
use App\Skema;
use App\Spr;
use App\Subdistrict;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blok = DB::table('unit_rumah')
        //     ->groupBy('type')
        //     ->get();

        // $spr = Spr::orderBy('id_transaksi', 'desc')->get();

        return view('marketing.spr.index');
    }

    public function mrkJson()
    {
        $idsales = auth()->user()->id;
        $spr = Spr::where('id_sales', $idsales)->orderBy('id_transaksi', 'desc')->get();

        return DataTables::of($spr)
            ->editColumn('no_transaksi', function ($spr) {
                return '<a href="' . route('marketing.spr.detail', $spr->id_transaksi) . '">' . $spr->no_transaksi .
                    '</a>';
            })
            ->editColumn('status_booking', function ($spr) {
                if ($spr->status_booking == 'unpaid') {
                    return '<span class="badge badge-danger">' . $spr->status_booking . '</span>';
                } elseif ($spr->status_booking == 'paid') {
                    return '<span class="badge status-green">' . $spr->status_booking . '</span>';
                }
            })
            ->editColumn('status_dp', function ($spr) {
                if ($spr->status_dp == 'unpaid') {
                    return '<span class="badge badge-danger">' . $spr->status_dp . '</span>';
                } elseif ($spr->status_dp == 'paid') {
                    return '<span class="badge status-green">' . $spr->status_dp . '</span>';
                }
            })
            ->editColumn('type', function ($spr) {
                return $spr->unit->type;
            })
            ->editColumn('total', function ($spr) {
                return $spr->unit->total . '/' . $spr->unit->lb;
            })
            ->editColumn('skema', function ($spr) {
                return $spr->skema_pembayaran->nama_skema;
            })
            ->addIndexColumn()
            ->rawColumns(['no_transaksi', 'status_booking', 'status_dp'])
            ->make(true);
    }

    public function blok(Request $request)
    {
        $blok = [
            'type' => $request->type,
            // 'status_penjualan' => 'Available',
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.status_penjualan')
            ->groupBy('unit_rumah.blok')
            ->where($blok)->whereIn('status_penjualan', ['Available', ''])->get();
        return $data;
    }

    public function no(Request $request)
    {
        $no = [
            'blok' => $request->blok,
            'type' => $request->type,
            // 'status_penjualan' => 'Available',
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.id_unit_rumah', 'unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.status_penjualan')
            ->where($no)->whereIn('status_penjualan', ['Available', ''])->get();

        return $data;
    }

    public function lt(Request $request)
    {
        $lutan = [
            'blok' => $request->blok,
            'type' => $request->type,
            'no' => $request->no,
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.id_unit_rumah', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.harga_jual', 'unit_rumah.lb', 'unit_rumah.nstd', 'unit_rumah.total', 'unit_rumah.total_harga', 'unit_rumah.harga_tanah_lebih')
            ->groupBy('unit_rumah.lt', 'unit_rumah.no')
            ->where($lutan)->get();

        return $data;
    }

    public function hj(Request $request)
    {
        $harju = [
            'blok' => $request->blok,
            'no' => $request->no,
            'lt' => $request->lt,
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.harga_jual', 'unit_rumah.lb')
            ->groupBy('unit_rumah.harga_jual')
            ->where($harju)->get();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $spr = Spr::find($id);
        $alamatid = $spr->alamat_id;
        $add = Alamat::where('id', $alamatid)->first();

        return view('marketing.spr.show', compact('spr', 'add'));
    }

    public function cetakSPR($id)
    {
        $spr = Spr::find($id);
        $idspr = $spr->no_transaksi;
        $alamatid = $spr->alamat_id;
        $add = Alamat::where('id', $alamatid)->first();

        $bf = Tagihan::where(['no_transaksi' => $idspr, 'tipe' => 1])->first();
        $dp = Tagihan::where(['no_transaksi' => $idspr, 'tipe' => 2])->first();

        // $pdf = PDF::loadview('marketing.spr.cetakspr',['spr'=>$spr, 'add'=>$add]);
        // return $pdf->stream();
        // $pdf = PDF::loadView('marketing.spr.cetakspr', $spr);
        // return $pdf->stream('document.pdf');
        $filename = $idspr . '.pdf';
        $mpdf = new \Mpdf\Mpdf();
        $html = FacadesView::make('marketing.spr.cetakspr')->with(['spr' => $spr, 'add' => $add, 'bf' => $bf, 'dp' => $dp]);
        $html->render();
        // $stylesheet = file_get_contents(url('/css/style.css'));
        // $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->WriteHTML($html);
        $mpdf->output($filename, 'I');
    }

    public function showSPR($id)
    {
        $spr = Spr::find($id);
        $add = Alamat::find($id);
        $idspr = $spr->no_transaksi;

        $bf = Tagihan::where(['no_transaksi' => $idspr, 'tipe' => 1])->first();
        $dp = Tagihan::where(['no_transaksi' => $idspr, 'tipe' => 2])->first();

        return view('marketing.spr.cetakspr', compact('spr', 'add', 'bf', 'dp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function storeSpr(Request $request, $id)
    {

        $alamat = Alamat::create([
            'alamat' => $request->alamat,
            'provinsi_id' => $request->provinsi,
            'kota_id' => $request->kota,
            'kecamatan_id' => $request->kecamatan,
            'desa_id' => $request->desa,
        ]);

        $request->validate([
            'nama' => 'required',
            'no_ktp' => 'required|unique:spr',
            'npwp' => 'required|unique:spr',
            'no_tlp' => 'required|unique:spr',
            'no_hp' => 'required|unique:spr',
            'email' => 'required|unique:spr,email',
            'sumber_informasi' => 'required',
            'booking_fee' => 'required',
            'downpayment' => 'required',
        ]);

        $spr = Spr::create([
            'no_transaksi' => $request->no_transaksi,
            'id_sales' => auth()->user()->id,
            'id_project' => $id,
            'id_unit' => $request->id_unit,
            'alamat_id' => $alamat->id,
            'id_perusahaan' => '1',
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'skema' => $request->skema,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'npwp' => $request->npwp,
            'no_tlp' => $request->no_tlp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'status_booking' => 'unpaid',
            'status_approval' => 'pending',
            'status_dp' => 'unpaid',
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->potongan,
            'harga_net' => $request->harga_nett,
            'total_luas_tanah' => $request->tlt,
            'sumber_informasi' => $request->sumber_informasi,
        ]);

        $skema = Skema::select('jumlah_skema')
            ->where('id_skema', $request->skema)
            ->get();

        foreach ($skema as $item) {
            $array = array($item->jumlah_skema);
            $string = implode(" ", $array);
            $int = (int) $string;
        }

        $date = Carbon::now()->format('d-m-Y');
        $tempo = date('d-m-Y', strtotime('+30 days', strtotime($date)));

        // $tempo3 = date('d-m-Y', strtotime('+30 days', strtotime($tempo)));

        $harga_jual = $request->harga_jual;

        $jumlah = $harga_jual / $int;
        $tagihan = round($jumlah);
        $idspr = request()->get('id_transaksi');

        $data = [
            ['tipe' => 1,
                'jumlah_tagihan' => $request->booking_fee,
                'status_pembayaran' => 'unpaid',
                'no_transaksi' => $request->no_transaksi,
                'id_spr' => $spr->id_transaksi,
                'jatuh_tempo' => $tempo,
                'keterangan' => 'Booking Fee',
            ],
            ['tipe' => 2,
                'jumlah_tagihan' => $request->downpayment,
                'status_pembayaran' => 'unpaid',
                'no_transaksi' => $request->no_transaksi,
                'id_spr' => $spr->id_transaksi,
                'jatuh_tempo' => $tempo,
                'keterangan' => 'Downpayment',
            ],
        ];

        $int5 = 30 * $int;

        $date5 = date('d-m-Y', strtotime('+' . $int5 . 'days', strtotime($date)));

        Tagihan::insert($data);
        $a = 1;
        while (strtotime($tempo) <= strtotime($date5)) {
            $tipe3 = [
                ['tipe' => 3,
                    'jumlah_tagihan' => $tagihan,
                    'status_pembayaran' => 'unpaid',
                    'no_transaksi' => $request->no_transaksi,
                    'id_spr' => $spr->id_transaksi,
                    'jatuh_tempo' => $tempo,
                    'keterangan' => 'Cicilan Tahap ' . $a,
                ],
            ];
            Tagihan::insert($tipe3);
            $a++;
            $tempo = date("d-m-Y", strtotime("+30 day", strtotime($tempo)));
        }

        return redirect()->route('marketing.spr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skema = Skema::all();

        $blok = DB::table('unit_rumah')
            ->where('project_id', $id)
            ->groupBy('type')
            ->get();

        $provinces = Provinces::all();

        return view('marketing.spr.create', compact('blok', 'id', 'skema', 'provinces'));
    }

    public function kota(Request $request)
    {
        $city = City::where('id_prov', $request->provinsi)->get();

        return $city;
    }

    public function kecamatan(Request $request)
    {
        $district = District::where('id_kab', $request->kota)->get();

        return $district;
    }

    public function desa(Request $request)
    {
        $subdistrict = Subdistrict::where('id_kec', $request->kecamatan)->get();

        return $subdistrict;
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
