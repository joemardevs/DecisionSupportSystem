@section('title')
    {{ $titlePage }}
@endsection
<main class="flex min-h-screen">
    {{-- @if ($researchSuccessRate < 60)
        <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded absolute w-96 mb-8 top-10 right-10 z-10"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <span class="block sm:inline">
                Research is below success rate.
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg class="fill-current h-6 w-6 text-gray-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif --}}
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
                        View {{ $titlePage }}
                    </h1>
                    <div class="flex gap-2">
                        <a wire:navigate href="{{ route('edit.research', ['id' => $research->id]) }}"
                            class="text-sm text-white bg-blue-500 p-4 py-2 rounded w-16 text-center">
                            Edit
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
                            <h1 class="text-xl font-semibold">{{ $research->title }}</h1>
                            <small class="text-gray-500">View the research information below.</small>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col gap-4 w-1/2">
                                <div class="flex flex-col gap-1">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" value="{{ $title }}"
                                        readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="selectedAuthors">Author</label>
                                    <input type="text" name="department_id" id="department_id" readonly
                                        value="@foreach ($research->authors as $author){{ $loop->first ? '' : ', ' }}{{ $author->name }} @endforeach"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">

                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="department_id"
                                        class="w-40 text-sm font-medium text-gray-900">Department</label>
                                    <input type="text" name="department_id" id="department_id"
                                        value="{{ $research->department->name }}" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="status" class="w-40 text-sm font-medium text-gray-900">Status</label>
                                    <input type="text" name="status_id" id="status_id"
                                        value="{{ $research->status->name }}" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="venue">Venue</label>
                                    <input value="{{ $venue ?? 'N/A' }}" type="text" name="venue" id="venue"
                                        readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="date_presented">Date Presented</label>
                                    <input value="{{ $date_presented }}" type="date" name="date_presented"
                                        id="date_presented" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="organizer">Organizer</label>
                                    <input value="{{ $organizer ?? 'N/A' }}" type="text" name="organizer"
                                        id="organizer" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="citations">Citations</label>
                                    <input value="{{ $citations ?? 'N/A' }}" type="text" name="citations"
                                        id="citations" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="created_at">Date Started</label>
                                    <input value="{{ $created_at }}" type="date" name="created_at"
                                        id="created_at"
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 w-1/2">
                                <div class="flex flex-col gap-1">
                                    <label for="journal_name">Journal Name</label>
                                    <input value="{{ $journal_name ?? 'N/A' }}" type="text" name="journal_name"
                                        id="journal_name" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="issn">ISSN</label>
                                    <input value="{{ $issn ?? 'N/A' }}" type="text" name="issn"
                                        id="issn" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="vol">Vol</label>
                                    <input value="{{ $vol ?? 'N/A' }}" type="text" name="vol" id="vol"
                                        readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="country">Country</label>
                                    <input value="{{ $country ?? 'N/A' }}" type="text" name="country"
                                        id="country" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="date_completed">Date Completed</label>
                                    <input wire:model="date_completed" type="date" name="date_completed"
                                        id="date_completed" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="date_issued">Date Issued</label>
                                    <input value="{{ $date_issued ?? 'N/A' }}" type="date" name="date_issued"
                                        id="date_issued" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="reg_number">Reg. Number</label>
                                    <input value="{{ $reg_number ?? 'N/A' }}" type="text" name="reg_number"
                                        id="reg_number" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="awards">Awards</label>
                                    <input value="{{ $awards ?? 'N/A' }}" type="text" name="awards"
                                        id="awards" readonly
                                        class="text-md border focus:outline-none focus:border-[#116736] px-4 py-1 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
</main>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('.select-author', {});
</script>
<script script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let researchSuccessRate = @json($researchSuccessRate);
    let researchFailRate = @json($researchFailRate);
    const data = {
        labels: [
            'Success',
            'Fail'
        ],
        datasets: [{
            data: [researchSuccessRate, researchFailRate, ],
            backgroundColor: [
                'green',
                'gray',
            ],
            hoverOffset: 4
        }]
    };
    new Chart(
        document.getElementById('researchSuccessRate'), {
            type: 'pie',
            data: data,
        }
    );
</script>
