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
    public $status = '';

    public function render()
    {
        $title = 'PS';
        $psResearch = Research::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->where('department_id', '=', DepartmentEnum::PS->value)
            ->when($this->status !== '', function ($query) {
                $query->where('status_id', $this->status);
            })
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
