<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Models\Author;
use Livewire\Component;

class View extends Component
{
    public $facultyMember;
    public function deleteFacultyMember($id)
    {
        $facultyMember = Author::find($id);
        $facultyMember->delete();
        return to_route('faculty-members')
            ->with('error', 'Deleted');
    }
    public function mount($id)
    {
        $facultyMember = Author::find($id);
        $this->facultyMember = $facultyMember;
    }
    public function render()
    {
        $titlePage = 'Faculty Member';

        $member = $this->facultyMember;
        $memberAllResearch = $member->research()->count();
        $memberCountCompletedResearch = $member->research()->where('status_id', '>=', 2)->count();

        $memberCountNotCompletedResearch = $memberAllResearch - $memberCountCompletedResearch;

        return view('livewire.pages.admin.faculty-member.view', [
            'titlePage' => $titlePage,
            'memberAllResearch' => $memberAllResearch,
            'memberCountNotCompletedResearch' => $memberCountNotCompletedResearch,
        ])->layout('livewire.layouts.app');
    }
}
