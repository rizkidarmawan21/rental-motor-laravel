<?php

namespace App\Http\Controllers;

use App\Http\Requests\SewaRequest;
use App\Models\Motor;
use App\Models\Penyewa;
use App\Models\Sewa;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewas   = Sewa::with(['penyewa', 'motor'])->where('status', 0)->get();
        $penyewas = Penyewa::all();
        $motors   = Motor::where('status', 0)->get();
        return view('pages.penyewaan.index', compact('sewas', 'penyewas', 'motors'));
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
    public function store(SewaRequest $request)
    {
        $validation  = $request->all();
        $tgl_sewa    = $request->tanggal_sewa;
        $tgl_kembali = $request->tanggal_kembali;

        $motor = Motor::where('id', $request->motor_id)->first();
        if ($motor->status) {
            return redirect()->route('penyewaan.index')->with('success', 'failConfirm();');
        }

        $day = ((strtotime($tgl_kembali) - strtotime($tgl_sewa)) / (60 * 60 * 24)) + 1;
        $total = $motor->harga * $day;

        $validation['status'] = 0;
        $validation['status_bayar'] = 0;
        $validation['total_biaya'] = $total;

        Sewa::create($validation);
        $motor->update(['status' => 1]);
        return redirect()->route('penyewaan.index')->with('success', 'addConfirm();');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function show(Sewa $penyewaan)
    {
        // dd($penyewaan);
        $sewa = Sewa::with(['penyewa','motor'])->first();
        // dd($sewa);

        return view('pages.penyewaan.detail',compact('sewa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sewa $penyewaan)
    {
        $penyewas = Penyewa::all();
        $motors   = Motor::where('status',0)->get();
        return view('pages.penyewaan.edit',compact('penyewaan','penyewas','motors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $penyewaan)
    {
        $validation  = $request->validate([
            'penyewa_id'        => 'required',
            // 'motor_id'          => 'required',
            'tanggal_sewa'      => 'required',
            'tanggal_kembali'   => 'required',
            'catatan'           => 'string'
        ]);
        $tgl_sewa    = $request->tanggal_sewa;
        $tgl_kembali = $request->tanggal_kembali;
        

    if($request->motor_id){
            $motor = Motor::where('id', $request->motor_id)->first();
            if ($motor->status) {
                return redirect()->route('penyewaan.index')->with('success', 'failConfirm();');
            }
            $validation['motor_id'] = $request->motor_id;
        }else{
            $motor = Motor::where('id', $penyewaan->motor_id)->first();
        }
        
        $day    = ((strtotime($tgl_kembali) - strtotime($tgl_sewa)) / (60 * 60 * 24)) + 1;
        $total  = $motor->harga * $day;
        $validation['total_biaya']  = $total;

        Motor::where('id',$penyewaan->motor_id)->update(['status' => 0]);
        $motor->update(['status' => 1]);
        
        $penyewaan->update($validation);
        return redirect()->route('penyewaan.index')->with('success', 'editConfirm();');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sewa $penyewaan)
    {
        // dd($penyewaan);
        $motor = Motor::where('id', $penyewaan->motor_id)->first();
        $motor->update(['status' => 0]);
        $penyewaan->delete();

        return redirect()->route('penyewaan.index')->with('success', 'destroyMessage();');
    }
}
