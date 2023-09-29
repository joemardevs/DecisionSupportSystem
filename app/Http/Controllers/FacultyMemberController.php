<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\Request;

class FacultyMemberController extends Controller
{
    //
    public function index()
    {
        $facultyMembers = User::where('role_id', RoleEnum::USER->value)->get();
        // dd($facultyMembers);
        return view('livewire.pages.admin.faculty-member.index', [
            'facultyMembers' => $facultyMembers
        ]);
    }
}
