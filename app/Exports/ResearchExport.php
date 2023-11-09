<?php

namespace App\Exports;

use App\Models\Research;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResearchExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $researchCollection;
    public function __construct($researchCollection)
    {
        $this->researchCollection = $researchCollection;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->researchCollection;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($researchCollection): array
    {
        $datePresented = $researchCollection->date_presented ? Carbon::parse($researchCollection->date_presented)->format('M-d-Y') : 'N/A';
        $dateCompleted = $researchCollection->date_completed ? Carbon::parse($researchCollection->date_completed)->format('M-d-Y') : 'N/A';
        $dateIssued = $researchCollection->date_issued ? Carbon::parse($researchCollection->date_issued)->format('M-d-Y') : 'N/A';
        $createdAt = $researchCollection->created_at ? Carbon::parse($researchCollection->created_at)->format('M-d-Y') : 'N/A';
        $expected_date_of_completion = $researchCollection->expected_date_of_completion ? Carbon::parse($researchCollection->expected_date_of_completion)->format('M-d-Y') : 'N/A';

        return [
            $researchCollection->id,
            $researchCollection->department->name,
            $researchCollection->title,
            $researchCollection->status->name,
            $createdAt,
            $researchCollection->venue ?? 'N/A',
            $datePresented,
            $researchCollection->journal_name ?? 'N/A',
            $researchCollection->issn ?? 'N/A',
            $researchCollection->vol ?? 'N/A',
            $researchCollection->country ?? 'N/A',
            $dateCompleted,
            $dateIssued,
            $researchCollection->reg_number ?? 'N/A',
            $researchCollection->citations ?? 'N/A',
            $researchCollection->awards ?? 'N/A',
            // new
            $researchCollection->conferred_to ?? 'N/A',
            $researchCollection->conferred_by ?? 'N/A',
            $researchCollection->allocated_budget ?? 'N/A',
            $researchCollection->duration ?? 'N/A',
            $researchCollection->remarks ?? 'N/A',
            $researchCollection->type_of_model ?? 'N/A',
            $expected_date_of_completion
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'ID',
            'Department/College',
            'Research Title',
            'Research Status',
            'Research Started',
            'Venue',
            'Date Presented',
            'Journal Name',
            'ISSN',
            'Vol',
            'Country',
            'Date Completed',
            'Date Issued',
            'Reg Number',
            'Citations',
            'Awards',
            'Conferred to',
            'Conferred by',
            'Allocated Budget',
            'Duration',
            'Remarks',
            'Type of Model',
            'Expected Date of Completion',
        ];
    }
}
