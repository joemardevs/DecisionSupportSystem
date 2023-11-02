<?php

namespace App\Livewire\Pages\Admin\Colleges\Cbm;

use App\Enums\DepartmentEnum;
use App\Models\Research;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResearchExport;



class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search;
    public $status = '';
    public $year;
    public function export()
    {
        $yearAsString = strval($this->year);
        $research = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where(function ($query) use ($yearAsString) {
                $query->whereNotNull('date_presented')
                    ->whereYear('date_presented', 'LIKE', '%' . $yearAsString . '%')
                    ->orWhere(function ($query) use ($yearAsString) {
                        $query->whereNull('date_presented')
                            ->whereYear('created_at', 'LIKE', '%' . $yearAsString . '%');
                    });
            })
            ->get();
        return Excel::download(new ResearchExport($research), 'CBM Research.xlsx');
    }

    public function render()
    {
        $title = 'CBM';
        $cbmResearch = Research::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->where('department_id', '=', DepartmentEnum::CBM->value)
            ->when($this->status  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->status !== '') {
                        $subquery->where('status_id', $this->status);
                    }
                    if ($this->year !== '') {
                        $yearAsString = strval($this->year);
                        $subquery->where(function ($query) use ($yearAsString) {
                            $query->whereNotNull('date_presented')
                                ->whereYear('date_presented', 'LIKE', '%' . $yearAsString . '%')
                                ->orWhere(function ($query) use ($yearAsString) {
                                    $query->whereNull('date_presented')
                                        ->whereYear('created_at', 'LIKE', '%' . $yearAsString . '%');
                                });
                        });
                    }
                });
            })
            ->search($this->search)
            ->paginate($this->perPage);
        $statuses = Status::all();


        return view('livewire.pages.admin.colleges.cbm.index', [
            'title' => $title,
            'statuses' => $statuses,
            'cbmResearch' => $cbmResearch
        ])->layout('livewire.layouts.app');
    }
}
