@extends('livewire.layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    {{-- <main class="grid grid-rows-6 grid-cols-12 grid-flow-col gap-4 h-screen">
        <aside class="row-span-6 col-span-2 bg-gray-200">
            <h1>Sidebar</h1>
        </aside>
        <nav class="row-span-1 col-span-10 bg-gray-400">02</nav>
        <section class="row-span-5 col-span-10 bg-gray-600">03</section>
    </main> --}}
    <main class="h-screen w-screen flex">
        <aside class="bg-gray-500 w-64 p-4 flex flex-col">
            <div class="w-full h-20 bg-gray-700 rounded-lg">
                {{-- Logo --}}
            </div>
            <div class="flex flex-col" x-data="{ open: false }">
                <a href="" class="py-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    Dashboard
                </a>
                <button type="button" class="py-2 text-left flex justify-between items-center" @click="open = ! open">
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        Department
                    </p>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>


                </button>
                <div x-show="open" class="flex flex-col" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-[-1%]" x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-[-1%]">
                    <a href="" class="py-2">CBM</a>
                    <a href="" class="py-2">PS</a>
                    <a href="" class="py-2">IAT</a>
                    <a href="" class="py-2">CED</a>
                    <a href="" class="py-2">COL</a>
                    <a href="" class="py-2">CCJE</a>
                    <a href="" class="py-2">CAS</a>
                    <a href="" class="py-2">CCSICT</a>
                </div>
                <a href="" class="py-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Account
                </a>
            </div>
            <a href="" class="fixed bottom-10 flex item-center gap-2 w-44">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Logout
            </a>
        </aside>
        <div class="w-full bg-gray-200">
            <nav class="p-4">
                <p class="text-gray-500 text-sm">Breadcrumb / Dashboard / Department / CCSICT</p>
            </nav>
            <section class="p-4">
                <h1 class="pb-4 text-xl">
                    Pages Name
                </h1>
                <div class="flex gap-4">
                    <div class="w-64 h-96 bg-white rounded-lg">
                    </div>
                    <div class="w-full h-96 bg-white rounded-lg">
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
