<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataUpdate extends Component
{
    public $tahun, $nominal, $sppId;

    public $isLoading = false;

    // lintening
    protected $listeners = [
        'passing-update-data-spp' => 'showDataSpp'
    ];

    public function render()
    {
        return view('livewire.data.data-update');
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function showDataSpp($data_spp)
    {
        $this->sppId = $data_spp['id'];
        $this->tahun = $data_spp['tahun'];
        $this->nominal = $data_spp['nominal'];
    }

    public function updateDataSpp()
    {
        $this->validate([
            'tahun' => 'required|date',
            'nominal' => 'required|max:30'
        ]);

        // $cekSpp = spp::where('tahun', $this->tahun)->get();

        // if(count($cekSpp) >= 1) {
        //     return redirect()->route('dataCreate')->with('error', 'SPP data already exists!');
        // }

        DB::beginTransaction();

        try {

            spp::where('id', $this->sppId)->update([
                'tahun' => $this->tahun,
                'nominal' => $this->nominal
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


        return redirect()->route('dataCreate')->with('success', 'SPP data successfully changed');
        $this->clearDataUpdateSpp();
        $this->emit('success-update-data-spp');
    }

    private function clearDataUpdateSpp()
    {
        $this->sppId = null;
        $this->tahun = null;
        $this->nominal = null;
    }

    public function addSpp()
    {
        $this->clearDataUpdateSpp();
        $this->emit('add-data-spp');
    }
}