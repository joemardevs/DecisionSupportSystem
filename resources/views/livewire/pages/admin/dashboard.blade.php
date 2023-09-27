@extends('livewire.layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <main class="flex min-h-screen" x-data="{ open: window.innerWidth >= 768 }">
        <nav class="absolute bg-white p-4 w-full flex justify-end shadow-md">
            {{-- If the sidebar is not open then the button below will not show --}}
            <button type="button" @click="open = ! open" x-show="!open">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            {{-- If the sidebar is open then the button below will show --}}
            <button type="button" @click="open = ! open" x-show="open">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>
        <aside class="bg-emerald-700 w-64 h-screen p-4 flex flex-col text-sm text-gray-100 sticky top-0" x-show="open"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-[-1%]" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-[-1%]">
            <div class="w-full h-20 bg-emerald-600 rounded-lg">
                {{-- Logo --}}
            </div>
            <div class="flex flex-col mt-2" x-data="{ expanded: false }">
                <a href="" class="py-2 flex items-center gap-2 p-2 hover:bg-emerald-600 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>
                <button type="button"
                    class="py-2 text-left flex justify-between items-center p-2 hover:bg-emerald-600 rounded"
                    @click="expanded = ! expanded">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                        <p class="mr-10">Department</p>
                    </div>
                    <svg x-show="!expanded" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </button>
                <div x-show="expanded" class="flex flex-col" x-collapse>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">CBM</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">PS</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">IAT</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">CED</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">COL</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">CCJE</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">CAS</a>
                    <a href="" class="py-2 ml-8 px-2 hover:bg-emerald-600 rounded">CCSICT</a>
                </div>
                <a href="" class="py-2 flex items-center gap-2 p-2 hover:bg-emerald-600 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Account
                </a>
            </div>
            <a href="" class="absolute bottom-4 w-44 flex item-center gap-2 p-2 hover:bg-emerald-600 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Logout
            </a>
        </aside>
        <div class="w-full bg-gray-200">
            <header class="pt-20">
                <p class="text-gray-500 text-xs ml-4">Breadcrumb / Dashboard / Department / CCSICT</p>
            </header>
            <section class="p-4">
                <h1 class="pb-4 text-xl">
                    Pages Name
                </h1>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full h-fit md:w-96 p-4 bg-white rounded-lg drop-shadow-md">
                        <div class="w-80 mx-auto">
                            <canvas id="myChart" style="height:10px; width:10px"></canvas>
                        </div>
                    </div>
                    <div class="w-full h-[35rem] bg-white rounded-lg drop-shadow-md">
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                data: [100, 50, 70],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        new Chart(
            document.getElementById('myChart'), {
                type: 'doughnut',
                data: data,
            }
        );
    </script>
@endsection
