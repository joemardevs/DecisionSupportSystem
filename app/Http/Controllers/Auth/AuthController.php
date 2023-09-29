<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('livewire.auth.login');
    }
    public function signIn(Request $request)
    {
        // dd('test');
        $validatedForm = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd(auth()->attempt($validatedForm));
        if (auth()->attempt($validatedForm)) {
            // dd(auth()->user());
            return to_route('dashboard');
        }
        return to_route('sign-in');
    }
    public function signOut()
    {
        auth()->logout();
        return to_route('sign-in');
    }
}
