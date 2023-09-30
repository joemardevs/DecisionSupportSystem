<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $username, $password;

    public function signin()
    {
        $validatedForm = $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($validatedForm)) {
            return to_route('dashboard');
        }
        return to_route('login')
            ->with('error', 'Incorrect credentials.');
    }
    public function render()
    {
        return view('livewire.auth.login')
            ->layout('livewire.layouts.guest');
    }
}
