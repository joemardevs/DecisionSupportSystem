<?php

namespace App\Livewire\Pages\Admin\FacultyMember;

use App\Enums\ResearchStatusesEnum;
use App\Models\Author;
use Livewire\Component;

class View extends Component
{
    public $facultyMember;
    public $facultyResearches;
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
        $this->facultyResearches = $facultyMember->research()->get();
    }
    public function render()
    {
        $titlePage = 'Faculty Member';

        $member = $this->facultyMember;
        $memberAllResearch = $member->research()->count();
        $memberCountCompletedResearch = $member->research()
            ->where('status_id', '>=', ResearchStatusesEnum::COMPLETED->value)
            ->where('status_id', '<=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
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

        $allResearch = $member->research()->count();
        $completedResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $ongoingResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $publishedResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $presentedResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $intellectualResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $archivedResearch = $member->research()
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        return view('livewire.pages.admin.faculty-member.view', [
            'titlePage' => $titlePage,
            'memberCountArchivedResearch' => $memberCountArchivedResearch,
            'memberCountCompletedResearch' => $memberCountCompletedResearch,
            'memberNotif' => $memberNotif,
            'allResearch' => $allResearch,
            'completedResearch' => $completedResearch,
            'ongoingResearch' => $ongoingResearch,
            'publishedResearch' => $publishedResearch,
            'presentedResearch' => $presentedResearch,
            'intellectualResearch' => $intellectualResearch,
            'archivedResearch' => $archivedResearch,
        ])->layout('livewire.layouts.app');
    }
}
