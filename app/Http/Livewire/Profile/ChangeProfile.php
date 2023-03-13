<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChangeProfile extends Component
{
    use WithFileUploads;

    public $email, $name, $level, $username, $photo, $userId;

    public $old_password, $password, $password_confirmation;

    public $isLoadingaImg = false;
    public $isLoadingaImgD = false;

    public $isLoadingPro = false;
    public $isLoadingPass = false;

    public function mount()
    {
        $this->userId = Auth()->user()->id;
        $this->email = Auth()->user()->email;
        $this->name = Auth()->user()->name;
        $this->level = Auth()->user()->level;
        $this->username = Auth()->user()->username;
    }

    public function render()
    {
        return view('livewire.profile.change-profile');
    }

    // load img update and add
    public function changeImg()
    {
        $this->isLoadingaImg = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoadingaImg = false;
    }

    // load img delete
    public function deleteImg()
    {
        $this->isLoadingaImgD = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoadingaImgD = false;
    }

    // load change profile
    public function submitCPro()
    {
        $this->isLoadingPro = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoadingPro = false;
    }

    // load change password
    public function submitCPass()
    {
        $this->isLoadingPass = true;

        // Proses loading dilakukan disini
        sleep(2); // sleep 2 detik untuk simulasi loading

        $this->isLoadingPass = false;
    }

    public function changeProfile()
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);

        DB::beginTransaction();

        try {
            User::where('id', $this->userId)->update([
                'email' => $this->email
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


        return redirect()
            ->route('changeProfile')
            ->with('success', 'Data Berhasil di Ubah');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|max:100|string|min:8|confirmed',
        ]);

        $old_password = Auth::user()->password;
        $user_id = Auth::user()->id;

        if (Hash::check($this->old_password, $old_password)) {
            $user = User::find($user_id);
            $user->password = Hash::make($this->password);

            if ($user->save()) {
                return redirect()
                    ->route('changeProfile')
                    ->with('success', 'Berhasil mengubah password');
            } else {
                return redirect()
                    ->route('changeProfile')
                    ->with('error', 'Password lama salah');
            }
        } else {
            return redirect()
                ->route('changeProfile')
                ->with('error', 'Password lama salah');
        }
    }

    public function updateImage()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        Storage::disk('public')->delete('profile/' . Auth()->user()->photo);

        $destination_path = 'public/profile';
        $foto = time() . '_' . rand() . '.' . $this->photo->extension();
        $this->photo->storeAs($destination_path, $foto);

        User::where('id', $this->userId)->update([
            'photo' => $foto,
        ]);

        return redirect()
            ->route('changeProfile')
            ->with('success', 'Images has been change');
    }

    public function deleteImage()
    {
        if (Storage::delete('profile/' . Auth()->user()->photo)) {
            Storage::disk('public')->delete('profile/' . Auth()->user()->photo);
            /*
                Delete Multiple File like this way
                Storage::delete(['upload/example.png', 'upload/example2.png']);
            */

            User::where('id', $this->userId)->update([
                'photo' => null,
            ]);

            return redirect()
                ->route('changeProfile')
                ->with('warning', 'Images has been deleted');
        }
    }
}