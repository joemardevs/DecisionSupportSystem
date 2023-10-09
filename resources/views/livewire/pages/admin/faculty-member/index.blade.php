@section('title')
    {{ $title }}
@endsection
<main class="flex min-h-screen" x-data="{ openModal: false }">

    @if (Session::has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10 z-10"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 1500)">
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
        <section>
            <div class="w-full p-4">
                <div class="flex justify-between items-center p-4 bg-white mb-4 drop-shadow rounded">
                    <h1>
                        {{ $title }}
                    </h1>
                    <a href="{{ route('create.faculty-members') }}">
                        <button type="button"class="text-sm text-white bg-[#116736] p-4 py-2 rounded">
                            Create faculty member
                        </button>
                    </a>
                </div>
                <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-2 focus:border-[#116736] block w-full pl-10 p-2 "
                                    placeholder="Search" required="">
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="flex space-x-3 items-center">
                                <label class="w-48 text-sm font-medium text-gray-900">Position Type :</label>
                                <select wire:model.live="position"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="">All</option>
                                    <option value="Professor I">Professor I</option>
                                    <option value="Professor II">Professor II</option>
                                    <option value="Professor III">Professor III</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">Position</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($facultyMembers as $facultyMember)
                                    <tr wire:key="{{ $facultyMember->id }}" class="border-b">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $facultyMember->name }}
                                        </th>
                                        <td class="px-4 py-3">{{ $facultyMember->position }}</td>
                                        <td class="px-4 py-3">
                                            {{ $facultyMember->status }}
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-start">
                                            <a href="{{ route('view.author', ['id' => $facultyMember->id]) }}"
                                                class="px-1 py-1 text-gray-500 hover:underline underline-offset-2 rounded">
                                                View Rate
                                            </a>
                                            <a href="{{ route('edit.faculty-members', ['id' => $facultyMember->id]) }}"
                                                class="px-3 py-1 text-blue-400 hover:underline underline-offset-2 rounded">
                                                Edit
                                            </a>
                                            <button type="button"
                                                wire:click="showDeleteConfirmationModal({{ $facultyMember->id }})"
                                                class="px-3 py-1 text-red-500 hover:underline underline-offset-2 rounded">
                                                Delele
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-center text-gray-600">
                                            No found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="py-4 px-3">
                        <div class="flex">
                            <div class="flex space-x-4 items-center mb-3">
                                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                <select wire:model.live="perPage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#116736] block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            {{ $facultyMembers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full backdrop-blur-sm"
        x-show="openModal" x-on:open-modal.window="openModal = true" x-on:close-modal.window="openModal = false"
        x-cloak x-transition>
        <!-- A basic modal dialog with title, body and one button to close -->
        <form wire:submit="deleteFacultyMember({{ $selectedAuthor->id ?? null }})"
            class="h-auto mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
            @click.away="openModal = false">
            <div class="text-center">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Delele Confirmation
                </h3>
                <div class="mt-2">
                    Are you sure you want to delete {{ $selectedAuthor->name ?? '' }}?
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <span class="flex gap-4 w-full rounded-md shadow-sm">
                    <button type="button" x-data x-on:click="$dispatch('close-modal')"
                        class="inline-flex justify-center w-full px-4 py-2 text-white bg-gray-500 rounded">
                        No
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center w-full px-4 py-2 text-white bg-[#116736] rounded">
                        Yes
                    </button>
                </span>
            </div>
        </form>
    </div>
</main>
