<?php

namespace App\Http\Livewire\Data;

use App\Models\ruang;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class KelasUpdate extends Component
{
    public $nama_kelas, $kopetensi_keahlian, $kelasId;

    public $isLoading = false;

    // lintening
    protected $listeners = [
        'passing-update-data-kelas' => 'showDataKelas'
    ];

    public function render()
    {
        return view('livewire.data.kelas-update');
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function showDataKelas($data_kelas)
    {
        $this->kelasId = $data_kelas['id'];
        $this->nama_kelas = $data_kelas['nama_kelas'];
        $this->kopetensi_keahlian = $data_kelas['kopetensi_keahlian'];
    }

    public function updateDataKelas()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50',
            'kopetensi_keahlian' => 'required|max:10'
        ]);

        $cekKelas = ruang::where('nama_kelas', $this->nama_kelas)->where('kopetensi_keahlian', $this->kopetensi_keahlian)->get();

        if(count($cekKelas) >= 1) {
            return redirect()->route('dataCreate')->with('error', 'Room data already exists!');
        }

        DB::beginTransaction();

        try {
            ruang::where('id', $this->kelasId)->update([
                'nama_kelas' => $this->nama_kelas,
                'kopetensi_keahlian' => $this->kopetensi_keahlian
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }



        return redirect()->route('dataCreate')->with('success', 'room data successfully changed');
        $this->clearDataUpdateKelas();
        $this->emit('success-update-data-kelas');
    }

    private function clearDataUpdateKelas()
    {
        $this->kelasId = null;
        $this->nama_kelas = null;
        $this->kopetensi_keahlian = null;
    }

    public function addKelas()
    {
        $this->clearDataUpdateKelas();
        $this->emit('add-data-kelas');
    }
}