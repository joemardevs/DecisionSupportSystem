<?php

namespace App\Livewire\Pages\Admin\Colleges\Ccje;

use App\Enums\DepartmentEnum;
use App\Exports\ResearchExport;
use App\Models\Research;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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
        $research = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where(function ($query) use ($yearAsString) {
                $query->whereNotNull('date_presented')
                    ->whereYear('date_presented', 'LIKE', '%' . $yearAsString . '%')
                    ->orWhere(function ($query) use ($yearAsString) {
                        $query->whereNull('date_presented')
                            ->whereYear('created_at', 'LIKE', '%' . $yearAsString . '%');
                    });
            })
            ->get();
        return Excel::download(new ResearchExport($research), 'CCJE Research.xlsx');
    }
    public function render()
    {
        $title = 'CCJE';
        $ccjeResearch = Research::orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->where('department_id', '=', DepartmentEnum::CCJE->value)
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


        return view('livewire.pages.admin.colleges.ccje.index', [
            'title' => $title,
            'statuses' => $statuses,
            'ccjeResearch' => $ccjeResearch
        ])->layout('livewire.layouts.app');
    }
}
