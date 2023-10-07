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
                        View {{ $titlePage }}
                    </h1>
                    <button wire:click="deleteFacultyMember({{ $facultyMember->id }})" type="button"
                        class="text-sm text-white bg-red-500 p-4 py-2 rounded">
                        Delete research
                    </button>
                </div>
                <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden">
                    <div class="w-full p-4 bg-white rounded-lg drop-shadow-md flex flex-col gap-4">
                        <h1 class="text-xl font-semibold">{{ $facultyMember->name }} research data</h1>
                        <small class="text-gray-500">View the faculty research data below.</small>
                        <div class="w-96 h-fit p-4">
                            <div class="mx-auto">
                                <canvas id="authorSuccessRate" style="height:5px; width:5px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let memberAllResearch = @json($memberAllResearch);
    let memberCountNotCompletedResearch = @json($memberCountNotCompletedResearch);
    const data = {
        labels: [
            'Above Completed',
            'On Going'
        ],
        datasets: [{
            data: [memberAllResearch, memberCountNotCompletedResearch, ],
            backgroundColor: [
                'green',
                'gray',
            ],
            hoverOffset: 4
        }]
    };
    new Chart(
        document.getElementById('authorSuccessRate'), {
            type: 'pie',
            data: data,
        }
    );
</script>
