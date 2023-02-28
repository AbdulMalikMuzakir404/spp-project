<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\spp;
use App\Models\User;
use Livewire\Component;
use App\Models\pembayaran;
use Livewire\WithPagination;

class DataTransaksi extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    protected $queryString = ['search'];

    public $status_transaksi = false;

    public $status_pembayaran = null;

    public $nisn, $name, $tgl_dibayar, $bln_dibayar, $thn_dibayar, $jumlah_bayar, $spp_id, $bln;

    public $isLoading = false;

    protected $listeners = [
        'success-create-data-transaksi' => 'handleCreateDataTransaksi',
        'success-update-data-transaksi' => 'handleUpdateDataTransaksi',
        'success-delete-data-transaksi'=> 'handleDeleteDataTransaksi',
        'success-update-status-pembayaran' => 'handleUpdateStatusPembayaran',
        'success-delete-transaksi' => 'handleDeleteTransaksi',
        'add-data-transaksi' => 'handleAddTransaksi',
        'otomatis-change-status-pembayaran-lunas' => 'handleOtomatisChangeLunas',
        'otomatis-change-status-pembayaran-belum-lunas' => 'handleOtomatisChangeBelumLunas'
    ];

    public function mount()
    {
        date_default_timezone_set('Asia/Jakarta');


        $pembayaran = pembayaran::join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->get()->toArray();

            foreach($pembayaran as $pem) {
                if($pem['nominal'] <= $pem['jumlah_bayar']) {
                    pembayaran::where('pembayarans.nisn', $pem['nisn'])->where('tgl_dibayar', $pem['tgl_dibayar'])->where('bln_dibayar', $pem['bln_dibayar'])->where('thn_dibayar', $pem['thn_dibayar'])->update([
                        'status_pembayaran' => 1,
                        'midtrans_status' => 'success'
                    ]);

                    $this->emit('otomatis-change-status-pembayaran-lunas');

                } elseif($pem['nominal'] > $pem['jumlah_bayar']) {
                    pembayaran::where('pembayarans.nisn', $pem['nisn'])->where('tgl_dibayar', $pem['tgl_dibayar'])->where('bln_dibayar', $pem['bln_dibayar'])->where('thn_dibayar', $pem['thn_dibayar'])->update([
                        'status_pembayaran' => 0,
                        'midtrans_status' => 'pending'
                    ]);

                    $this->emit('otomatis-change-status-pembayaran-belum-lunas');
                }
            }
    }

    public function render()
    {
        return view('livewire.transaksi.data-transaksi', [
            'datas' => User::where('level', 'siswa')->get(),
            'dataSpp' => spp::get(),
            'transaksi' => $this->search == null ? pembayaran::orderBy('name')
            ->join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->paginate($this->paginate) :
            pembayaran::orderBy('name')
            ->join('spps', 'pembayarans.spp_id', 'spps.id')
            ->join('users', 'pembayarans.nisn', 'users.nisn')
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('status_pembayaran', $this->status_pembayaran)
            ->paginate($this->paginate),
        ]);
    }

    public function handleOtomatisChangeLunas()
    {
        //
    }

    public function handleOtomatisChangeBelumLunas()
    {
        //
    }

    public function handleAddTransaksi()
    {
        $this->status_transaksi = false;
    }

    public function handleCreateDataTransaksi()
    {
        return redirect()->route('dataTransaksi')->with('success', 'Data successfully added');
    }
    public function handleUpdateDataTransaksi()
    {
        return redirect()->route('dataTransaksi')->with('success', 'Successfully changed data');
    }

    public function handleDeleteDataTransaksi()
    {
        return redirect()->route('dataTransaksi')->with('success', 'Successfully deleted data');
    }

    public function handleUpdateStatusPembayaran()
    {
        //
    }

    public function handleDeleteTransaksi()
    {
        //
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function makeDataTransaksi()
    {
        $this->validate([
            'nisn' => 'required|min:5|max:13',
            'name' => 'required|min:5|max:50',
            'tgl_dibayar' => 'required|max:15',
            'bln_dibayar' => 'required|max:15',
            'thn_dibayar' => 'required|max:5',
            'jumlah_bayar' => 'required|min:5|max:40|string',
            'spp_id' => 'required'
        ]);

        $cekNisn = user::where('nisn', $this->nisn)->where('level', 'siswa')->get('name')->toArray();
        foreach($cekNisn as $name)
        {
            $cekNisnAndName = $name['name'];
        }

        if($cekNisnAndName !== $this->name) {
            return redirect()->route('dataTransaksi')->with('error', 'nisn and name do not match!');
        }

        $cekDatePembayaran = pembayaran::where('nama_siswa', $this->name)->where('bln_dibayar', $this->bln_dibayar)->where('thn_dibayar', $this->thn_dibayar)->get();
        if(count($cekDatePembayaran) >= 1) {
            return redirect()->route('dataTransaksi')->with('error', 'there was an error in the month of payment and the year of payment!');
        }

        switch ($this->bln_dibayar) {
            case 'January':
                $this->bln = 1;
                break;
            case 'February':
                $this->bln = 2;
                break;
            case 'Maret':
                $this->bln = 3;
                break;
            case 'April':
                $this->bln = 4;
                break;
            case 'Mei':
                $this->bln = 5;
                break;
            case 'Juni':
                $this->bln = 6;
                break;
            case 'Juli':
                $this->bln = 7;
                break;
            case 'Agustus':
                $this->bln = 8;
                break;
            case 'Desember':
                $this->bln = 9;
                break;
            case 'Oktober':
                $this->bln = 10;
                break;
            case 'November':
                $this->bln = 11;
                break;
            case 'Desember':
                $this->bln = 12;
                break;
        }

        $cek = spp::whereMonth('tahun', $this->bln)->whereYear('tahun', $this->thn_dibayar)->get('nominal');

        foreach($cek as $data) {
            if(intval($this->jumlah_bayar) > intval($data['nominal'])) {
                $this->clearDataCreateTransaksi();
                return redirect()->route('dataTransaksi')->with('error', 'failed to updated data!');
            }
        }

        $nama_pengelola = Auth()->user()->name;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        $length = 20;

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        pembayaran::create([
            'kode_transaction' => $random_string,
            'nisn' => $this->nisn,
            'nama_siswa' => $this->name,
            'tgl_dibayar' => $this->tgl_dibayar,
            'bln_dibayar' => $this->bln_dibayar,
            'thn_dibayar' => $this->thn_dibayar,
            'jumlah_bayar' => $this->jumlah_bayar,
            'spp_id' => $this->spp_id,
            'nama_pengelola' => $nama_pengelola,
            'status_pembayaran' => 0,
            'midtrans_status' => 'pending'
        ]);

        $total_bayar = User::where('nisn', $this->nisn)->get('total_bayar');
        foreach($total_bayar as $bayar) {
                $totalBayarUpdate = intval($bayar['total_bayar']) - intval($this->jumlah_bayar);
        }

        User::where('nisn', $this->nisn)->update([
            'total_bayar' => $totalBayarUpdate
        ]);


        return redirect()->route('dataTransaksi')->with('success', 'transaction data successfully added');
        $this->clearDataCreateTransaksi();
        $this->emit('success-create-data-transaksi');
    }

    private function clearDataCreateTransaksi()
    {
        $this->nisn = null;
        $this->spp_id = null;
        $this->tgl_dibayar = null;
        $this->bln_dibayar = null;
        $this->thn_dibayar = null;
        $this->jumlah_bayar = null;
    }

    public function updateStatus($data)
    {
        $exp = explode("-",$data);
        $nisn = $exp[0];
        $tgl = $exp[1];
        $bln = $exp[2];
        $thn = $exp[3];
        $data = User::where('level', 'siswa')->join('pembayarans', 'pembayarans.nisn', 'users.nisn')->where('users.nisn', $nisn)->where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn);
        $data->update([
            'status_pembayaran' => 1
        ]);

        $this->emit('success-update-status-pembayaran');
    }

    public function getIdTransaksi($data)
    {
        $this->status_transaksi = true;

        $exp = explode("-",$data);
        $nisn = $exp[0];
        $tgl = $exp[1];
        $bln = $exp[2];
        $thn = $exp[3];
        $datas = User::where('level', 'siswa')->join('pembayarans', 'pembayarans.nisn', 'users.nisn')->where('users.nisn', $nisn)->where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn)->get();

        $this->emit('passing-update-data-transaksi', $datas);
    }

    public function deleteTransaksi($data)
    {
        $exp = explode("-",$data);
        $tgl = $exp[0];
        $bln = $exp[1];
        $thn = $exp[2];
        $data = pembayaran::where('tgl_dibayar', $tgl)->where('bln_dibayar', $bln)->where('thn_dibayar', $thn);
        $data->delete();


        return redirect()->route('dataTransaksi')->with('success', 'transaction data successfully deleted');
        $this->emit('success-delete-transaksi');
    }
}