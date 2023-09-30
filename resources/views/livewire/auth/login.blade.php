@section('title')
    Sign In
@endsection
<main class="bg-white h-screen w-screen flex flex-col items-center justify-center">
    @if (Session::has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            {{-- <strong class="font-bold">Error</strong> --}}
            <span class="block sm:inline">
                {{ Session::get('error') }}
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <form wire:submit.prevent="signin" class="h-[25rem] p-6 text-gray-800 flex flex-col justify-center gap-10">
        @csrf
        <div>
            <img src="{{ asset('logo/ISU.png') }}" alt="ISU LOGO" class="w-24 mx-auto">
            <h1 class="text-xl font-bold text-center">Sign in to your account</h1>
        </div>
        <div class="w-96 flex flex-col gap-8">
            <div class="flex flex-col gap-2 text-sm">
                <label for="text">Username</label>
                <input wire:model="username" type="text" name="username" id="username"
                    class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex justify-between text-sm">
                    <label for="password">Password</label>
                    {{-- <a href="" class="text-sm text-[#116736] font-semibold">Forget password?</a> --}}
                </div>
                <input wire:model="password" type="password" name="password" id="password"
                    class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
            </div>
            <button type="submit" class="cursor-pointer text-white bg-[#116736] px-6 py-2 rounded-md">
                Sign in
            </button>
        </div>
    </form>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10"
            role="alert" x-data="{ show: true }" x-show='show' x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2">
            <h1 class="text-left text-md font-bold">Error</h1>
            <hr class="border-red-400">
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-800">{{ $error }}</li>
                @endforeach
            </ul>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
</main>
