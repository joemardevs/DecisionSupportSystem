<?php

namespace App\Exports;

use App\Models\Author;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AuthorExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // private $columns = [
    //     'id',
    //     'name',
    //     'department_id',
    //     'position',
    //     'status',
    //     'sex',
    //     'date_of_birth',
    //     'date_of_original_appointment',
    //     'highest_educational_attaintment',
    //     'address',
    //     'note',
    // ];
    use Exportable;

    // a place to store the author dependency
    private $author;

    // use constructor to handle dependency injection
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    // set the collection of members to export
    public function collection()
    {
        return $this->author;
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($author): array
    {
        return [
            $author->id,
            $author->name,
            $author->department->name,
            $author->position,
            $author->status,
            $author->sex,
            Carbon::parse($author->date_of_birth)->format('Y-m-d'),
            Carbon::parse($author->date_of_original_appointment)->format('Y-m-d'),
            $author->highest_educational_attaintment,
            $author->address,
            $author->note,

        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Department/College',
            'Position',
            'Status',
            'Sex',
            'Date of birth',
            'Date of original appointment',
            'Highest educational attainment',
            'Address',
            'Note',
        ];
    }
}
