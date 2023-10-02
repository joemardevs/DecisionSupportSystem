<?php

namespace App\Livewire\Pages\Admin\Setting;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;
    public function emptyInput()
    {
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = Auth::user();

        // Check if the provided current password matches the user's actual password
        if (!Hash::check($this->current_password, $user->password)) {
            $this->emptyInput();
            return back()->with('error', 'The current password is incorrect.');
        }
        // Check if the new password is the same as the current password
        if (Hash::check($this->password, $user->password)) {
            $this->emptyInput();
            return back()->with('error', 'No changes were made.');
        }
        // Update the user's password
        $user->update([
            'password' => $this->password,
        ]);
        // Clear the password fields
        $this->emptyInput();
        return back()->with('success', 'Update successful');
    }

    public function render()
    {
        $title = 'Settings';
        $user = Auth::user();

        return view('livewire.pages.admin.setting.update-password', [
            'title' => $title,
            'user' => $user
        ])->layout('livewire.layouts.app');
    }
}
