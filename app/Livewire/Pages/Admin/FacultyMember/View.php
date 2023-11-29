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
        $memberCountCompletedResearch = $member->research()
            ->where('status_id', '>=', ResearchStatusesEnum::COMPLETED)
            ->where('status_id', '<=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES)
            ->count();
        $memberCountArchivedResearch = $member->research()->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)->count();

        $memberCountNotCompletedResearch = $memberCountArchivedResearch - $memberCountCompletedResearch;
        // dd($memberCountNotCompletedResearch);
        if ($memberCountCompletedResearch != 0) {
            $memberNotif = ($memberAllResearch / $memberCountCompletedResearch) * 100;
        } else {
            // Handle the division by zero error here, or set $memberNotif to a default value.
            // For example, you can set it to zero or display an error message.
            $memberNotif = 0; // or handle the error as needed
        }
        return view('livewire.pages.admin.faculty-member.view', [
            'titlePage' => $titlePage,
            'memberCountArchivedResearch' => $memberCountArchivedResearch,
            'memberCountCompletedResearch' => $memberCountCompletedResearch,
            'memberNotif' => $memberNotif,
        ])->layout('livewire.layouts.app');
    }
}
