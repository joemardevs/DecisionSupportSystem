<?php

namespace App\Livewire\Pages\Admin\Colleges\Ps;

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
        $title = 'PS';
        $psResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::PS->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.ps.index', [
            'title' => $title,
            'statuses' => $statuses,
            'psResearch' => $psResearch
        ])->layout('livewire.layouts.app');
    }
}
