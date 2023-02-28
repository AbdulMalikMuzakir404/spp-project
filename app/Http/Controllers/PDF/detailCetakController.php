<?php

namespace App\Http\Controllers\PDF;

use App\Models\pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class detailCetakController extends Controller
{
    public function showDetail($nisn, $tahun)
    {
        $transaksi = pembayaran::orderBy('name')
        ->join('spps', 'pembayarans.spp_id', 'spps.id')
        ->join('users', 'pembayarans.nisn', 'users.nisn')
        ->where('thn_dibayar', date('Y'))
        ->where('pembayarans.nisn', $nisn)
        ->paginate(12);
        Session::put('halaman_url', request()->fullUrl());

        return view('PDF.admin-detail-cetak', compact('transaksi'));
    }
}