<?php

namespace App\Http\Controllers\hrd;

use App\Gajians;
use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class RincianGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gajians = Gajians::orderBy('id', 'desc')->get();
        return view('hrd.rincianpenggajian.index',compact('gajians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')->get();
        $gajian =  Gajians::get();
        return view('hrd.rincianpenggajian.create',compact('gajian','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'gaji' => 'required',
            'id_role' => 'required'
        ]);

        Gajians::create($attr);

        return redirect()->route('hrd.rincianpenggajian.index')->with('success', 'Rincian Penggajian has been added');
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
        $gajian = Gajians::findOrFail($id);
        $roles = Roles::get();
        return view('hrd.rincianpenggajian.edit',compact('gajian','roles'));
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
        $attr = $this->validate($request, [
            'gaji' => 'required',
            'id_role' => 'required'
        ]);

        Gajians::findOrFail($id)->update($attr);
        return redirect()->route('hrd.rincianpenggajian.index')->with('success', 'Rincian has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            Gajians::findOrFail($id)->delete();
            return redirect()->route('hrd.rincianpenggajian.index')->with('success', 'Rincian has been deleted');
        
    }
}
