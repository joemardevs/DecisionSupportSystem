@section('title')
    {{ $title }}
@endsection
<main class="flex min-h-screen" x-data="{ openModal: false }">
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
        <section class="flex flex-col gap-4 p-4">
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="w-96 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center">Research Completed</h1>
                        <canvas id="researchCompleted" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="p-4 w-8/12 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center">All Research Per Year</h1>
                    <canvas id="researchCompletedPerYear" style="width:5px"></canvas>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg drop-shadow bg-white">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Note</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authorsBelow60Percent as $author)
                            <tr wire:key="{{ $author->id }}" class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $author->name }}
                                </th>
                                <td class="px-4 py-3">{{ $author->note ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    {{ $author->status }}
                                </td>
                                <td class="px-4 py-3 flex items-center justify-start">
                                    <button wire:na wire:click="showAddNoteModal({{ $author }})" type="button"
                                        class="px-3 py-1 text-[#116736] hover:underline underline-offset-2 rounded">
                                        Add Note
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
                <div class="py-4 px-3">
                    <div class="flex justify-between">
                        <h1>Author with below success rate</h1>
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="perPage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#116736] block w-full p-2.5 ">
                                <option value="2">2</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        {{ $authorsBelow60Percent->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full backdrop-blur-sm"
        x-show="openModal" x-on:open-modal.window="openModal = true" x-on:close-modal.window="openModal = false" x-cloak
        x-transition>
        <!-- A basic modal dialog with title, body and one button to close -->
        <form wire:submit="addNote({{ $selectedAuthor }})"
            class="h-auto mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
            @click.away="openModal = false">
            <div class="text-center">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ $selectedAuthor->name ?? '' }}
                </h3>
                <div class="mt-2">
                    <p class="text-sm leading-5 text-gray-500">
                        <textarea placeholder="Add note here..." wire:model="note" name="note" id="note" cols="30" rows="10"
                            class="border border-[#116736] w-full p-2"></textarea>
                    </p>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <span class="flex gap-4 w-full rounded-md shadow-sm">
                    <button x-data x-on:click="$dispatch('close-modal')"
                        class="inline-flex justify-center w-full px-4 py-2 text-white bg-gray-500 rounded">
                        Close
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center w-full px-4 py-2 text-white bg-[#116736] rounded">
                        Add
                    </button>
                </span>
            </div>
        </form>
    </div>
</main>
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const CBM = @json($CBM);
        const CCJE = @json($CCJE);
        const CCSICT = @json($CCSICT);
        const CED = @json($CED);
        const IAT = @json($IAT);
        const PS = @json($PS);
        const SAS = @json($SAS);

        const twenty20 = @json($twenty20);
        const twenty21 = @json($twenty21);
        const twenty22 = @json($twenty22);
        const twenty23 = @json($twenty23);
        const twenty24 = @json($twenty24);


        const data = {
            labels: [
                'CBM',
                'CCJE',
                'CCSICT',
                'CED',
                'IAT',
                'PS',
                'SAS'
            ],
            datasets: [{
                data: [CBM, CCJE, CCSICT, CED, IAT, PS, SAS],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                    'rgba(201, 203, 207)'
                ],
                hoverOffset: 4
            }]
        };
        const researchPerYearData = {
            labels: [
                '2020',
                '2021',
                '2022',
                '2023',
                '2024',
            ],
            datasets: [{
                label: 'Research Completed Per Year',
                data: [twenty20, twenty21, twenty22, twenty23, twenty24],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(
            document.getElementById('researchCompleted'), {
                type: 'doughnut',
                data: data,
            }
        );
        new Chart(
            document.getElementById('researchCompletedPerYear'), {
                type: 'bar',
                data: researchPerYearData,
                options: {

                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
    </script>
@endsection
