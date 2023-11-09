<?php

namespace App\Livewire\Pages\Admin\Research;

use App\Enums\DepartmentEnum;
use App\Enums\RoleEnum;
use App\Models\Author;
use App\Models\Department;
use App\Models\Research;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $research, $title, $status_id, $department_id, $research_id;
    public $venue, $date_presented, $organizer, $journal_name, $issn, $vol, $country, $date_completed, $date_issued, $reg_number, $citations, $awards, $created_at;
    public $lead_author, $allocated_budget, $duration, $remarks, $type_of_model, $conferred_to, $conferred_by, $expected_date_of_completion;
    public $selectedAuthors  = [];
    public $authors = [];
    protected $rules = [
        'title' => 'required',
        // 'selectedAuthors' => 'required',
        'status_id' => 'required',
        'lead_author' => 'required',
        'department_id' => 'required',
        'created_at' => 'required',
    ];
    public function updateResearch()
    {

        $this->validate();
        // Find the research record based on the research_id
        $research = Research::find($this->research_id);

        // Check if the research record exists
        if (!$research) {
            return back()->with('error', 'Research not found');
        }

        // Begin a database transaction to ensure data consistency
        DB::beginTransaction();
        $this->authors = Author::whereIn('id', $this->selectedAuthors)->get();

        try {
            $attributes = [
                'venue',
                'organizer', 'journal_name', 'issn', 'vol', 'country',  'reg_number',  'citations',   'awards', 'allocated_budget', 'duration', 'remarks', 'type_of_model', 'conferred_to', 'conferred_by'
            ];
            $dateAttributes = [
                'date_presented',
                'date_completed', 'date_issued',
                'expected_date_of_completion',
                'created_at'
            ];

            $hasChanges = false;
            foreach ($dateAttributes as $dateAttribute) {
                if (Carbon::parse($this->$dateAttribute)->format('Y-m-d') !== Carbon::parse($research->$dateAttribute)->format('Y-m-d')) {
                    $research->$dateAttribute = $this->$dateAttribute;
                    $hasChanges = true;
                }
            }
            foreach ($attributes as $attribute) {
                if ($this->$attribute !== $research->$attribute) {
                    $research->$attribute = $this->$attribute;
                    $hasChanges = true;
                }
            }

            if ($this->title !== $research->title) {
                $research->title = $this->title;
                $hasChanges = true;
            }

            if (!empty($this->selectedAuthors)) {
                $research->authors()->wherePivot('lead_author', false)->detach();
                $research->authors()->attach($this->selectedAuthors, ['lead_author' => false]);
                $hasChanges = true;
            }

            // lead author
            if (!empty($this->lead_author) && $this->lead_author !== $research->authors()->wherePivot('lead_author', true)->pluck('authors.id')->first()) {
                // Detach any existing lead authors only if the lead author is not empty
                $research->authors()->wherePivot('lead_author', true)->detach();

                // Attach the new lead author
                $research->authors()->attach($this->lead_author, ['lead_author' => true]);
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
            if ($hasChanges) {
                // Save the updated research record
                $research->save();
                // Commit the transaction if everything is successful
                DB::commit();
                return to_route('research')->with('success', 'Update successful');
            } else {
                return to_route('research')->with('error', 'No changes were made');
            }
        } catch (\Exception $e) {
            dd($e);
            // Rollback the transaction if an exception occurs
            DB::rollback();
            return to_route('research')->with('error', 'An error occurred while updating the research');
        }
    }
    public function deleteResearch($id)
    {
        $research = Research::find($id);
        $research->delete();
        $this->render();
        return to_route('research')
            ->with('error', 'Deleted');
    }
    public function goBack()
    {
        return to_route('research');
    }
    public function mount($id)
    {
        $research = Research::find($id);

        $this->research = $research;
        $this->research_id = $research->id;
        $this->title = $research->title;
        $this->authors = $research->authors()->wherePivot('lead_author', false)->get();
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
        // new
        foreach ($research->authors as $author) {
            if ($author->pivot->lead_author) {
                $author->name;
                $this->lead_author = $author->id;
            }
        }
        $this->conferred_to = $research->conferred_to;
        $this->conferred_by = $research->conferred_by;
        $this->allocated_budget = $research->allocated_budget;
        $this->duration = $research->duration;
        $this->remarks = $research->remarks;
        $this->type_of_model = $research->type_of_model;
        $this->expected_date_of_completion = $research->expected_date_of_completion;
    }
    public function render()
    {
        $titlePage = 'Research';
        $statuses = Status::all();
        $departments = Department::all();
        $authors = Author::all();
        return view('livewire.pages.admin.research.edit', [
            'titlePage' => $titlePage,
            'selectAuthors' => $authors,
            'departments' => $departments,
            'statuses' => $statuses,
        ])->layout('livewire.layouts.app');
    }
}
