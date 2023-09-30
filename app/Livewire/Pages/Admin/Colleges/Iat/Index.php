<?php

namespace App\Livewire\Pages\Admin\Colleges\Iat;

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
        $title = 'IAT';
        $iatResearch = Research::orderBy('id', 'asc')
            ->where('department_id', '=', DepartmentEnum::IAT->value)
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.iat.index', [
            'title' => $title,
            'statuses' => $statuses,
            'iatResearch' => $iatResearch
        ])->layout('livewire.layouts.app');
    }
}
