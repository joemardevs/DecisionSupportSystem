<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Enums\ResearchStatusesEnum;
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
        $memberCountCompletedResearch = $member->research()->where('status_id', '>=', ResearchStatusesEnum::COMPLETED->value)->count();
        $memberCountOngoingResearch = $member->research()->where('status_id', '<=', ResearchStatusesEnum::ON_GOING->value)->count();

        $memberCountNotCompletedResearch = $memberAllResearch - $memberCountCompletedResearch;
        if ($memberCountCompletedResearch != 0) {
            $memberNotif = ($memberAllResearch / $memberCountCompletedResearch) * 100;
        } else {
            // Handle the division by zero error here, or set $memberNotif to a default value.
            // For example, you can set it to zero or display an error message.
            $memberNotif = 0; // or handle the error as needed
        }
        return view('livewire.pages.admin.faculty-member.view', [
            'titlePage' => $titlePage,
            'memberCountOngoingResearch' => $memberCountOngoingResearch,
            'memberCountNotCompletedResearch' => $memberCountNotCompletedResearch,
            'memberNotif' => $memberNotif,
        ])->layout('livewire.layouts.app');
    }
}
