<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Exports\AuthorExport;
use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search;
    public $position = '';
    public $selectedAuthor;
    public function showDeleteConfirmationModal($id)
    {
        $this->selectedAuthor = Author::find($id);
        $this->dispatch('open-modal');
    }
    public function deleteFacultyMember($id)
    {
        $facultyMember = Author::find($id);
        $facultyMember->delete();
        $this->dispatch('close-modal');
        return to_route('faculty-members')
            ->with('error', 'Deleted');
    }
    public function export(Author $author)
    {
        return Excel::download(new AuthorExport($author), 'Faculty-Member.xlsx');
    }
    public function render()
    {
        $title = 'Faculty Members';
        $uniquePositions = Author::pluck('position')->unique()->toArray();

        $facultyMembers = Author::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->when($this->position !== '', function ($query) {
                $query->where('position', '=', $this->position);
            })
            ->search($this->search)
            ->paginate($this->perPage);

        return view('livewire.pages.admin.faculty-member.index', [
            'title' => $title,
            'facultyMembers' => $facultyMembers,
            'uniquePositions' => $uniquePositions,
        ])->layout('livewire.layouts.app');
    }
}
