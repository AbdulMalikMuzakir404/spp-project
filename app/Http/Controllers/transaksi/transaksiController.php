<?php

namespace App\Http\Controllers\transaksi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\spp;

class transaksiController extends Controller
{
    public function showDataTransaksi()
    {
        return view('transaksi.transaksi');
    }

    public function get_siswa($nisn){
        $siswa=User::firstWhere('nisn',$nisn);
        // dd($siswa);
        $siswa=[
            'nama'=>$siswa->name,
        ];
        return $siswa;
    }
    public function get_spp($id_spp){
       $spp=spp::firstWhere('id',$id_spp);
       $spp=[
           'jumlah_bayar'=>$spp->nominal,
       ];
       return $spp;
    }
}