@extends('livewire.layouts.guest')
@section('title')
    Login
@endsection
@section('content')
    <main class="bg-gray-200 h-screen w-screen grid place-items-center">
        <div class="grid md:grid-cols-2 drop-shadow-lg z-10">
            <form class="bg-white h-[25rem] w-96 p-6 text-gray-800 flex flex-col justify-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold">Login</h1>
                    <small>Please log in your account.</small>
                </div>
                <div class="flex flex-col">
                    <label for="email">Email<span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" placeholder="example@gmail.com"
                        class="text-md border-2 border-x-0 border-t-0 focus:outline-none focus:border-emerald-500 px-4 py-1"
                        required>
                </div>
                <div class="flex flex-col">
                    <label for="password">Password<span class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="text-md border-2 border-x-0 border-t-0 focus:outline-none focus:border-emerald-500 px-4 py-1"
                        required>
                </div>
                <input type="submit" value="Login"
                    class="cursor-pointer bg-emerald-400 hover:bg-emerald-500 px-6 py-2 rounded">
            </form>
            <section class="bg-white hidden md:block">
                <div class="bg-emerald-500 h-[25rem] w-96 p-6 rounded-l-[40px]">
                </div>
            </section>
        </div>
        <svg class="z-0 fixed bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#10b981" fill-opacity="1"
                d="M0,160L21.8,144C43.6,128,87,96,131,122.7C174.5,149,218,235,262,240C305.5,245,349,171,393,144C436.4,117,480,139,524,160C567.3,181,611,203,655,202.7C698.2,203,742,181,785,197.3C829.1,213,873,267,916,256C960,245,1004,171,1047,154.7C1090.9,139,1135,181,1178,213.3C1221.8,245,1265,267,1309,261.3C1352.7,256,1396,224,1418,208L1440,192L1440,320L1418.2,320C1396.4,320,1353,320,1309,320C1265.5,320,1222,320,1178,320C1134.5,320,1091,320,1047,320C1003.6,320,960,320,916,320C872.7,320,829,320,785,320C741.8,320,698,320,655,320C610.9,320,567,320,524,320C480,320,436,320,393,320C349.1,320,305,320,262,320C218.2,320,175,320,131,320C87.3,320,44,320,22,320L0,320Z">
            </path>
        </svg>
    </main>
@endsection
