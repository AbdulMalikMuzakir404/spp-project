<?php

namespace App\Http\Controllers\PDF;

use PDF;
use App\Models\User;
use App\Models\pembayaran;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class adminCreateLaporanController extends Controller
{
    public function __construck(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function createTransaksiLaporan($nisn, $tahun)
    {
        $tunggakan = User::where('nisn', $nisn)->where('level', 'siswa')->get('total_bayar')->toArray();
        foreach($tunggakan as $bayar){
            $sisa_tunggakan = $bayar['total_bayar'];
        }
        $exp = explode("-", $tahun);

        $transaksi = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
        ->join('users', 'pembayarans.nisn', 'users.nisn')
        ->where('pembayarans.thn_dibayar', $exp[0])
        ->where('pembayarans.nisn', $nisn)->get();

        // view()->share('transaksi', $transaksi);
        $pdf = PDF::loadview('PDF.admin-create-laporan', [
            'transaksi' => $transaksi,
            'sisa_tunggakan' => $sisa_tunggakan
        ]);
        $pdf->set_option('dpi', 100);
        $pdf->stream();
       //return $pdf->download('transaksi.pdf');

        return view('PDF.admin-create-laporan', compact('transaksi', 'sisa_tunggakan'));
    }
}