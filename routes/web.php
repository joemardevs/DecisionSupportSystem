<?php

use App\Livewire\Auth\Login;
use App\Livewire\Components\Sidebar as Sidebar;
use App\Livewire\Pages\Admin\Dashboard\Index as Dashboard;
use App\Livewire\Pages\Admin\FacultyMember\Index as FacultyMember;
use App\Livewire\Pages\Admin\Research\Index as Research;
use App\Livewire\Pages\Admin\Colleges\Cbm\Index as Cbm;
use App\Livewire\Pages\Admin\Colleges\Ccje\Index as Ccje;
use App\Livewire\Pages\Admin\Colleges\Ccsict\Index as Ccsict;
use App\Livewire\Pages\Admin\Colleges\Ced\Index as Ced;
use App\Livewire\Pages\Admin\Colleges\Iat\Index as Iat;
use App\Livewire\Pages\Admin\Colleges\Ps\Index as Ps;
use App\Livewire\Pages\Admin\Colleges\Sas\Index as Sas;
use App\Livewire\Pages\Admin\Setting\Index as Settings;
use App\Livewire\Pages\Admin\Setting\UpdatePassword;
use App\Livewire\Pages\Admin\Research\Edit as ResearchEdit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});
Route::middleware('guest')->group(function () {
    // Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/login', Login::class)->name('login');
    Route::post('/login', Login::class)->name('login');
    // Route::post('/', [AuthController::class, 'signIn'])->name('sign-in');
});



Route::middleware('auth', 'is.admin')->group(function () {

    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('/research', Research::class)
        ->name('research');

    Route::get('/research/edit/{id}', ResearchEdit::class)
        ->name('edit.research');

    Route::get('/faculty-members', FacultyMember::class)
        ->name('faculty-members');

    Route::get('/cbm', Cbm::class)
        ->name('cbm');

    Route::get('/ccje', Ccje::class)
        ->name('ccje');

    Route::get('/ccsict', Ccsict::class)
        ->name('ccsict');

    Route::get('/ced', Ced::class)
        ->name('ced');

    Route::get('/iat', Iat::class)
        ->name('iat');

    Route::get('/ps', Ps::class)
        ->name('ps');

    Route::get('/sas', Sas::class)
        ->name('sas');

    Route::get('/settings', Settings::class)
        ->name('settings');

    Route::get('/settings/update-password', UpdatePassword::class)
        ->name('password');

    Route::get('/sign-out', Sidebar::class)
        ->name('sign-out');
});
