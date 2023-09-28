@extends('livewire.layouts.guest')
@section('title')
    Sign In
@endsection
@section('content')
    <main class="bg-white h-screen w-screen grid place-items-center">
        <form class="h-[25rem] p-6 text-gray-800 flex flex-col justify-center gap-10">
            <div>
                <img src="{{ asset('logo/ISU.png') }}" alt="ISU LOGO" class="w-24 mx-auto">
                <h1 class="text-xl font-bold text-center">Sign in to your account</h1>
            </div>
            <div class="w-96 flex flex-col gap-8">
                <div class="flex flex-col gap-2 text-sm">
                    <label for="email">Username</label>
                    <input type="email" name="email" id="email"
                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md" required>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between text-sm">
                        <label for="password">Password</label>
                        <a href="" class="text-sm text-[#116736] font-semibold">Forget password?</a>
                    </div>
                    <input type="password" name="password" id="password"
                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md" required>
                </div>
                <input type="submit" value="Sign in" class="cursor-pointer text-white bg-[#116736] px-6 py-2 rounded-md">
            </div>
        </form>
    </main>
@endsection
