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

    public $email, $name, $username, $password;

    public $status_petugas = false;

    public $isLoading = false;

    protected $listeners = [
        'success-create-data-petugas' => 'handleCreatePetugas',
        'success-update-data-petugas'=> 'handleUpdatePetugas',
        'success-delete-data-petugas' => 'handleDeletePetugas',
        'add-data-petugas' => 'handleAddPetugas'
    ];

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.data.make-petugas', [
            'petugas' => $this->search == null ? user::orderBy('name')
            ->where('level', 'petugas')
            ->paginate($this->paginate) :
            user::orderBy('name')
            ->where('level', 'petugas')
            ->where('name', 'like', '%' . $this->search . '%')
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
            'name' => 'required|min:5|max:50|string|unique:users',
            'password' => 'required|min:8|max:70|string'
        ]);

        User::create([
            'email' => $this->email,
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'password_show' => $this->password,
            'level' => 'petugas',
        ]);

        return redirect()->route('makePetugas')->with('success', 'Officer data added successfully');
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
        $this->name = null;
        $this->username = null;
        $this->password = null;
    }
}