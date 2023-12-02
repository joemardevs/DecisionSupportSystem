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
        <section>
            <div class="w-full p-4">
                <div class="flex justify-between items-center p-4 bg-white mb-4 drop-shadow rounded">
                    <h1>
                        Edit {{ $titlePage }}
                    </h1>
                    <div class="flex gap-2">
                        <a href="{{ route('view.research', ['id' => $research->id]) }}"
                            class="text-sm text-white bg-gray-500 p-4 py-2 rounded w-16">
                            View
                        </a>
                        <button wire:click="deleteResearch({{ $research->id }})" type="button"
                            class="text-sm text-white bg-red-500 p-4 py-2 rounded">
                            Delete research
                        </button>
                    </div>
                </div>
                <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden">
                    <div class="w-full p-4 bg-white rounded-lg drop-shadow-md flex flex-col gap-4">
                        <div>
                            <h1 class="text-xl font-semibold">Edit {{ $titlePage }}</h1>
                            <small class="text-gray-500">Manage the research information below.</small>
                        </div>
                        <form wire:submit="updateResearch" class="flex flex-col gap-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="flex flex-col gap-1">
                                        <label for="title">Title of Research</label>
                                        <input wire:model="title" type="text" name="title" id="title"
                                            placeholder="Put a title here"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="allocated_budget">Allocated Budget</label>
                                        <input wire:model="allocated_budget" type="text" name="allocated_budget"
                                            id="allocated_budget"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="lead_author">Lead Researcher</label>
                                        <select wire:model="lead_author" name="lead_author"
                                            class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                            @foreach ($selectAuthors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="selectedAuthors">Authors</label>
                                        <div class="relative flex w-full">
                                            <select wire:model="selectedAuthors" id="selectedAuthors"
                                                name="selectedAuthors" multiple placeholder="Select author"
                                                autocomplete="off"
                                                class="select-author block w-full rounded-md cursor-pointer focus:outline-none"
                                                multiple>
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}" selected>{{ $author->name }}
                                                    </option>
                                                @endforeach
                                                @foreach ($selectAuthors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <label for="created_at">Date Started</label>
                                            <input wire:model="created_at" type="date" name="created_at"
                                                id="created_at"
                                                class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-col gap-1">
                                        <label for="department_id"
                                            class="w-40 text-sm font-medium text-gray-900">Department</label>
                                        <select wire:model="department_id" id="department_id"
                                            class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                            <option value="">Select department</option>
                                            @foreach ($departments as $department)
                                                <option wire:key="{{ $department->id }}"
                                                    value="{{ $department->id }}">
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="status">Research
                                            Status</label>
                                        <select wire:model="status_id" id="status"
                                            class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                            <option value="">Select status</option>
                                            @foreach ($statuses as $status)
                                                <option wire:key="{{ $status->id }}" value="{{ $status->id }}">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <div class="flex flex-col gap-1">
                                            <label for="expected_date_of_completion">Expected Date of Completion</label>
                                            <input wire:model="expected_date_of_completion" type="date"
                                                name="expected_date_of_completion" id="expected_date_of_completion"
                                                class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex flex-col gap-1">
                                            <label for="duration">Duration</label>
                                            <input wire:model="duration" type="text" name="duration"
                                                id="duration"
                                                class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1" id="date_completed">
                                        <label for="date_completed">Date Completed</label>
                                        <input wire:model="date_completed" type="date" name="date_completed"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4" id="research_presented">
                                <h1 class="font-bold text-gray-400">For Researches presented</h1>
                                {{-- <div class="flex flex-col gap-1 col-span-2">
                                    <label for="level">Level</label>
                                    <input wire:model="" type="text" name="level" id="level"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div> --}}
                                <h1 class="text-gray-400 col-span-2">Coference/Fora</h1>
                                <div class="col-span-2 grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1" id="date_presented">
                                        <label for="date_presented">Date Presented</label>
                                        <input wire:model="date_presented" type="date" name="date_presented"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1" id="organizer">
                                        <label for="organizer">Organizer</label>
                                        <input wire:model="organizer" type="text" name="organizer"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1" id="venue">
                                        <label for="venue">Venue</label>
                                        <input wire:model="venue" type="text" name="venue"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1" id="country">
                                        <label for="country">Country</label>
                                        <input wire:model="country" type="text" name="country"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4" id="research_published">
                                <h1 class="font-bold text-gray-400">For Researches published</h1>
                                <div class="flex flex-col gap-1 col-span-3" id="journal_name">
                                    <label for="journal_name">Journal Name</label>
                                    <input wire:model="journal_name" type="text" name="journal_name"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="col-span-3 grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1 col-span-1" id="issn">
                                        <label for="issn">ISSN</label>
                                        <input wire:model="issn" type="text" name="issn"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                    <div class="flex flex-col gap-1 col-span-1" id="vol">
                                        <label for="vol">Vol</label>
                                        <input wire:model="vol" type="text" name="vol"
                                            class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 col-span-3" id="issn">
                                    <label for="remarks">Remarks</label>
                                    <input wire:model="remarks" type="text" name="remarks"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4" id="research_intellectual_properties">
                                <h1 class="font-bold text-gray-400 col-span-3">Intellectual Properties</h1>
                                <div class="flex flex-col gap-1 col-span-1" id="issn">
                                    <label for="type_of_model">Type of Model</label>
                                    <input wire:model="type_of_model" type="text" name="type_of_model"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="reg_number">
                                    <label for="reg_number">Reg. Number</label>
                                    <input wire:model="reg_number" type="text" name="reg_number"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>

                                <div class="flex flex-col gap-1 col-span-1" id="date_issued">
                                    <label for="date_issued">Date Issued</label>
                                    <input wire:model="date_issued" type="date" name="date_issued"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <h1 class="font-bold text-gray-400 col-span-2">Awards and Recognitions</h1>
                                <div class="flex flex-col gap-1">
                                    <label for="citations">Citations</label>
                                    <input wire:model="citations" type="text" name="citations" id="citations"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="awards">Awards</label>
                                    <input wire:model="awards" type="text" name="awards" id="awards"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="conferred_to">Conferred to</label>
                                    <input wire:model="conferred_to" type="text" name="conferred_to"
                                        id="conferred_to"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="conferred_by">Conferred by</label>
                                    <input wire:model="conferred_by" type="text" name="conferred_by"
                                        id="conferred_by"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                {{-- Get the research ID --}}
                                <input type="hidden" id="researchStatusId" value="{{ $research->status_id }}">
                                <div class="flex gap-4">
                                    <button type="submit"
                                        class="cursor-pointer text-white bg-[#116736] py-2 rounded-md w-24">
                                        Save
                                    </button>
                                    <button type="button" wire:click="goBack"
                                        class="cursor-pointer text-white bg-gray-500 py-2 rounded-md w-24">
                                        Back
                                    </button>
                                </div>
                            </div>
                            {{-- <div class="flex flex-col gap-4 w-1/2">
                                <div class="flex flex-col gap-1">
                                    <label for="title">Title of Research</label>
                                    <input wire:model="title" type="text" name="title" id="title"
                                        placeholder="Put a title here"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="allocated_budget">Allocated Budget</label>
                                    <input wire:model="" type="text" name="allocated_budget" id="allocated_budget"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="lead_researcher">Lead Researcher</label>
                                    <input wire:model="" type="text" name="lead_researcher" id="lead_researcher"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="selectedAuthors">Authors</label>
                                    <div class="relative flex w-full">
                                        <select wire:model="selectedAuthors" id="selectedAuthors" name="selectedAuthors"
                                            multiple placeholder="Select author" autocomplete="off"
                                            class="select-author block w-full rounded-md cursor-pointer focus:outline-none"
                                            multiple>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}" selected>{{ $author->name }}
                                                </option>
                                            @endforeach
                                            @foreach ($selectAuthors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="department_id"
                                        class="w-40 text-sm font-medium text-gray-900">Department</label>
                                    <select wire:model="department_id" id="department_id"
                                        class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        <option value="">Select department</option>
                                        @foreach ($departments as $department)
                                            <option wire:key="{{ $department->id }}" value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="status" class="w-40 text-sm font-medium text-gray-900">Status</label>
                                    <select wire:model="status_id" id="status"
                                        class="bg-white text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                        <option value="">Select status</option>
                                        @foreach ($statuses as $status)
                                            <option wire:key="{{ $status->id }}" value="{{ $status->id }}">
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1" id="venue">
                                    <label for="venue">Venue</label>
                                    <input wire:model="venue" type="text" name="venue"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="date_presented">
                                    <label for="date_presented">Date Presented</label>
                                    <input wire:model="date_presented" type="date" name="date_presented"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="organizer">
                                    <label for="organizer">Organizer</label>
                                    <input wire:model="organizer" type="text" name="organizer"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="citations">Citations</label>
                                    <input wire:model="citations" type="text" name="citations" id="citations"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="created_at">Date Started</label>
                                    <input wire:model="created_at" type="date" name="created_at" id="created_at"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex gap-4">
                                    <button type="submit"
                                        class="cursor-pointer text-white bg-[#116736] py-2 rounded-md w-24">
                                        Save
                                    </button>
                                    <button type="button" wire:click="goBack"
                                        class="cursor-pointer text-white bg-gray-500 py-2 rounded-md w-24">
                                        Back
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 w-1/2">
                                <div class="flex flex-col gap-1" id="journal_name">
                                    <label for="journal_name">Journal Name</label>
                                    <input wire:model="journal_name" type="text" name="journal_name"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="issn">
                                    <label for="issn">ISSN</label>
                                    <input wire:model="issn" type="text" name="issn"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="vol">
                                    <label for="vol">Vol</label>
                                    <input wire:model="vol" type="text" name="vol"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="country">
                                    <label for="country">Country</label>
                                    <input wire:model="country" type="text" name="country"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="date_completed">
                                    <label for="date_completed">Date Completed</label>
                                    <input wire:model="date_completed" type="date" name="date_completed"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="date_issued">
                                    <label for="date_issued">Date Issued</label>
                                    <input wire:model="date_issued" type="date" name="date_issued"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1" id="reg_number">
                                    <label for="reg_number">Reg. Number</label>
                                    <input wire:model="reg_number" type="text" name="reg_number"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="awards">Awards</label>
                                    <input wire:model="awards" type="text" name="awards" id="awards"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                Get the research ID
                                <input type="hidden" id="researchStatusId" value="{{ $research->status_id }}">
                            </div> --}}
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
    {{-- css for multiselect --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
</main>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('.select-author', {});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        // Get the research status_id value
        var researchStatusId = $("#researchStatusId").val();

        // Initially hide all fields
        $("#research_presented, #research_published, #research_intellectual_properties")
            .hide();

        // Listen to the change event of the status_id select
        $("#status").change(function() {
            var selectedStatus = $(this).val();

            // Hide all fields
            $("#research_presented, #research_published, #research_intellectual_properties")
                .hide();

            if (selectedStatus >= 3) {
                $("#research_presented").show();
            }
            if (selectedStatus >= 4) {
                $("#research_published").show();
            }
            if (selectedStatus >= 5) {
                $("#research_intellectual_properties").show();
            }
        });
        if (researchStatusId >= 3) {
            $("#research_presented").show();
        }
        if (researchStatusId >= 4) {
            $("#research_published").show();
        }
        if (researchStatusId >= 5) {
            $("#research_intellectual_properties").show();
        }
    });
</script>
