<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\User;
use App\Models\ruang;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserUpdate extends Component
{
    public $email, $nisn, $nis, $name, $no_telp, $total_bayar, $tunggakan, $alamat, $spp_id, $ruang_id, $nama_kelas, $kopetensi_keahlian, $siswaId;

    public $isLoading = false;

     // lintening
     protected $listeners = [
        'passing-update-data-siswa' => 'showDataSiswa'
    ];

    public function render()
    {
        return view('livewire.data.user-update', [
            // 'spp' => spp::get(),
            'ruang' => ruang::get(),
            'spp' => spp::whereYear('tahun', date('Y'))->sum('nominal'),
        ]);
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function showDataSiswa($id)
    {
        $this->siswaId = $id;

        $find = User::join('ruangs', 'users.ruang_id', 'ruangs.id')->where('users.id', $id)->get();

        foreach($find as $data){
            $this->spp_id = $data['spp_id'];
            $this->ruang_id = $data['ruang_id'];
            $this->nisn = $data['nisn'];
            $this->nis = $data['nis'];
            $this->name = $data['name'];
            $this->no_telp = $data['no_telp'];
            $this->alamat = $data['alamat'];
            $this->nama_kelas = $data['nama_kelas'];
            $this->kopetensi_keahlian = $data['kopetensi_keahlian'];
            $this->tunggakan = $data['total_bayar'];
        }
    }

    public function updateDataSiswa()
    {
        $this->validate([
            'nis' => 'required|min:5|max:13|string',
            'name' => 'required|min:5|max:50|string',
            'no_telp' => 'required|min:5|max:20|string',
            'alamat' => 'required|min:5|max:70|string',
            'ruang_id' => 'required',
            'nama_kelas' => 'required|max:10',
            'kopetensi_keahlian' => 'required|max:20',
            'total_bayar' => 'required',
            'tunggakan' => 'required'
        ]);

        if($this->total_bayar == 'tidak') {

            DB::beginTransaction();

            try {
                User::join('ruangs', 'users.ruang_id', 'ruangs.id')->where('users.id', $this->siswaId)->update([
                    'nis' => $this->nis,
                    'password' => Hash::make($this->nis),
                    'name' => $this->name,
                    'no_telp' => $this->no_telp,
                    'alamat' => $this->alamat,
                    'ruang_id' => $this->ruang_id,
                    'nama_kelas' => $this->nama_kelas,
                    'kopetensi_keahlian' => $this->kopetensi_keahlian,
                    'total_bayar' => $this->tunggakan
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } else{

            DB::beginTransaction();

            try {
                User::join('ruangs', 'users.ruang_id', 'ruangs.id')->where('users.id', $this->siswaId)->update([
                    'nis' => $this->nis,
                    'password' => Hash::make($this->nis),
                    'name' => $this->name,
                    'no_telp' => $this->no_telp,
                    'alamat' => $this->alamat,
                    'ruang_id' => $this->ruang_id,
                    'nama_kelas' => $this->nama_kelas,
                    'kopetensi_keahlian' => $this->kopetensi_keahlian,
                    'total_bayar' => $this->total_bayar,
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        }


        return redirect()->route('makeSiswa')->with('success', 'student data successfully changed');
        $this->clearDataUpdateSiswa();
        $this->emit('success-update-data-siswa');
    }

    private function clearDataUpdateSiswa()
    {
        $this->siswaId = null;
        $this->nisn = null;
        $this->nis = null;
        $this->name = null;
        $this->no_telp = null;
        $this->alamat = null;
        $this->spp_id = null;
        $this->tunggakan = null;

       $this->ruang_id = null;
        $this->nama_kelas = null;
        $this->kopetensi_keahlian = null;
    }

    public function addSiswa()
    {
        $this->clearDataUpdateSiswa();
        $this->emit('add-data-siswa');
    }
}