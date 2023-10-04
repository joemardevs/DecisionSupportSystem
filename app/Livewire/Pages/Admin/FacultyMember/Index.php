<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;


    public $perPage = 5;

    public $search;
    public $position = '';

    public function render()
    {
        $title = 'Faculty Members';

        $facultyMembers = Author::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
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
