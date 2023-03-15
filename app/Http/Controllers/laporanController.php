<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\pembayaran;
use Illuminate\Http\Request;

class laporanController extends Controller
{
    public function show()
    {
        return view('laporan.laporan');
    }

    public function create(Request $request)
    {
        $transaksi = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
        ->join('users', 'pembayarans.nisn', 'users.nisn')
        ->whereBetween('pembayarans.created_at', [$request->dari, $request->sampai])
        ->get();

        $jumlah_bayar = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
        ->join('users', 'pembayarans.nisn', 'users.nisn')
        ->whereBetween('pembayarans.created_at', [$request->dari, $request->sampai])
        ->sum('jumlah_bayar');

        $dari = $request->dari;
        $sampai = $request->sampai;

        // view()->share('transaksi', $transaksi);
        $pdf = PDF::loadview('PDF.admin-create-laporan-range', [
            'transaksi' => $transaksi,
            'jumlah_bayar' => $jumlah_bayar,
            'dari' => $dari,
            'sampai' => $sampai
        ]);
        $pdf->set_option('dpi', 100);
        //$pdf->stream();
       return $pdf->download('transaksi.pdf');
    }
}