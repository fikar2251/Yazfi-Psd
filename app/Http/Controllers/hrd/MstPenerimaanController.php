<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\MstPenerimaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MstPenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerimaans = MstPenerimaan::orderBy('created_at', 'desc')->get();
        return view('hrd.penerimaangaji.index',compact('penerimaans'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penerimaan = new MstPenerimaan();
        return view('hrd.penerimaangaji.create',compact('penerimaan'));
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

        MstPenerimaan::create($attr);

        return redirect()->route('hrd.penerimaangaji.index')->with('success', 'Penerimaan Gaji has been added');
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
        $penerimaan = MstPenerimaan::findOrFail($id);
        return view('hrd.penerimaangaji.edit',compact('penerimaan'));
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

        MstPenerimaan::findOrFail($id)->update($attr);
        return redirect()->route('hrd.penerimaangaji.index')->with('success', 'Penerimaan Gaji has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            MstPenerimaan::findOrFail($id)->delete();
            return redirect()->route('hrd.penerimaangaji.index')->with('success', 'Penerimaan Gaji has been deleted');
    }
}
