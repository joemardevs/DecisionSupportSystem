<?php

namespace App\Livewire\Pages\Admin\Colleges\Sas;

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
        $title = 'SAS';
        $sasResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::SAS->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.sas.index', [
            'title' => $title,
            'statuses' => $statuses,
            'sasResearch' => $sasResearch
        ])->layout('livewire.layouts.app');
    }
}
