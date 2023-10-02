@section('title')
    {{ $titlePage }}
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
    <div class="w-full bg-gray-200">
        <section class="p-4">
            <div class="w-full p-4">
                <div class="flex justify-between items-center p-4 bg-white mb-4 drop-shadow rounded">
                    <h1>
                        Edit {{ $titlePage }}
                    </h1>
                </div>
                <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden">
                    <div class="w-full p-4 bg-white rounded-lg drop-shadow-md flex flex-col">
                        <h1 class="text-xl font-semibold">Update {{ $titlePage }}</h1>
                        <small class="text-gray-500">Manage the research information below.</small>
                        <form wire:submit="updateFacultyMember" class="flex gap-4 mt-6 w-full">
                            @csrf
                            <div class="flex flex-col gap-4 ">
                                <div class="flex flex-col gap-1">
                                    <label for="name">Name</label>
                                    <input wire:model="name" type="text" name="name" id="name"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="department_id"
                                        class="w-40 text-sm font-medium text-gray-900">Department</label>
                                    <select wire:model="department_id" id="department_id"
                                        class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        @foreach ($departments as $department)
                                            <option wire:key="{{ $department->id }}" value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="position">Position</label>
                                    <input wire:model="position" type="text" name="position" id="position"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="status">Status</label>
                                    <input wire:model="status" type="text" name="status" id="status"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="sex">Sex</label>
                                    <div class="flex gap-20" id="sex">
                                        <div class="flex gap-2">
                                            <input wire:model="sex" type="radio" id="male" name="male"
                                                value="male" class="accent-[#116736] w-5">
                                            <label for="male">Male</label>
                                        </div>
                                        <div class="flex gap-2">
                                            <input wire:model="sex" type="radio" id="female" name="female"
                                                value="female" class="accent-[#116736] w-5">
                                            <label for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="cursor-pointer text-white bg-[#116736] py-2 rounded-md w-24">
                                    Save
                                </button>
                            </div>
                            <div class="flex flex-col gap-4">
                                <div class="flex flex-col gap-1">
                                    <label for="date_of_birth">Date of birth</label>
                                    <input wire:model="date_of_birth" type="date" name="date_of_birth"
                                        id="date_of_birth"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="date_of_original_appointment">Date of original appointment</label>
                                    <input wire:model="date_of_original_appointment" type="date"
                                        name="date_of_original_appointment" id="date_of_original_appointment"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="highest_educational_attaintment">Highest educational
                                        attainment</label>
                                    <input wire:model="highest_educational_attaintment" type="text"
                                        name="highest_educational_attaintment" id="highest_educational_attaintment"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="address">Address</label>
                                    <input wire:model="address" type="text" name="address" id="address"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
