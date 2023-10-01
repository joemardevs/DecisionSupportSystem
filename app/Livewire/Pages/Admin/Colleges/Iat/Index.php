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
    public $status = '';

    public function render()
    {
        $title = 'IAT';
        $iatResearch = Research::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->where('department_id', '=', DepartmentEnum::IAT->value)
            ->when($this->status !== '', function ($query) {
                $query->where('status_id', $this->status);
            })
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
