<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Enums\RoleEnum;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 5;

    public $search;
    public $position = '';

    public function render()
    {
        $title = 'Faculty Members';

        $facultyMembers = User::orderBy('id', 'asc')
            ->where('role_id', RoleEnum::USER->value)
            ->when($this->position !== '', function ($query) {
                $query->where('position', '=', $this->position);
            })
            ->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.pages.admin.faculty-member.index', [
            'title' => $title,
            'facultyMembers' => $facultyMembers,
        ])->layout('livewire.layouts.app');
    }
}
