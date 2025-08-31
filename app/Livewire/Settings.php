<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $user;
    public $id;
    public $name;
    public $email;
    public $profilePicture;
    public $profilePictureUrl;
    public $profileSuccess;

    public function mount()
    {
        $this->user = Auth::user();
        $this->id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->profilePictureUrl = $this->user->picture();
    }

    #[Title("Settings")]
    public function render()
    {
        return view('settings');
    }

    public function save()
    {
        $this->reset('profileSuccess');
        $this->resetErrorBag();
        $fields = $this->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $this->user->id,
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        $this->user->update([
            'name'  => $fields['name'],
            'email' => $fields['email'],
        ]);
        $this->profileSuccess = 'Your profile has been updated successfully.';

        if ($this->profilePicture) {
            $this->handleProfilePictureUpload();
        }
    }

    private function handleProfilePictureUpload()
    {
        if ($this->user->profile_picture) {
            Storage::delete($this->user->profile_picture);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->profilePicture)
            ->cover(256, 256)
            ->toJpeg(80);

        $filePath = 'avatars/' . Str::uuid()->toString() . '-' . $this->user->id . '.jpg';

        Storage::disk('public')->put(
            $filePath,
            $image
        );

        $this->user->profile_picture = $filePath;
        $this->profilePictureUrl = Storage::url($filePath);

        $this->user->save();
    }

    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirmation;
    public $passwordSuccess;

    public function changePassword()
    {
        $this->resetErrorBag();
        $this->reset('passwordSuccess');
        $fields = $this->validate([
            'currentPassword'         => 'required|string|min:8',
            'newPassword'             => 'required|string|min:8',
            'newPasswordConfirmation' => 'required|string|min:8|same:newPassword',
        ]);

        $user = Auth::user();
        if (!Hash::check($fields['currentPassword'], $user->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
        }

        if (!$this->getErrorBag()->isEmpty()) {
            return;
        }

        $user->password = Hash::make($fields['newPassword']);
        $user->save();
        $this->reset('currentPassword', 'newPassword', 'newPasswordConfirmation');
        $this->passwordSuccess = 'Your password has been changed successfully.';
    }

    public function removeProfilePicture()
    {
        // Store the profile picture path before setting it to null
        $oldProfilePicture = $this->user->profile_picture;

        // Delete the file from storage if it exists
        if ($oldProfilePicture) {
            Storage::delete($oldProfilePicture);
        }

        // Update the user record
        $this->user->profile_picture = null;
        $this->user->save();
        $this->profilePictureUrl = null;
    }
}
