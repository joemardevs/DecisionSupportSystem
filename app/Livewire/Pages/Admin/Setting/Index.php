<?php

namespace App\Livewire\Pages\Admin\Setting;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $username, $name;
    public function updateAccount()
    {
        $user = Auth::user();

        $rules = [
            'username' => 'nullable|unique:users,username,' . $user->id,
            'name' => 'nullable|unique:users,name,' . $user->id,
        ];

        $validatedForm = $this->validate($rules);

        // Check if the fields are not empty and not the same as the current values
        if (!empty($validatedForm['username']) && $validatedForm['username'] !== $user->username) {
            $user->username = $validatedForm['username'];
        }

        if (!empty($validatedForm['name']) && $validatedForm['name'] !== $user->name) {
            $user->name = $validatedForm['name'];
        }

        // Save the updated user record only if changes were made
        if ($user->isDirty()) {
            $user->save();
            return back()->with('success', 'Update successful');
        } else {
            return back()->with('error', 'No changes were made');
        }
    }
    public function render()
    {
        $title = 'Settings';
        $user = Auth::user();

        return view('livewire.pages.admin.setting.index', [
            'title' => $title,
            'user' => $user
        ])->layout('livewire.layouts.app');
    }
}
