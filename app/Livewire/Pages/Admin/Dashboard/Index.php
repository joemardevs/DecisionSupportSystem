<?php

namespace App\Livewire\Pages\Admin\Dashboard;

use App\Enums\DepartmentEnum;
use App\Enums\ResearchStatusesEnum;
use App\Models\Author;
use App\Models\Department;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $perPage = 5;
    public $position = '';
    public Author $selectedAuthor;
    public $note;
    public $year;
    public $colleges = 0;
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
    public function filter()
    {
        // male vs female
        $male = Author::when($this->colleges || $this->year, function ($query) {
            $query->where(function ($subquery) {
                if ($this->colleges !== '' && $this->colleges !== 0) {
                    $subquery->where('department_id', $this->colleges);
                }
                if ($this->year !== '') {
                    $yearAsString = strval($this->year);
                    $subquery->whereYear('date_of_birth', 'LIKE', '%' . $yearAsString . '%');
                }
            });
        })->where('sex', 'male')->count();
        $female = Author::when($this->colleges || $this->year, function ($query) {
            $query->where(function ($subquery) {
                if ($this->colleges !== '' && $this->colleges !== 0) {
                    $subquery->where('department_id', $this->colleges);
                }
                if ($this->year !== '') {
                    $yearAsString = strval($this->year);
                    $subquery->whereYear('date_of_birth', 'LIKE', '%' . $yearAsString . '%');
                }
            });
        })->where('sex', 'female')->count();

        //pie chart filter
        $allOnGoing = Research::where('status_id', ResearchStatusesEnum::ON_GOING->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allCompleted = Research::where('status_id', ResearchStatusesEnum::COMPLETED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allPresented = Research::where('status_id', ResearchStatusesEnum::PRESENTED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allPublished = Research::where('status_id', ResearchStatusesEnum::PUBLISHED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allIntellectualProperties = Research::where('status_id', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allArchived = Research::where('status_id', ResearchStatusesEnum::ARCHIVED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();

        //all research line chart data
        $twenty20Totwenty21 = Research::when($this->colleges, function ($query) {
            $query->where('department_id', $this->colleges);
        })
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $twenty21Totwenty22 = Research::when($this->colleges, function ($query) {
            $query->where('department_id', $this->colleges);
        })
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $twenty22Totwenty23 = Research::when($this->colleges, function ($query) {
            $query->where('department_id', $this->colleges);
        })
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $twenty23Totwenty24 = Research::when($this->colleges, function ($query) {
            $query->where('department_id', $this->colleges);
        })
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $twenty24Totwenty25 = Research::when($this->colleges, function ($query) {
            $query->where('department_id', $this->colleges);
        })
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();

        $this->dispatch(
            'filter-colleges',
            gender: [
                'Male' => $male,
                'Female' => $female,
            ],
            researchesPieChart: [
                'OnGoing' => $allOnGoing,
                'Completed' => $allCompleted,
                'Presented' => $allPresented,
                'Published' => $allPublished,
                'IntellectualProperties' => $allIntellectualProperties,
                'Archieved' => $allArchived,
            ],
            researchesLineChart: [
                '2020-2021' => $twenty20Totwenty21,
                '2021-2022' => $twenty21Totwenty22,
                '2022-2023' => $twenty22Totwenty23,
                '2023-2024' => $twenty23Totwenty24,
                '2024-2025' => $twenty24Totwenty25,
            ],
        );
    }
    public function render()
    {
        $title = 'Dashboard';
        $uniquePositions = Author::pluck('position')->unique()->toArray();
        $allColleges = Department::all();

        $allResearches = Research::when($this->colleges  || $this->year, function ($query) {
            $query->where(function ($subquery) {
                if ($this->colleges !== '' && $this->colleges !== 0) {
                    $subquery->where('department_id', $this->colleges);
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
        })->count();
        //all pie chart data
        $allOnGoing = Research::where('status_id', ResearchStatusesEnum::ON_GOING->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allCompleted = Research::where('status_id', ResearchStatusesEnum::COMPLETED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allPresented = Research::where('status_id', ResearchStatusesEnum::PRESENTED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allPublished = Research::where('status_id', ResearchStatusesEnum::PUBLISHED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allIntellectualProperties = Research::where('status_id', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        $allArchived = Research::where('status_id', ResearchStatusesEnum::ARCHIVED->value)
            ->when($this->colleges  || $this->year, function ($query) {
                $query->where(function ($subquery) {
                    if ($this->colleges !== '' && $this->colleges !== 0) {
                        $subquery->where('department_id', $this->colleges);
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
            ->count();
        //cbm pie chart data
        $cbmOnGoing = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $cbmCompleted = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $cbmPresented = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $cbmPublished = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $cbmIntellectualProperties = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $cbmArchieved = Research::where('department_id', DepartmentEnum::CBM->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //ccje pie chart data
        $ccjeOnGoing = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $ccjeCompleted = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $ccjePresented = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $ccjePublished = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $ccjeIntellectualProperties = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $ccjeArchieved = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //ccsict pie chart data
        $ccsictOnGoing = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $ccsictCompleted = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $ccsictPresented = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $ccsictPublished = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $ccsictIntellectualProperties = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $ccsictArchieved = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //ced pie chart data
        $cedOnGoing = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $cedCompleted = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $cedPresented = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $cedPublished = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $cedIntellectualProperties = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $cedArchieved = Research::where('department_id', DepartmentEnum::CED->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //iat pie chart data
        $iatOnGoing = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $iatCompleted = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $iatPresented = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $iatPublished = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $iatIntellectualProperties = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $iatArchieved = Research::where('department_id', DepartmentEnum::IAT->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //ps pie chart data
        $psOnGoing = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $psCompleted = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $psPresented = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $psPublished = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $psIntellectualProperties = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $psArchieved = Research::where('department_id', DepartmentEnum::PS->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //sas pie chart data
        $sasOnGoing = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::ON_GOING->value)
            ->count();
        $sasCompleted = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::COMPLETED->value)
            ->count();
        $sasPresented = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::PRESENTED->value)
            ->count();
        $sasPublished = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::PUBLISHED->value)
            ->count();
        $sasIntellectualProperties = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
            ->count();
        $sasArchieved = Research::where('department_id', DepartmentEnum::SAS->value)
            ->where('status_id', '=', ResearchStatusesEnum::ARCHIVED->value)
            ->count();
        //all research line chart data
        $twenty20Totwenty21 = Research::whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $twenty21Totwenty22 = Research::whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $twenty22Totwenty23 = Research::whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $twenty23Totwenty24 = Research::whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $twenty24Totwenty25 = Research::whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //cbm research line chart data
        $cbmTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::CBM->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $cbmTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::CBM->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $cbmTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::CBM->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $cbmTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::CBM->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $cbmTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::CBM->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //ccje research line chart data
        $ccjeTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $ccjeTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $ccjeTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $ccjeTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $ccjeTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::CCJE->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //ccsict research line chart data
        $ccsictTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $ccsictTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $ccsictTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $ccsictTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $ccsictTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::CCSICT->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //ced research line chart data
        $cedTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::CED->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $cedTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::CED->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $cedTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::CED->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $cedTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::CED->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $cedTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::CED->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //iat research line chart data
        $iatTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::IAT->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $iatTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::IAT->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $iatTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::IAT->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $iatTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::IAT->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $iatTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //ps research line chart data
        $psTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $psTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $psTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $psTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $psTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::PS->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();
        //sas research line chart data
        $sasTwenty20Totwenty21 = Research::where('department_id', DepartmentEnum::SAS->value)
            ->whereYear('created_at', '=', 2020)
            ->orWhereYear('created_at', '=', 2021)
            ->count();
        $sasTwenty21Totwenty22 = Research::where('department_id', DepartmentEnum::SAS->value)
            ->whereYear('created_at', '=', 2021)
            ->orWhereYear('created_at', '=', 2022)
            ->count();
        $sasTwenty22Totwenty23 = Research::where('department_id', DepartmentEnum::SAS->value)
            ->whereYear('created_at', '=', 2022)
            ->orWhereYear('created_at', '=', 2023)
            ->count();
        $sasTwenty23Totwenty24 = Research::where('department_id', DepartmentEnum::SAS->value)
            ->whereYear('created_at', '=', 2023)
            ->orWhereYear('created_at', '=', 2024)
            ->count();
        $sasTwenty24Totwenty25 = Research::where('department_id', DepartmentEnum::SAS->value)
            ->whereYear('created_at', '=', 2024)
            ->orWhereYear('created_at', '=', 2025)
            ->count();

        // Table data
        $authors = Author::when($this->position !== '', function ($query) {
            $query->where('position', '=', $this->position);
        })->get();
        // $authors = Author::when($this->colleges || $this->year || $this->position, function ($query) {
        //     $query->where(function ($subquery) {
        //         if ($this->position !== '') {
        //             $subquery->where('position', '=', $this->position);
        //         }
        //         if ($this->colleges !== '' && $this->colleges !== 0) {
        //             $subquery->where('department_id', $this->colleges);
        //         }
        //         if ($this->year !== '') {
        //             $yearAsString = strval($this->year);
        //             $subquery->where(function ($query) use ($yearAsString) {
        //                 $query->whereYear('date_of_birth', 'LIKE', '%' . $yearAsString . '%');
        //             });
        //         }
        //     });
        // })->get();

        $authorsBelow60Percent = [];

        foreach ($authors as $author) {
            $authorAllResearch = $author->research()->count();
            $authorAboveCompletedResearch = $author->research()
                ->where('status_id', '>=', ResearchStatusesEnum::COMPLETED->value)
                ->where('status_id', '<=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
                ->count();

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

        $authorsAbove60Percent = [];

        foreach ($authors as $author) {
            $authorAllResearch = $author->research()->count();
            $authorAboveCompletedResearch = $author->research()
                ->where('status_id', '>=', ResearchStatusesEnum::COMPLETED->value)
                ->where('status_id', '<=', ResearchStatusesEnum::INTELLECTUAL_PROPERTIES->value)
                ->count();

            // Check if $authorAllResearch is zero to avoid division by zero
            if ($authorAllResearch > 0) {
                $authorSuccessRate = ($authorAboveCompletedResearch / $authorAllResearch) * 100;

                if ($authorSuccessRate > 60) {
                    $authorsAbove60Percent[] = $author;
                }
            } else {
                // Handle the case where $authorAllResearch is zero (division by zero)
                // Here, we set the success rate to -1 to indicate an error condition.
                $authorsAbove60Percent[] = $author;
            }
        }

        // Paginate the $authorsAbove60Percent array
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $authorsAbove60PercentPaginated = new LengthAwarePaginator(
            array_slice($authorsAbove60Percent, ($currentPage - 1) * $this->perPage, $this->perPage),
            count($authorsAbove60Percent),
            $this->perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        // $authorsBelow60PercentPaginated->when($this->colleges || $this->year, function ($query) {
        //     $query->where(function ($subquery) {
        //         if ($this->colleges !== '' && $this->colleges !== 0) {
        //             $subquery->where('department_id', $this->colleges);
        //         }
        //         if ($this->year !== '') {
        //             $yearAsString = strval($this->year);
        //             $subquery->where(function ($query) use ($yearAsString) {
        //                 $query->whereNotNull('date_presented')
        //                     ->whereYear('date_presented', 'LIKE', '%' . $yearAsString . '%')
        //                     ->orWhere(function ($query) use ($yearAsString) {
        //                         $query->whereNull('date_presented')
        //                             ->whereYear('created_at', 'LIKE', '%' . $yearAsString . '%');
        //                     });
        //             });
        //         }
        //     });
        // });


        // male vs female
        $male = Author::where('sex', 'male')->count();
        $female = Author::where('sex', 'female')->count();
        return view('livewire.pages.admin.dashboard.index', [
            'title' => $title,
            'uniquePositions' => $uniquePositions,
            'allColleges' => $allColleges,

            //all pie chart
            'allOnGoing' => $allOnGoing,
            'allCompleted' => $allCompleted,
            'allPresented' => $allPresented,
            'allPublished' => $allPublished,
            'allIntellectualProperties' => $allIntellectualProperties,
            'allArchived' => $allArchived,
            //cbm pie chart
            'cbmOnGoing' => $cbmOnGoing,
            'cbmCompleted' => $cbmCompleted,
            'cbmPresented' => $cbmPresented,
            'cbmPublished' => $cbmPublished,
            'cbmIntellectualProperties' => $cbmIntellectualProperties,
            'cbmArchieved' => $cbmArchieved,
            //ccje pie chart
            'ccjeOnGoing' => $ccjeOnGoing,
            'ccjeCompleted' => $ccjeCompleted,
            'ccjePresented' => $ccjePresented,
            'ccjePublished' => $ccjePublished,
            'ccjeIntellectualProperties' => $ccjeIntellectualProperties,
            'ccjeArchieved' => $ccjeArchieved,
            //ccsict pie chart
            'ccsictOnGoing' => $ccsictOnGoing,
            'ccsictCompleted' => $ccsictCompleted,
            'ccsictPresented' => $ccsictPresented,
            'ccsictPublished' => $ccsictPublished,
            'ccsictIntellectualProperties' => $ccsictIntellectualProperties,
            'ccsictArchieved' => $ccsictArchieved,
            //ccsict pie chart
            'cedOnGoing' => $cedOnGoing,
            'cedCompleted' => $cedCompleted,
            'cedPresented' => $cedPresented,
            'cedPublished' => $cedPublished,
            'cedIntellectualProperties' => $cedIntellectualProperties,
            'cedArchieved' => $cedArchieved,
            //iat pie chart
            'iatOnGoing' => $iatOnGoing,
            'iatCompleted' => $iatCompleted,
            'iatPresented' => $iatPresented,
            'iatPublished' => $iatPublished,
            'iatIntellectualProperties' => $iatIntellectualProperties,
            'iatArchieved' => $iatArchieved,
            //ps pie chart
            'psOnGoing' => $psOnGoing,
            'psCompleted' => $psCompleted,
            'psPresented' => $psPresented,
            'psPublished' => $psPublished,
            'psIntellectualProperties' => $psIntellectualProperties,
            'psArchieved' => $psArchieved,
            //sas pie chart
            'sasOnGoing' => $sasOnGoing,
            'sasCompleted' => $sasCompleted,
            'sasPresented' => $sasPresented,
            'sasPublished' => $sasPublished,
            'sasIntellectualProperties' => $sasIntellectualProperties,
            'sasArchieved' => $sasArchieved,
            // all research line chart
            'twenty20Totwenty21' => $twenty20Totwenty21,
            'twenty21Totwenty22' => $twenty21Totwenty22,
            'twenty22Totwenty23' => $twenty22Totwenty23,
            'twenty23Totwenty24' => $twenty23Totwenty24,
            'twenty24Totwenty25' => $twenty24Totwenty25,
            // cbm research line chart
            'cbmTwenty20Totwenty21' => $cbmTwenty20Totwenty21,
            'cbmTwenty21Totwenty22' => $cbmTwenty21Totwenty22,
            'cbmTwenty22Totwenty23' => $cbmTwenty22Totwenty23,
            'cbmTwenty23Totwenty24' => $cbmTwenty23Totwenty24,
            'cbmTwenty24Totwenty25' => $cbmTwenty24Totwenty25,
            // ccje research line chart
            'ccjeTwenty20Totwenty21' => $ccjeTwenty20Totwenty21,
            'ccjeTwenty21Totwenty22' => $ccjeTwenty21Totwenty22,
            'ccjeTwenty22Totwenty23' => $ccjeTwenty22Totwenty23,
            'ccjeTwenty23Totwenty24' => $ccjeTwenty23Totwenty24,
            'ccjeTwenty24Totwenty25' => $ccjeTwenty24Totwenty25,
            // ccsict research line chart
            'ccsictTwenty20Totwenty21' => $ccsictTwenty20Totwenty21,
            'ccsictTwenty21Totwenty22' => $ccsictTwenty21Totwenty22,
            'ccsictTwenty22Totwenty23' => $ccsictTwenty22Totwenty23,
            'ccsictTwenty23Totwenty24' => $ccsictTwenty23Totwenty24,
            'ccsictTwenty24Totwenty25' => $ccsictTwenty24Totwenty25,
            // ced research line chart
            'cedTwenty20Totwenty21' => $cedTwenty20Totwenty21,
            'cedTwenty21Totwenty22' => $cedTwenty21Totwenty22,
            'cedTwenty22Totwenty23' => $cedTwenty22Totwenty23,
            'cedTwenty23Totwenty24' => $cedTwenty23Totwenty24,
            'cedTwenty24Totwenty25' => $cedTwenty24Totwenty25,
            // iat research line chart
            'iatTwenty20Totwenty21' => $iatTwenty20Totwenty21,
            'iatTwenty21Totwenty22' => $iatTwenty21Totwenty22,
            'iatTwenty22Totwenty23' => $iatTwenty22Totwenty23,
            'iatTwenty23Totwenty24' => $iatTwenty23Totwenty24,
            'iatTwenty24Totwenty25' => $iatTwenty24Totwenty25,
            // ps research line chart
            'psTwenty20Totwenty21' => $psTwenty20Totwenty21,
            'psTwenty21Totwenty22' => $psTwenty21Totwenty22,
            'psTwenty22Totwenty23' => $psTwenty22Totwenty23,
            'psTwenty23Totwenty24' => $psTwenty23Totwenty24,
            'psTwenty24Totwenty25' => $psTwenty24Totwenty25,
            // sas research line chart
            'sasTwenty20Totwenty21' => $sasTwenty20Totwenty21,
            'sasTwenty21Totwenty22' => $sasTwenty21Totwenty22,
            'sasTwenty22Totwenty23' => $sasTwenty22Totwenty23,
            'sasTwenty23Totwenty24' => $sasTwenty23Totwenty24,
            'sasTwenty24Totwenty25' => $sasTwenty24Totwenty25,
            'authorsBelow60PercentPaginated' => $authorsBelow60PercentPaginated,
            'authorsAbove60PercentPaginated' => $authorsAbove60PercentPaginated,
            'male' => $male,
            'female' => $female,
            'allResearches' => $allResearches
        ])->layout('livewire.layouts.app');
    }
}
