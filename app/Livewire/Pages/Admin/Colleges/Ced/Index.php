<?php

namespace App\Livewire\Pages\Admin\Colleges\Ced;

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
    public $status = '';

    public function render()
    {
        $title = 'CED';
        $cedResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::CED->value)
            ->when($this->status !== '', function ($query) {
                $query->where('status_id', $this->status);
            })
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.ced.index', [
            'title' => $title,
            'statuses' => $statuses,
            'cedResearch' => $cedResearch
        ])->layout('livewire.layouts.app');
    }
}
