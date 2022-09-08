<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Sewa;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewas   = Sewa::with(['penyewa', 'motor'])->get();
        return view('pages.pengembalian.index', compact('sewas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function show(Sewa $sewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sewa $pengembalian)
    {
        return view('pages.pengembalian.bayar', compact('pengembalian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $pengembalian)
    {
        $validation = $request->validate([
            'total_biaya' => 'required'
        ]);

        $validation['status_bayar'] = 1;
        $validation['denda'] = $request->denda;

        $pengembalian->update($validation);
        
        return redirect()->route('pengembalian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sewa $pengembalian)
    {
        $motor = Motor::where('id', $pengembalian->motor_id)->first();
        $motor->update(['status' => 0]);

        $pengembalian->update(['status' => 1]);   
        return redirect()->route('pengembalian.index');
    }
}
