<?php

namespace App\Http\Livewire\Data;

use App\Models\spp;
use App\Models\User;
use App\Models\ruang;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class MakeUser extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    protected $queryString = ['search'];

    public $email, $nisn, $nis, $name, $no_telp, $alamat, $total_bayar, $ruang_id;

    public $status_siswa = false;

    public $isLoading = false;

    // lintening
    protected $listeners = [
        'success-create-data-siswa' => 'handleSiswa',
        'success-delete-data-siswa' => 'handleDeleteSiswa',
        'success-update-data-siswa' => 'handleUpdateSiswa',
        'add-data-siswa' => 'handleAddSiswa'
    ];

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.data.make-user', [
            'spp' => spp::get(),
            'ruang' => ruang::get(),
            'siswa' => $this->search == null ? user::orderBy('name')
            ->join('ruangs', 'users.ruang_id', 'ruangs.id')
            ->where('level', 'siswa')
            ->paginate($this->paginate) :
            user::orderBy('name')
            ->join('ruangs', 'users.ruang_id', 'ruangs.id')
            ->where('level', 'siswa')
            ->where('name', 'like', '%' . $this->search . '%')
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

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function makeDataSiswa()
    {
        $this->total_bayar = spp::whereYear('tahun', date('Y'))->sum('nominal');

        $this->validate([
            'nisn' => 'required|min:5|max:13|unique:users|string',
            'nis' => 'required|min:5|max:13|unique:users|string',
            'name' => 'required|min:5|max:50|string|unique:users',
            'no_telp' => 'required|min:5|max:20|string',
            'alamat' => 'required|min:5|max:70|string',
            'ruang_id' => 'required'
        ]);

        User::create([
            'nisn' => $this->nisn,
            'nis' => $this->nis,
            'password' => Hash::make($this->nis),
            'name' => $this->name,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'ruang_id' => $this->ruang_id,
            'level' => 'siswa',
            'total_bayar' => $this->total_bayar
        ]);

        if($this->total_bayar){
            User::where('nisn', $this->nisn)->where('level', 'siswa')->update([
                'total_bayar' => $this->total_bayar
            ]);
        }

        return redirect()->route('makeSiswa')->with('success', 'Student data added successfully');
        $this->clearDataCreateSiswa();
        $this->emit('success-create-data-siswa');
   }

   private function clearDataCreateSiswa()
    {
        $this->nisn = null;
        $this->nis = null;
        $this->name = null;
        $this->no_telp = null;
        $this->alamat = null;
        $this->total_bayar = null;
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
