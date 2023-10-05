<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Models\Author;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public $name, $department_id, $position, $status, $sex, $date_of_birth, $date_of_original_appointment, $highest_educational_attaintment, $address;
    protected $rules = [
        'name' => 'required|string|max:255|unique:authors',
        'department_id' => 'required|numeric',
        'position' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'sex' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'date_of_original_appointment' => 'required|date',
        'highest_educational_attaintment' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ];
    public function createFacultyMember()
    {
        $this->validate();

        Author::create([
            'name' => $this->name,
            'department_id' => $this->department_id,
            'position' => $this->position,
            'status' => $this->status,
            'sex' => $this->sex,
            'date_of_birth' => $this->date_of_birth,
            'date_of_original_appointment' => $this->date_of_original_appointment,
            'highest_educational_attaintment' => $this->highest_educational_attaintment,
            'address' => $this->address,
        ]);
        return to_route('faculty-members')
            ->with('success', 'Faculty created successful');
    }
    public function render()
    {
        $titlePage = 'Faculty Member';
        $departments = Department::all();
        return view('livewire.pages.admin.faculty-member.create', [
            'titlePage' => $titlePage,
            'departments' => $departments,
        ])
            ->layout('livewire.layouts.app');
    }
}
