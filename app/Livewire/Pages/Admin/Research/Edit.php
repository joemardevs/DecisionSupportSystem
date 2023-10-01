<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Enums\DepartmentEnum;
use App\Enums\RoleEnum;
use App\Models\Department;
use App\Models\Research;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $title, $author_id, $status_id, $department_id;
    public function mount($id)
    {
        $research = Research::find($id);
        $this->title = $research->title;
        $this->author_id = $research->author->name;
        $this->department_id = $research->department->name;
        $this->status_id = $research->status->name;
    }
    public function render()
    {
        $titlePage = 'Research';
        $statuses = Status::all();
        $departments = Department::where('id', '>=', DepartmentEnum::CBM->value)->get();
        $authors = User::where('role_id', RoleEnum::USER->value)->get();
        // dd($authors);
        return view('livewire.pages.admin.research.edit', [
            'titlePage' => $titlePage,
            'authors' => $authors,
            'departments' => $departments,
            'statuses' => $statuses,
        ])->layout('livewire.layouts.app');
    }
    public function updateResearch()
    {
    }
}
