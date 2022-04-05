<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\MstPotongan;
use Illuminate\Http\Request;


use RealRashid\SweetAlert\Facades\Alert;

class MstPotonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $potongans = MstPotongan::orderBy('created_at', 'desc')->get();
        return view('hrd.potongan.index',compact('potongans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $potongan = new MstPotongan();
        return view('hrd.potongan.create',compact('potongan'));
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
            'nama' => 'required'
        ]);

        MstPotongan::create($attr);

        return redirect()->route('hrd.potongan.index')->with('success', 'Potongan has been added');
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
        $potongan = MstPotongan::findOrFail($id);
        return view('hrd.potongan.edit',compact('potongan'));
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
            'nama' => 'required'
        ]);

        MstPotongan::findOrFail($id)->update($attr);
        return redirect()->route('hrd.potongan.index')->with('success', 'Potongan has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            MstPotongan::findOrFail($id)->delete();
            return redirect()->route('hrd.potongan.index')->with('success', 'Potongan has been deleted');
        
    }
}
