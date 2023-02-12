<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\ruang;
use Livewire\Component;
use Livewire\WithPagination;

class DataCreate extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate_spp = 5;
    public $search_spp;

    public $paginate_kelas = 5;
    public $search_kelas;

    protected $queryString = ['search_spp', 'search_kelas'];

    public $status_spp = false;
    public $status_kelas = false;

    public $nama_kelas, $kopetensi_keahlian, $tahun, $nominal, $spp;

    // lintening
    protected $listeners = [
        'success-create-data-spp' => 'handleSpp',
        'success-create-data-kelas' => 'handleKelas',
        'success-update-data-spp' => 'handleUpdateSpp',
        'success-update-data-kelas' => 'handleUpdateKelas',
        'delete-data-spp' => 'handleDeleteSpp',
        'delete-data-kelas' => 'handleDeleteKelas',

        'add-data-spp' => 'handleAddSpp',
        'add-data-kelas' => 'handleAddKelas'
    ];

    // render funtion
    public function render()
    {
        return view('livewire.data.data-create', [
            'data_spp' => $this->search_spp == null ? spp::paginate($this->paginate_spp) : spp::where('tahun', 'like', '%' . $this->search_spp . '%')->paginate($this->paginate_spp),
            'data_kelas' => $this->search_kelas == null ? ruang::paginate($this->paginate_kelas) : spp::where('nama_kelas', 'like', '%' . $this->search_kelas . '%')->paginate($this->paginate_kelas)
        ]);
    }

    public function handleSpp()
    {
        //
    }

    public function handleKelas()
    {
        //
    }

    public function handleUpdateSpp()
    {
        //
    }

    public function handleUpdateKelas()
    {
        //
    }

    public function handleDeleteSpp()
    {
        //
    }

    public function handleDeleteKelas()
    {
        //
    }

    public function handleAddSpp()
    {
        $this->status_spp = false;
    }

    public function handleAddKelas()
    {
        $this->status_kelas = false;
    }

    // get id spp to update
    public function getIdSpp($id)
    {
        $this->status_spp = true;
        $data_spp = spp::find($id);
        $this->emit('passing-update-data-spp', $data_spp);
    }

    // get id kelas to update
    public function getIdKelas($id)
    {
        $this->status_kelas = true;
        $data_kelas = ruang::find($id);
        $this->emit('passing-update-data-kelas', $data_kelas);
    }

    // buat data spp
    public function makeDataSpp()
    {
        $this->validate([
            'tahun' => 'required|date',
            'nominal' => 'required|max:30'
        ]);

        spp::create([
            'tahun' => $this->tahun,
            'nominal' => $this->nominal
        ]);

        $this->clearDataCreateSpp();
        $this->emit('success-create-data-spp');
    }

    private function clearDataCreateSpp()
    {
        $this->tahun = null;
        $this->nominal = null;
    }

    // buat data kelas
    public function makeDataKelas()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:50',
            'kopetensi_keahlian' => 'required|max:10'
        ]);

        ruang::create([
            'nama_kelas' => $this->nama_kelas,
            'kopetensi_keahlian' => $this->kopetensi_keahlian
        ]);

        $this->clearDataCreateKelas();
        $this->emit('success-create-data-kelas');
    }

    private function clearDataCreateKelas()
    {
        $this->nama_kelas = null;
        $this->kopetensi_keahlian = null;
    }

    // delete data spp
    public function deleteSpp($id)
    {
        spp::where('id', $id)->delete();

        $this->emit('delete-data-spp');
        // return redirect()->back()->with();
    }

    // delete data kelas
    public function deleteKelas($id)
    {
        ruang::where('id', $id)->delete();

        $this->emit('delete-data-kelas');
        // return redirect()->back()->with();

   }
}