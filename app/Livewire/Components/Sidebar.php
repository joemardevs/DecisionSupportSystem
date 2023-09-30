<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function signout()
    {
        Auth::logout();
        return to_route('login');
    }
    public function render()
    {
        return view('livewire.components.sidebar')
            ->layout('livewire.layouts.app');
    }
}
