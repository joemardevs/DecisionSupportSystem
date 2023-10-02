<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Enums\DepartmentEnum;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $faculty_member, $faculty_member_id, $name, $department_id, $position, $status, $sex, $date_of_birth, $date_of_original_appointment, $highest_educational_attaintment, $address;
    protected $rules = [
        'name' => 'required',
        'department_id' => 'required',
        'position' => 'required',
        'status' => 'required',
        'sex' => 'required',
        'date_of_birth' => 'required',
        'date_of_original_appointment' => 'required',
        'highest_educational_attaintment' => 'required',
        'address' => 'required',
    ];
    public function updateFacultyMember()
    {
        $this->validate();
        $member = User::find($this->faculty_member_id);

        if (!$member) {
            return back()->with('error', 'Faculty member not found');
        }

        $attributes = [
            'name', 'department_id', 'position', 'status', 'sex',
            'highest_educational_attaintment', 'address'
        ];

        $hasChanges = false;

        foreach ($attributes as $attribute) {
            if ($this->$attribute !== $member->$attribute) {
                $member->$attribute = $this->$attribute;
                $hasChanges = true;
            }
        }
        if (Carbon::parse($this->date_of_birth)->format('Y-m-d') !== Carbon::parse($member->date_of_birth)->format('Y-m-d')) {
            $member->date_of_birth = $this->date_of_birth;
            $hasChanges = true;
        }
        if (Carbon::parse($this->date_of_original_appointment)->format('Y-m-d') !== Carbon::parse($member->date_of_original_appointment)->format('Y-m-d')) {
            $member->date_of_original_appointment = $this->date_of_original_appointment;
            $hasChanges = true;
        }

        if (!$hasChanges) {
            return back()->with('error', 'No changes were made');
        }

        $member->save();

        return back()->with('success', 'Update successful');
    }
    public function mount($id)
    {
        $facultyMember = User::find($id);
        $this->faculty_member = $facultyMember;
        $this->faculty_member_id = $facultyMember->id;
        $this->name = $facultyMember->name;
        $this->department_id = $facultyMember->department_id;
        $this->position = $facultyMember->position;
        $this->status = $facultyMember->status;
        $this->sex = $facultyMember->sex;
        $this->date_of_birth = Carbon::parse($facultyMember->date_of_birth)->format('Y-m-d');
        $this->date_of_original_appointment = Carbon::parse($facultyMember->date_of_original_appointment)->format('Y-m-d');
        $this->highest_educational_attaintment = $facultyMember->highest_educational_attaintment;
        $this->address = $facultyMember->address;
    }
    public function render()
    {
        $titlePage = 'Faculty Member';
        $departments = Department::where('id', '>=', DepartmentEnum::CBM->value)->get();

        return view('livewire.pages.admin.faculty-member.edit', [
            'titlePage' => $titlePage,
            'departments' => $departments,
        ])->layout('livewire.layouts.app');
    }
}
