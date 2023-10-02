<?php

namespace App\Livewire\Pages\Admin\Setting;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $username, $name;
    protected $rules = [
        'username' => 'required',
        'name' => 'required'
    ];
    public function updateAccount()
    {
        $user = Auth::user();

        $this->validate();

        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $hasChanges = false;
        if ($this->username !== $user->username) {
            $user->username = $this->username;
            $hasChanges = true;
        }
        if ($this->name !== $user->name) {
            $user->name = $this->name;
            $hasChanges = true;
        }
        // If no changes were made, return with an error message
        if (!$hasChanges) {
            return back()->with('error', 'No changes were made');
        }
        $user->save();
        return back()->with('success', 'Update successful');
    }
    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->name = $user->name;
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
