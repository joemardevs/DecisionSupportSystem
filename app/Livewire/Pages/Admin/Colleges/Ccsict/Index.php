<?php

namespace App\Livewire\Pages\Admin\Colleges\Ccsict;

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
        $title = 'CCSICT';
        $ccsictResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::CCSICT->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.ccsict.index', [
            'title' => $title,
            'statuses' => $statuses,
            'ccsictResearch' => $ccsictResearch
        ])->layout('livewire.layouts.app');
    }
}
