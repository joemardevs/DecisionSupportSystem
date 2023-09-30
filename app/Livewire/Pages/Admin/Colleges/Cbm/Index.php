<?php

namespace App\Livewire\Pages\Admin\Colleges\Cbm;

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
        $title = 'CBM';
        $cbmResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::CBM->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.cbm.index', [
            'title' => $title,
            'statuses' => $statuses,
            'cbmResearch' => $cbmResearch
        ])->layout('livewire.layouts.app');
    }
}
