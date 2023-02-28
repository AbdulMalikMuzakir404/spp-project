<?php

namespace App\Http\Livewire\Siswa;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;
use Illuminate\Support\Facades\Auth;

class HomeSiswa extends Component
{
    public $data, $tahun;

    public function mount()
    {
        $this->data = User::find(Auth::user()->id);

        date_default_timezone_set('Asia/Jakarta');

        $pembayaran = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->where('pembayarans.nisn', auth()->user()->nisn)
            ->get()->toArray();

            foreach($pembayaran as $pem) {
                if($pem['nominal'] <= $pem['jumlah_bayar']) {
                    pembayaran::where('pembayarans.nisn', $pem['nisn'])->where('tgl_dibayar', $pem['tgl_dibayar'])->where('bln_dibayar', $pem['bln_dibayar'])->where('thn_dibayar', $pem['thn_dibayar'])->update([
                        'status_pembayaran' => 1
                    ]);

                    $this->emit('otomatis-change-status-pembayaran-lunas');

                } elseif($pem['nominal'] > $pem['jumlah_bayar']) {
                    pembayaran::where('pembayarans.nisn', $pem['nisn'])->where('tgl_dibayar', $pem['tgl_dibayar'])->where('bln_dibayar', $pem['bln_dibayar'])->where('thn_dibayar', $pem['thn_dibayar'])->update([
                        'status_pembayaran' => 0
                    ]);

                    $this->emit('otomatis-change-status-pembayaran-belum-lunas');
                }
            }
    }
    public function render()
    {
        return view('livewire.siswa.home-siswa', [
            'data_spp' => spp::orderBy('tahun')->whereYear('tahun', date('Y'))->paginate(5),
            'transaksi' => $this->tahun == null ? pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->where('name', Auth()->user()->name)
            ->paginate(7) :
            pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->where('name', Auth()->user()->name)
            ->where('thn_dibayar', $this->tahun)
            ->paginate(7),
        ]);
    }
}