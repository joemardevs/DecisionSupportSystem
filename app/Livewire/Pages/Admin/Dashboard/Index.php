<?php

namespace App\Livewire\Pages\Admin\Dashboard;

use App\Enums\DepartmentEnum;
use App\Models\Research;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $title = 'Dashboard';
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

        $twenty20 = Research::whereYear('created_at', '=', 2020)->count();
        $twenty21 = Research::whereYear('created_at', '=', 2020 + 1)->count();
        $twenty22 = Research::whereYear('created_at', '=', 2020 + 2)->count();
        $twenty23 = Research::whereYear('created_at', '=', 2020 + 3)->count();
        $twenty24 = Research::whereYear('created_at', '=', 2020 + 4)->count();




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

        ])->layout('livewire.layouts.guest');
    }
}
