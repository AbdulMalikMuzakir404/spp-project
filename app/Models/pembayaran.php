<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'tgl_dibayar',
        'bln_dibayar',
        'thn_dibayar',
        'jumlah_bayar',
        'spp_id',
        'nama_pengelola',
        'status_pembayaran',
        'nama_siswa',
        'kode_transaction'
    ];

    protected $hidden = [
        'user_id',
    ];
}