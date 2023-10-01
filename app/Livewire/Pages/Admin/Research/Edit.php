<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Enums\DepartmentEnum;
use App\Enums\RoleEnum;
use App\Models\Department;
use App\Models\Research;
use App\Models\Status;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $research, $title, $author_id, $status_id, $department_id, $research_id;

    public function updateResearch()
    {
        // Find the research record based on the research_id
        $research = Research::find($this->research_id);
        // Check if the research record exists
        if (!$research) {
            return back()->with('error', 'Research not found');
        }
        // Check if any of the fields have changed
        $hasChanges = false;
        if ($this->title !== $research->title) {
            $research->title = $this->title;
            $hasChanges = true;
        }
        if ($this->author_id !== $research->author_id) {
            $research->author_id =  $this->author_id;
            $hasChanges = true;
        }
        if ($this->department_id !== $research->department_id) {
            $research->department_id = $this->department_id;
            $hasChanges = true;
        }
        if ($this->status_id !== $research->status_id) {
            $research->status_id = $this->status_id;
            $hasChanges = true;
        }
        // If no changes were made, return with an error message
        if (!$hasChanges) {
            return back()->with('error', 'No changes were made');
        }
        // Save the updated research record
        // dd($this->title);
        $research->save();

        return back()->with('success', 'Update successful');
    }
    public function mount($id)
    {
        $research = Research::find($id);
        $this->research = $research;
        $this->research_id = $research->id;
        $this->title = $research->title;
        $this->author_id = $research->author_id;
        $this->department_id = $research->department_id;
        $this->status_id = $research->status_id;
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
}
