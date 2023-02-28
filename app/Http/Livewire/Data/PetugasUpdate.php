<?php

namespace App\Http\Livewire\Data;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class PetugasUpdate extends Component
{
    public $email, $name, $username, $password, $petugasId;

    public $isLoading = false;

    // lintening
    protected $listeners = [
        'passing-update-data-petugas' => 'showDataPetugas',
    ];

    public function render()
    {
        return view('livewire.data.petugas-update');
    }

    public function submit()
    {
        $this->isLoading = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoading = false;
    }

    public function showDataPetugas($data)
    {
        $this->petugasId = $data['id'];
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->username = $data['username'];
        $this->password = $data['password_show'];
    }

    public function updateDataPetugas()
    {
        $this->validate([
            'email' => 'required|email|string|min:5|max:50',
            'username' => 'required|min:5|string|max:50',
            'name' => 'required|min:5|max:50|string',
            'password' => 'required|min:8|max:70|string'
        ]);

        User::find($this->petugasId)->update([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'password_show' => $this->password,
            'username' => $this->username
        ]);

        return redirect()->route('makePetugas')->with('success', 'Officer data successfully changed');
        $this->clearDataUpdatePetugas();
        $this->emit('success-update-data-petugas');
    }

    private function clearDataUpdatePetugas()
    {
        $this->petugasId = null;
        $this->email = null;
        $this->name = null;
        $this->username = null;
        $this->password = null;
    }

    public function addPetugas()
    {
        $this->clearDataUpdatePetugas();
        $this->emit('add-data-petugas');
    }
}