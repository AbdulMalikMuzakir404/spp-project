<?php

namespace App\Http\Livewire\Data;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class MakePetugas extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    protected $queryString = ['search'];

    public $email, $nama, $username, $password;

    public $status_petugas = false;

    protected $listeners = [
        'success-create-data-petugas' => 'handleCreatePetugas',
        'success-update-data-petugas'=> 'handleUpdatePetugas',
        'success-delete-data-petugas' => 'handleDeletePetugas',
        'add-data-petugas' => 'handleAddPetugas'
    ];

    public function render()
    {
        return view('livewire.data.make-petugas', [
            'petugas' => $this->search == null ? user::where('level', 'petugas')
            ->paginate($this->paginate) :
            user::where('level', 'petugas')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate),
        ]);
    }

    public function handleCreatePetugas()
    {
        //
    }

    public function handleUpdatePetugas()
    {
        //
    }

    public function handleDeletePetugas()
    {
        // 
    }

    public function handleAddPetugas()
    {
        $this->status_petugas = false;
    }

    public function makeDataPetugas()
    {
        $this->validate([
            'email' => 'required|email|string|min:5|max:50|unique:users',
            'username' => 'required|min:5|string|max:50|unique:users',
            'nama' => 'required|min:5|max:50|string|unique:users',
            'password' => 'required|min:8|max:70|string'
        ]);

        User::create([
            'email' => $this->email,
            'nama' => $this->nama,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'level' => 'petugas',
        ]);

        $this->clearDataCreatePetugas();
        $this->emit('success-create-data-petugas');
    }

    public function getIdPetugas($id)
   {
        $this->status_petugas = true;
        $data = user::find($id);
        $this->emit('passing-update-data-petugas', $data);
   }

   public function deletePetugas($id)
   {
        User::find($id)->delete();
        $this->emit('success-delete-data-petugas');
   }

   private function clearDataCreatePetugas()
    {
        $this->email = null;
        $this->nama = null;
        $this->username = null;
        $this->password = null;
    }
}