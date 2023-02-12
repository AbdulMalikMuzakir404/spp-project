<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\User;
use App\Models\ruang;
use Livewire\Component;
use Livewire\WithPagination;

class MakeUser extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    protected $queryString = ['search'];

    public $email, $nisn, $nis, $nama, $no_telp, $alamat, $spp_id, $ruang_id;

    public $status_siswa = false;

    // lintening
    protected $listeners = [
        'success-create-data-siswa' => 'handleSiswa',
        'success-delete-data-siswa' => 'handleDeleteSiswa',
        'success-update-data-siswa' => 'handleUpdateSiswa',
        'add-data-siswa' => 'handleAddSiswa'
    ];

    public function render()
    {
        return view('livewire.data.make-user', [
            'spp' => spp::get(),
            'ruang' => ruang::get(),
            'siswa' => $this->search == null ? user::join('spps', 'users.spp_id', 'spps.id')
            ->leftJoin('ruangs', 'users.ruang_id', 'ruangs.id')
            ->where('level', 'siswa')
            ->paginate($this->paginate) :
            user::join('spps', 'spps.user_id', 'users.id')
            ->join('ruangs', 'ruangs.user_id', 'users.id')
            ->where('level', 'siswa')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate),
        ]);
    }

    public function handleSiswa()
    {
        //
    }

    public function handleUpdateSiswa()
    {
        //
    }

    public function handleAddSiswa()
    {
        $this->status_siswa = false;
    }

    public function handleDeleteSiswa()
    {
        //
    }

    public function makeDataSiswa()
    {
        $this->validate([
            'nisn' => 'required|min:5|max:13|unique:users|string',
            'nis' => 'required|min:5|max:13|unique:users|string',
            'nama' => 'required|min:5|max:50|string|unique:users',
            'no_telp' => 'required|min:5|max:20|string',
            'alamat' => 'required|min:5|max:70|string',
            'spp_id' => 'required',
            'ruang_id' => 'required',
        ]);

        User::create([
            'nisn' => $this->nisn,
            'nis' => $this->nis,
            'nama' => $this->nama,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'spp_id' => $this->spp_id,
            'ruang_id' => $this->ruang_id,
            'level' => 'siswa',
        ]);

        $this->clearDataCreateSiswa();
        $this->emit('success-create-data-siswa');
   }

   private function clearDataCreateSiswa()
    {
        $this->nisn = null;
        $this->nis = null;
        $this->nama = null;
        $this->no_telp = null;
        $this->alamat = null;
        $this->spp_id = null;
        $this->ruang_id = null;
    }

   public function getIdSiswa($nisn)
   {
        $this->status_siswa = true;
        $data_siswa = User::where('nisn', $nisn)->get('id');
        $idUser = [];
        foreach($data_siswa as $data){
            $dataId = $data['id'];
            array_push($idUser, $dataId);
        }
        $id = $idUser['0'];
        $this->emit('passing-update-data-siswa', $id);
   }

   public function deleteSiswa($nisn)
   {
        User::where('nisn', $nisn)->delete();
        $this->emit('success-delete-data-siswa');
   }
}