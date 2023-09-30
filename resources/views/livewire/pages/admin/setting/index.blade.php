@section('title')
    {{ $title }}
@endsection
<main class="flex min-h-screen">
    @if (Session::has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10 z-10"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
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
    @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10 z-10"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <span class="block sm:inline">
                {{ Session::get('success') }}
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <livewire:components.sidebar />
    <div class="w-full bg-gray-200 p-4">
        <div class="flex justify-between items-center p-4 bg-white mb-4 drop-shadow rounded">
            <h1>
                {{ $title }}
            </h1>
        </div>
        <section>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="h-fit w-64 p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="w-full h-80 flex flex-col gap-2">
                        <a href="{{ route('settings') }}"
                            class="{{ request()->is('settings') ? 'text-[#116736] underline underline-offset-2' : 'text-[#3a4657] hover:text-[#116736]' }}">
                            Update Information
                        </a>
                        <a href="{{ route('password') }}"
                            class="{{ request()->route()->uri == 'settings/update-password' ? 'text-[#116736] underline underline-offset-2' : 'text-[#3a4657] hover:text-[#116736]' }}">
                            Update Password
                        </a>
                    </div>
                </div>
                <div class="w-full h-[35rem] p-4 bg-white rounded-lg drop-shadow-md flex flex-col">
                    <h1 class="text-xl font-semibold">Manage your account information</h1>
                    <small class="text-gray-500">
                        Update personal details and more to keep your profile current and accurate.
                    </small>
                    <form wire:submit="updateAccount" class="flex flex-col gap-4 mt-6 w-5/12">
                        <div class="flex flex-col gap-1">
                            <label for="username">Username</label>
                            <input wire:model="username" type="text" name="username" id="username"
                                placeholder="{{ $user->username }}"
                                class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md"
                                required>
                        </div>
                        <div class="flex flex-col gap-1 text-sm">
                            <label for="name">Name</label>
                            <input wire:model="name" type="text" name="name" id="name"
                                placeholder="{{ $user->name }}"
                                class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                        </div>
                        <button type="submit" class="cursor-pointer text-white bg-[#116736] py-2 rounded-md w-24">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
