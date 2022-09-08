<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Http\Requests\StorePenyewaRequest;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyewas = Penyewa::all();
        // dd($penyewas);
        return view('pages.penyewa.index', compact('penyewas'));
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
     * @param  \App\Http\Requests\StorePenyewaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenyewaRequest $request)
    {
        $validation = $request->all();
        Penyewa::create($validation);
        return redirect()->route('penyewa.index')->with('success', 'addConfirm();');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyewa  $penyewa
     * @return \Illuminate\Http\Response
     */
    public function show(Penyewa $penyewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyewa  $penyewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyewa $penyewa)
    {
        return view('pages.penyewa.edit',compact('penyewa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenyewaRequest  $request
     * @param  \App\Models\Penyewa  $penyewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        if($request->no_identitas === $penyewa->no_identitas){
            $no_identitas_rule = 'required';
        }else {
            $no_identitas_rule = 'required|unique:penyewas';
        }

        if($request->no_hp === $penyewa->no_hp){
            $no_hp_rule = 'required';
        }else {            
            $no_hp_rule = 'required|unique:penyewas';
        }

        $validation =  $request->validate([
            'no_identitas' => $no_identitas_rule,
            'nama_penyewa' => 'required',
            'gender'       => 'required',
            'no_hp'        => $no_hp_rule,
            'alamat'       => 'required'
        ]);

        $penyewa->update($validation);
        return redirect()->route('penyewa.index')->with('success', 'editConfirm();');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyewa  $penyewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyewa $penyewa)
    {
        $penyewa->delete();
        return redirect()->route('penyewa.index')->with('success', 'destroyMessage();');
    }
}
