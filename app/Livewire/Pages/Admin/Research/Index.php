<?php

namespace App\Livewire\Pages\Admin\Research;

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
        $title = 'Research';
        $allResearch = Research::orderBy('id', 'asc')
            ->when($this->status !== '', function ($query) {
                $query->where('status_id', $this->status);
            })
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();

        return view('livewire.pages.admin.research.index', [
            'title' => $title,
            'statuses' => $statuses,
            'allResearch' => $allResearch,
        ])->layout('livewire.layouts.app');
    }
}
