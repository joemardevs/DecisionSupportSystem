<div>
    <aside class="w-64 h-screen p-4 flex flex-col text-sm font-semibold sticky top-0"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-x-[-1%]" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-[-1%]">
        <div class="w-full h-20 flex items-center justify-start">
            <img src="{{ asset('logo/ISU.png') }}" alt="ISU LOGO" class="w-16">
        </div>
        <div class="flex flex-col mt-2" x-data="{ expanded: false }">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 my-2 cursor-pointer {{ request()->is('dashboard') ? 'text-[#116736]' : 'text-[#B1B6C0] hover:text-[#116736]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <p
                    class="{{ request()->is('dashboard') ? 'text-[#116736]' : 'text-[#3a4657] hover:text-[#116736]' }} w-full">
                    Dashboard</p>
            </a>
            <a href="" class="flex items-center gap-2 my-2 cursor-pointer text-[#B1B6C0] hover:text-[#116736]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <p class="text-[#3a4657] hover:text-[#116736] w-full">Research</p>
            </a>
            <a href="{{ route('faculty-members') }}"
                class="flex items-center gap-2 my-2 cursor-pointer {{ request()->is('faculty-members') ? 'text-[#116736]' : 'text-[#B1B6C0] hover:text-[#116736]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <p
                    class="{{ request()->is('faculty-members') ? 'text-[#116736]' : 'text-[#3a4657] hover:text-[#116736]' }} w-full">
                    Faculty Members</p>
            </a>
            <div class="flex flex-col w-full">
                <button type="button" class="py-2 text-left flex justify-between items-center p-2 rounded">
                    <div class="flex items-center gap-2">
                        <small class="mr-10 font-semibold text-[#B1B6C0]">Colleges</small>
                    </div>
                </button>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">CBM</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">CCJE</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">CCSICT</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">CED</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">IAT</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">PS</a>
                <a href="" class="py-2 px-2 ml-6 text-[#3a4657] hover:text-[#116736]">SAS</a>
            </div>
        </div>
        <div class="flex items-center justify-between w-44 absolute bottom-4 gap-2 my-2">
            {{-- Settings --}}
            <a href="" class="flex items-center gap-2 cursor-pointer text-[#B1B6C0] hover:text-[#116736]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="text-[#3a4657] hover:text-[#116736]">Settings</p>
            </a>
            {{-- Logout --}}
            <a href="{{ route('sign-out') }}" class="cursor-pointer text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
            </a>
        </div>
    </aside>
</div>
