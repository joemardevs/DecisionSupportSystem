<?php

namespace App\Livewire\Pages\Admin\Colleges\Ccje;

use App\Enums\DepartmentEnum;
use App\Models\Research;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search;

    public function render()
    {
        $title = 'CCJE';
        $ccjeResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::CCJE->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.ccje.index', [
            'title' => $title,
            'statuses' => $statuses,
            'ccjeResearch' => $ccjeResearch
        ])->layout('livewire.layouts.app');
    }
}
