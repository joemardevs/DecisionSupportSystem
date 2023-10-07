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
    public $year;
    public $selectedResearch;
    public function showDeleteConfirmationModal($id)
    {
        $this->selectedResearch = Research::find($id);
        $this->dispatch('open-modal');
    }
    public function deleteResearch($id)
    {
        $research = Research::find($id);
        $research->delete();
        $this->dispatch('close-modal');
        return to_route('research')
            ->with('error', 'Deleted');
    }
    public function render()
    {
        $title = 'Research';
        $allResearch = Research::orderBy('updated_at', 'desc')
            ->orderBy('id', 'asc')
            ->when($this->status !== '' || $this->year !== '', function ($query) {
                $query->where(function ($subquery) {
                    if ($this->status !== '') {
                        $subquery->where('status_id', $this->status);
                    }
                    if ($this->year !== '') {
                        $yearAsString = strval($this->year);
                        $subquery->whereYear('created_at', 'LIKE', '%' . $yearAsString . '%');
                    }
                });
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
