<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status_bayar');
        if ($status === '1') {
            $statusTitle  = 'Terbayar '; 
            $sewas   = Sewa::with(['penyewa', 'motor'])->where('status_bayar', 1)->get();
        }elseif($status === '0'){
            $statusTitle  = 'Menunggu Pembayaran'; 
            $sewas   = Sewa::with(['penyewa', 'motor'])->where('status_bayar', 0)->get();
        }else {
            $sewas   = Sewa::with(['penyewa', 'motor'])->get();
            $statusTitle  = ''; 
        }

        $pendapatan_hari = Sewa::where([['tanggal_sewa','=',date('Y-m-d')],['status_bayar','=',1]])->sum('total_biaya') + Sewa::where('tanggal_sewa', date('Y-m-d'))->sum('denda');
        $pendapatan_bulan = Sewa::whereMonth('tanggal_sewa','=', date('m'))->where('status_bayar',1)->sum('total_biaya') + Sewa::where('tanggal_sewa', date('Y-m-d'))->sum('denda');
        return view('pages.pembayaran.index', compact('sewas','statusTitle','pendapatan_hari','pendapatan_bulan'));
    }
}
