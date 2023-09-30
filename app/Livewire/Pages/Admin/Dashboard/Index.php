<?php

namespace App\Livewire\Pages\Admin\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $title = 'Dashboard';

        return view('livewire.pages.admin.dashboard.index', [
            'title' => $title,
        ])->layout('livewire.layouts.guest');
    }
}
