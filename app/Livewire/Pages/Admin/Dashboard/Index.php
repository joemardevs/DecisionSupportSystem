<?php

namespace App\Livewire\Pages\Admin\Dashboard;

use App\Enums\DepartmentEnum;
use App\Models\Author;
use App\Models\Research;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $perPage = 2;
    public Author $selectedAuthor;
    public $note;
    use WithPagination;
    public function showAddNoteModal(Author $author)
    {
        $this->selectedAuthor = $author;
        $this->note = $author->note;
        $this->dispatch('open-modal');
    }
    public function addNote(Author $author)
    {
        if ($this->note !== $author->note) {
            $author->note = $this->note;
            $author->save();
            $this->dispatch('close-modal');
            return to_route('dashboard')
                ->with('success', 'Note added to the author.');
        }
    }
    public function render()
    {
        $title = 'Dashboard';
        //pie chart data
        $CBM = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '>=', 2)
            ->count();
        $CCJE = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '>=', 2)
            ->count();
        $CCSICT = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '>=', 2)
            ->count();;
        $CED = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '>=', 2)
            ->count();;
        $IAT = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '>=', 2)
            ->count();;
        $PS = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '>=', 2)
            ->count();;
        $SAS = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '>=', 2)
            ->count();;

        //bar chart data
        $twenty20 = Research::whereYear('created_at', '=', 2020)->count();
        $twenty21 = Research::whereYear('created_at', '=', 2020 + 1)->count();
        $twenty22 = Research::whereYear('created_at', '=', 2020 + 2)->count();
        $twenty23 = Research::whereYear('created_at', '=', 2020 + 3)->count();
        $twenty24 = Research::whereYear('created_at', '=', 2020 + 4)->count();

        // Table data
        $authors = Author::all();

        $authorsBelow60Percent = [];

        foreach ($authors as $author) {
            $authorAllResearch = $author->research()->count();
            $authorAboveCompletedResearch = $author->research()->where('status_id', '>=', 2)->count();

            // Check if $authorAllResearch is zero to avoid division by zero
            if ($authorAllResearch > 0) {
                $authorSuccessRate = ($authorAboveCompletedResearch / $authorAllResearch) * 100;

                if ($authorSuccessRate < 60) {
                    $authorsBelow60Percent[] = $author;
                }
            } else {
                // Handle the case where $authorAllResearch is zero (division by zero)
                // Here, we set the success rate to -1 to indicate an error condition.
                $authorsBelow60Percent[] = $author;
            }
        }

        // Paginate the $authorsBelow60Percent array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $authorsBelow60PercentPaginated = new LengthAwarePaginator(
            array_slice($authorsBelow60Percent, ($currentPage - 1) * $this->perPage, $this->perPage),
            count($authorsBelow60Percent),
            $this->perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.pages.admin.dashboard.index', [
            'title' => $title,
            'CBM' => $CBM,
            'CCJE' => $CCJE,
            'CCSICT' => $CCSICT,
            'CED' => $CED,
            'IAT' => $IAT,
            'PS' => $PS,
            'SAS' => $SAS,
            'twenty20' => $twenty20,
            'twenty21' => $twenty21,
            'twenty22' => $twenty22,
            'twenty23' => $twenty23,
            'twenty24' => $twenty24,
            'authorsBelow60Percent' => $authorsBelow60PercentPaginated
        ])->layout('livewire.layouts.guest');
    }
}
