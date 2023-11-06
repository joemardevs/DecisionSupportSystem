<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Models\Author;
use App\Models\Department;
use App\Models\Research;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Component;

class View extends Component
{
    public $research, $title, $status_id, $department_id, $research_id;
    public $venue, $date_presented, $organizer, $journal_name, $issn, $vol, $country, $date_completed, $date_issued, $reg_number, $citations, $awards, $created_at;
    public $selectedAuthors  = [];
    public $authors = [];

    public function deleteResearch($id)
    {
        $research = Research::find($id);
        $research->delete();
        $this->render();
        return to_route('research')
            ->with('error', 'Deleted');
    }
    public $researchSuccessRate, $researchFailRate;
    public function mount($id)
    {
        $research = Research::find($id);

        $this->research = $research;
        $this->research_id = $research->id;
        $this->title = $research->title;
        $this->authors = $research->authors;
        $this->department_id = $research->department_id;
        $this->status_id = $research->status_id;
        $this->venue = $research->venue;
        $this->date_presented = Carbon::parse($research->date_presented)->format('Y-m-d');
        $this->organizer = $research->organizer;
        $this->journal_name = $research->journal_name;
        $this->issn = $research->issn;
        $this->vol = $research->vol;
        $this->country = $research->country;
        $this->date_completed = Carbon::parse($research->date_completed)->format('Y-m-d');
        $this->date_issued = Carbon::parse($research->date_issued)->format('Y-m-d');
        $this->reg_number = $research->reg_number;
        $this->citations = $research->citations;
        $this->awards = $research->awards;
        $this->created_at = Carbon::parse($research->created_at)->format('Y-m-d');
    }
    public function render()
    {
        $titlePage = 'Research';
        $departments = Department::all();
        $statuses = Status::all();
        return view('livewire.pages.admin.research.view', [
            'titlePage' => $titlePage,
            'departments' => $departments,
            'statuses' => $statuses,
            'researchSuccessRate' => $this->researchSuccessRate,
            'researchFailRate' => $this->researchFailRate,
            'researchFailRate' => $this->researchFailRate,
        ])->layout('livewire.layouts.app');
    }
}
