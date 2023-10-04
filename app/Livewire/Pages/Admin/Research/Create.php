<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Models\Author;
use App\Models\Department;
use App\Models\Research;
use App\Models\Status;
use Livewire\Component;

class Create extends Component
{
    public $title, $status_id, $department_id, $venue, $date_presented, $organizer, $journal_name, $issn, $vol, $country, $date_completed, $date_issued, $reg_number;
    public $selectAuthors;
    protected $rules = [
        'title' => 'required|unique:research',
        'selectAuthors' => 'required',
        'status_id' => 'required',
        'department_id' => 'required',
    ];
    public function createResearch()
    {
        $this->validate();

        $research = Research::create([
            'title' => $this->title,
            'status_id' => $this->status_id,
            'department_id' => $this->department_id,
            'venue' => $this->venue,
            'date_presented' => $this->date_presented,
            'organizer' => $this->organizer,
            'journal_name' => $this->journal_name,
            'issn' => $this->issn,
            'vol' => $this->vol,
            'country' => $this->country,
            'date_completed' => $this->date_completed,
            'date_issued' => $this->date_issued,
            'reg_number' => $this->reg_number,
        ]);

        // Attach selected authors to the research using the pivot table 'author_research'
        $research->authors()->attach($this->selectAuthors);

        return to_route('research')
            ->with('success', 'Research created successful');
    }
    public function render()
    {
        $titlePage = 'Research';
        $authors = Author::all();
        $departments = Department::all();
        $statuses = Status::all();
        return view('livewire.pages.admin.research.create', [
            'titlePage' => $titlePage,
            'authors' => $authors,
            'departments' => $departments,
            'statuses' => $statuses,
        ])->layout('livewire.layouts.app');
    }
}
