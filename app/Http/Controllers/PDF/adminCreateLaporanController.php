<?php

namespace App\Http\Controllers\PDF;

use PDF;
use App\Models\spp;
use App\Models\User;
use App\Models\pembayaran;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class adminCreateLaporanController extends Controller
{
    public function __construck(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function createTransaksiLaporan(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'nisn' => 'required|min:5'
        ]);
        
        $tunggakan = User::where('nisn', $request->nisn)->whereYear('updated_at', $request->tahun)->where('level', 'siswa')->first();

        if($tunggakan != null){
            $sisa_tunggakan = $tunggakan->total_bayar;
        } else {
            $sisa_tunggakan = 0;
        }
        
        // $spps = spp::whereYear('tahun', $request->tahun)->get('nominal')->toArray();
        // foreach($spps as $spp){
        //     $data = $spp['nominal'];
        // }


        $exp = explode("-", $request->tahun);

        $transaksi = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
        ->join('users', 'pembayarans.nisn', 'users.nisn')
        ->where('pembayarans.thn_dibayar', $exp[0])
        ->where('pembayarans.nisn', $request->nisn)->get();

        // view()->share('transaksi', $transaksi);
        $pdf = PDF::loadview('PDF.admin-create-laporan', [
            'transaksi' => $transaksi,
            'sisa_tunggakan' => $sisa_tunggakan,
            'tahun' => $request->tahun
        ]);
        $pdf->set_option('dpi', 100);
        //$pdf->stream();
       return $pdf->download('transaksi.pdf');

        //return view('PDF.admin-create-laporan', compact('transaksi', 'sisa_tunggakan'));
    }
}