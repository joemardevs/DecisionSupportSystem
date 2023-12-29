@section('title')
    {{ $title }}
@endsection
<main class="flex min-h-screen w-full" x-data="{ openModal: false }">
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
        <div class="p-4 pb-0 w-full grid-rows-1">
            <div class="flex justify-end space-x-3 items-center">
                <div class="flex gap-4">
                    <select name="colleges"wire:model="colleges"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#116736] focus:border-[#116736] block w-40 p-2">
                        <option value="">All Colleges</option>
                        @foreach ($allColleges as $college)
                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="number" wire:model="year" placeholder="Year"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-[#116736] block p-2 w-40">
                <button type="button" wire:click="filter" class="bg-[#116736] px-4 py-2 text-white rounded-lg">
                    Filter
                </button>
                <div wire:loading aria-label="Loading..." role="status">
                    <svg class="animate-spin w-6 h-6 fill-slate-800" viewBox="3 3 18 18">
                        <path class="opacity-20"
                            d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
                        </path>
                        <path
                            d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="p-4 grid grid-cols-12 gap-2 border">
            <div class="w-full col-span-3 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg px-6">Total Research</p>
                <p class="text-3xl p-4">{{ number_format($allResearches) }}</p>
            </div>
            <div class="w-full col-span-3 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg px-6">On Going Research</p>
                <p class="text-3xl p-4">{{ number_format($allOnGoing) }}</p>
            </div>
            <div class="w-full col-span-3 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg  px-2">Completed Research</p>
                <p class="text-3xl p-4">{{ number_format($allCompleted) }}</p>
            </div>
            <div class="w-full col-span-3 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg  px-6">Presented Research</p>
                <p class="text-3xl p-4">{{ number_format($allPresented) }}</p>
            </div>
            <div class="w-full col-span-4 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg  px-6">Published Research</p>
                <p class="text-3xl p-4">{{ number_format($allPublished) }}</p>
            </div>
            <div class="w-full col-span-4 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg  px-6">Intellectual Properties</p>
                <p class="text-3xl p-4">{{ number_format($allIntellectualProperties) }}</p>
            </div>
            <div class="w-full col-span-4 bg-white rounded-lg drop-shadow-md text-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg px-6">Archived Research</p>
                <p class="text-3xl p-4">{{ number_format($allArchived) }}</p>
            </div>
        </div>
        <div class="p-4 pt-0 grid grid-cols-12 gap-2">
            <div class="w-full col-span-6 bg-white rounded-lg drop-shadow-md flex flex-col justify-center items-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg w-full text-center">All Research</p>
                <div wire:ignore class="w-72">
                    <canvas id="allResearch" style="height:1px; width:1px" class="p-4"></canvas>
                </div>
            </div>
            <div class="w-full col-span-6 bg-white rounded-lg drop-shadow-md flex flex-col justify-center items-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg w-full text-center">Male and Female Comparison</p>
                <div wire:ignore class="w-72 flex justify-center">
                    <canvas id="male_and_female" style="height:1px; width:1px" class="p-4"></canvas>
                </div>
            </div>
        </div>
        <div class="p-4 pt-0 grid grid-cols-12 gap-2">
            <div
                class="w-full col-span-12 bg-white rounded-lg drop-shadow-md flex flex-col justify-center items-center">
                <p class="bg-[#116736] text-white py-2 rounded-t-lg w-full text-center">All Research Per School Year</p>
                <div wire:ignore class="flex justify-center">
                    <canvas id="allResearchPerSchoolYear" style="height:30vh; padding:1rem;"></canvas>
                </div>
            </div>
        </div>
        <div class="p-4 pt-0 grid grid-cols-12 gap-2">
            <div class="bg-white relative drop-shadow sm:rounded-lg overflow-hidden w-full col-span-12">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <h1>Faculty Members with lowest success rate</h1>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-48 text-sm font-medium text-gray-900">Position Type :</label>
                            <select wire:model.live="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                @foreach ($uniquePositions as $positions)
                                    <option value="{{ $positions }}">{{ $positions }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg bg-white">
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
                            @forelse ($authorsBelow60PercentPaginated as $author)
                                <tr wire:key="{{ $author->id }}" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $author->name }}
                                    </th>
                                    <td class="px-4 py-3">{{ $author->position }}</td>
                                    <td class="px-4 py-3">
                                        {{ $author->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('view.author', ['id' => $author->id]) }}"
                                            class="px-1 py-1 text-gray-500 hover:underline underline-offset-2 rounded">
                                            View
                                        </a>
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
                        {{ $authorsBelow60PercentPaginated->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="w-full bg-gray-200">
        <section class="flex flex-col p-4 gap-4">
            <div class="grid grid-rows-2 grid-cols-4 gap-2">
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">All Research</h1>
                        <canvas id="allResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">CBM Research</h1>
                        <canvas id="cbmResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">CCJE Research</h1>
                        <canvas id="ccjeResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">CCSICT Research</h1>
                        <canvas id="ccsictResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">CED Research</h1>
                        <canvas id="cedResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">IAT Research</h1>
                        <canvas id="iatResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">PS Research</h1>
                        <canvas id="psResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
                <div class="w-44 h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <div class="mx-auto">
                        <h1 class="text-center text-sm">SAS Research</h1>
                        <canvas id="sasResearch" style="height:5px; width:5px"></canvas>
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-4 grid-cols-2 gap-2">
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">All Research Per School Year</h1>
                    <canvas id="researchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">CBM Research Per School Year</h1>
                    <canvas id="cbmResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">CCJE Research Per School Year</h1>
                    <canvas id="ccjeResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">CCSICT Research Per School Year</h1>
                    <canvas id="ccsictResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">CED Research Per School Year</h1>
                    <canvas id="cedResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">IAT Research Per School Year</h1>
                    <canvas id="iatResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">PS Research Per School Year</h1>
                    <canvas id="psResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
                <div class="p-2 w-96 bg-white rounded-lg drop-shadow-md">
                    <h1 class="text-center text-sm">SAS Research Per School Year</h1>
                    <canvas id="sasResearchPerSchoolYear" style="width:5px"></canvas>
                </div>
            </div>

        </section>
    </div> --}}
    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full backdrop-blur-sm"
        x-show="openModal" x-on:open-modal.window="openModal = true" x-on:close-modal.window="openModal = false"
        x-cloak x-transition>
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
                        <textarea placeholder="Add note here..." wire:model="note" name="note" id="note" cols="30"
                            rows="10" class="border border-[#116736] w-full p-2"></textarea>
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
        let maleAndFemaleComparisionChart = null;
        var ctx = document.getElementById('male_and_female').getContext('2d');
        //male and female comparison
        let male = @json($male);
        let female = @json($female);
        const maleAndFemaleComparision = {
            labels: [
                'Male',
                'Female',
            ],
            datasets: [{
                data: [male, female],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                ],
                hoverOffset: 4
            }]
        };
        maleAndFemaleComparisionChart = new Chart(ctx, {
            type: 'bar',
            data: maleAndFemaleComparision,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        });

        //all piechart
        let researchStatusChart = null;
        var researchStatusHtml = document.getElementById('allResearch').getContext('2d');

        let allOnGoing = @json($allOnGoing);
        let allCompleted = @json($allCompleted);
        let allPresented = @json($allPresented);
        let allPublished = @json($allPublished);
        let allIntellectualProperties = @json($allIntellectualProperties);
        let allArchived = @json($allArchived);

        const allData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [allOnGoing, allCompleted, allPresented, allPublished, allIntellectualProperties,
                    allArchived,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        researchStatusChart = new Chart(researchStatusHtml, {
            type: 'pie',
            data: allData,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        });

        //all research line chart
        let allResearchPerSchoolYearChart = null;
        var allResearchPerSchoolYearHtml = document.getElementById('allResearchPerSchoolYear').getContext('2d');

        let twenty20Totwenty21 = @json($twenty20Totwenty21);
        let twenty21Totwenty22 = @json($twenty21Totwenty22);
        let twenty22Totwenty23 = @json($twenty22Totwenty23);
        let twenty23Totwenty24 = @json($twenty23Totwenty24);
        let twenty24Totwenty25 = @json($twenty24Totwenty25);
        const allResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'All Research Per School Year',
                data: [twenty20Totwenty21, twenty21Totwenty22, twenty22Totwenty23, twenty23Totwenty24,
                    twenty24Totwenty25
                ],
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
        allResearchPerSchoolYearChart = new Chart(allResearchPerSchoolYearHtml, {
            type: 'line',
            data: allResearchPerYearData,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        }, );


        //update charts
        window.onload = function() {
            Livewire.on('filter-colleges', (data) => {
                // console.log('Data:', data);
                // console.log('Gender:', data.gender);
                // console.log('Pie Chart Researches:', data.researchesPieChart);
                // console.log('Line Chart Researches:', data.researchesLineChart);

                researchStatusChart.data.datasets[0].data = [
                    data.researchesPieChart.OnGoing,
                    data.researchesPieChart.Completed,
                    data.researchesPieChart.Presented,
                    data.researchesPieChart.Published,
                    data.researchesPieChart.IntellectualProperties,
                    data.researchesPieChart.Archieved,
                ]
                researchStatusChart.update();

                maleAndFemaleComparisionChart.data.datasets[0].data = data.gender
                maleAndFemaleComparisionChart.update();

                allResearchPerSchoolYearChart.data.datasets[0].data = data.researchesLineChart
                allResearchPerSchoolYearChart.update();
            })
        }
        //cbm piechart
        let cbmOnGoing = @json($cbmOnGoing);
        let cbmCompleted = @json($cbmCompleted);
        let cbmPresented = @json($cbmPresented);
        let cbmPublished = @json($cbmPublished);
        let cbmIntellectualProperties = @json($cbmIntellectualProperties);
        let cbmArchieved = @json($cbmArchieved);

        const cbmData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [cbmOnGoing, cbmCompleted, cbmPresented, cbmPublished, cbmIntellectualProperties,
                    cbmArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('cbmResearch'), {
                type: 'pie',
                data: cbmData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );

        //ccje piechart
        let ccjeOnGoing = @json($ccjeOnGoing);
        let ccjeCompleted = @json($ccjeCompleted);
        let ccjePresented = @json($ccjePresented);
        let ccjePublished = @json($ccjePublished);
        let ccjeIntellectualProperties = @json($ccjeIntellectualProperties);
        let ccjeArchieved = @json($ccjeArchieved);

        const ccjeData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [ccjeOnGoing, ccjeCompleted, ccjePresented, ccjePublished, ccjeIntellectualProperties,
                    ccjeArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('ccjeResearch'), {
                type: 'pie',
                data: ccjeData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );
        //ccsict piechart
        let ccsictOnGoing = @json($ccsictOnGoing);
        let ccsictCompleted = @json($ccsictCompleted);
        let ccsictPresented = @json($ccsictPresented);
        let ccsictPublished = @json($ccsictPublished);
        let ccsictIntellectualProperties = @json($ccsictIntellectualProperties);
        let ccsictArchieved = @json($ccsictArchieved);

        const ccsictData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [ccsictOnGoing, ccsictCompleted, ccsictPresented, ccsictPublished,
                    ccsictIntellectualProperties,
                    ccsictArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('ccsictResearch'), {
                type: 'pie',
                data: ccsictData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );
        //ced piechart
        let cedOnGoing = @json($cedOnGoing);
        let cedCompleted = @json($cedCompleted);
        let cedPresented = @json($cedPresented);
        let cedPublished = @json($cedPublished);
        let cedIntellectualProperties = @json($cedIntellectualProperties);
        let cedArchieved = @json($cedArchieved);

        const cedData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [cedOnGoing, cedCompleted, cedPresented, cedPublished, cedIntellectualProperties,
                    cedArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('cedResearch'), {
                type: 'pie',
                data: cedData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );

        //iat piechart
        let iatOnGoing = @json($iatOnGoing);
        let iatCompleted = @json($iatCompleted);
        let iatPresented = @json($iatPresented);
        let iatPublished = @json($iatPublished);
        let iatIntellectualProperties = @json($iatIntellectualProperties);
        let iatArchieved = @json($iatArchieved);

        const iatData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [iatOnGoing, iatCompleted, iatPresented, iatPublished, iatIntellectualProperties,
                    iatArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('iatResearch'), {
                type: 'pie',
                data: iatData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );
        //ps piechart
        let psOnGoing = @json($psOnGoing);
        let psCompleted = @json($psCompleted);
        let psPresented = @json($psPresented);
        let psPublished = @json($psPublished);
        let psIntellectualProperties = @json($psIntellectualProperties);
        let psArchieved = @json($psArchieved);

        const psData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [psOnGoing, psCompleted, psPresented, psPublished, psIntellectualProperties,
                    psArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('psResearch'), {
                type: 'pie',
                data: psData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );
        //sas piechart
        let sasOnGoing = @json($sasOnGoing);
        let sasCompleted = @json($sasCompleted);
        let sasPresented = @json($sasPresented);
        let sasPublished = @json($sasPublished);
        let sasIntellectualProperties = @json($sasIntellectualProperties);
        let sasArchieved = @json($sasArchieved);

        const sasData = {
            labels: [
                'On going',
                'Completed',
                'Presented',
                'Published',
                'Intellectual Properties',
                'Archieved',
            ],
            datasets: [{
                data: [sasOnGoing, sasCompleted, sasPresented, sasPublished, sasIntellectualProperties,
                    sasArchieved,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                ],
                hoverOffset: 4
            }]
        };
        new Chart(
            document.getElementById('sasResearch'), {
                type: 'pie',
                data: sasData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            }
        );
        //all research line chart
        // let twenty20Totwenty21 = @json($twenty20Totwenty21);
        // let twenty21Totwenty22 = @json($twenty21Totwenty22);
        // let twenty22Totwenty23 = @json($twenty22Totwenty23);
        // let twenty23Totwenty24 = @json($twenty23Totwenty24);
        // let twenty24Totwenty25 = @json($twenty24Totwenty25);
        // const allResearchPerYearData = {
        //     labels: [
        //         '2020-2021',
        //         '2021-2022',
        //         '2022-2023',
        //         '2023-2024',
        //         '2024-2025',
        //     ],
        //     datasets: [{
        //         label: 'All Research Per School Year',
        //         data: [twenty20Totwenty21, twenty21Totwenty22, twenty22Totwenty23, twenty23Totwenty24,
        //             twenty24Totwenty25
        //         ],
        //         backgroundColor: [
        //             'rgba(255, 99, 132, 0.2)',
        //             'rgba(255, 159, 64, 0.2)',
        //             'rgba(255, 205, 86, 0.2)',
        //             'rgba(75, 192, 192, 0.2)',
        //             'rgba(54, 162, 235, 0.2)',
        //             'rgba(153, 102, 255, 0.2)',
        //             'rgba(201, 203, 207, 0.2)'
        //         ],
        //         borderColor: [
        //             'rgb(255, 99, 132)',
        //             'rgb(255, 159, 64)',
        //             'rgb(255, 205, 86)',
        //             'rgb(75, 192, 192)',
        //             'rgb(54, 162, 235)',
        //             'rgb(153, 102, 255)',
        //             'rgb(201, 203, 207)'
        //         ],
        //         borderWidth: 1
        //     }]
        // };
        // new Chart(
        //     document.getElementById('researchPerSchoolYear'), {
        //         type: 'line',
        //         data: allResearchPerYearData,
        //         options: {
        //             plugins: {
        //                 legend: {
        //                     display: false
        //                 },
        //             }
        //         }
        //     },
        // );
        //cbm research line chart
        let cbmTwenty20Totwenty21 = @json($cbmTwenty20Totwenty21);
        let cbmTwenty21Totwenty22 = @json($cbmTwenty21Totwenty22);
        let cbmTwenty22Totwenty23 = @json($cbmTwenty22Totwenty23);
        let cbmTwenty23Totwenty24 = @json($cbmTwenty23Totwenty24);
        let cbmTwenty24Totwenty25 = @json($cbmTwenty24Totwenty25);
        const cbmResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'CBM Research Per School Year',
                data: [cbmTwenty20Totwenty21, cbmTwenty21Totwenty22, cbmTwenty22Totwenty23,
                    cbmTwenty23Totwenty24,
                    cbmTwenty24Totwenty25
                ],
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
            document.getElementById('cbmResearchPerSchoolYear'), {
                type: 'line',
                data: cbmResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //ccje research line chart
        let ccjeTwenty20Totwenty21 = @json($ccjeTwenty20Totwenty21);
        let ccjeTwenty21Totwenty22 = @json($ccjeTwenty21Totwenty22);
        let ccjeTwenty22Totwenty23 = @json($ccjeTwenty22Totwenty23);
        let ccjeTwenty23Totwenty24 = @json($ccjeTwenty23Totwenty24);
        let ccjeTwenty24Totwenty25 = @json($ccjeTwenty24Totwenty25);
        const ccjeResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'CCJE Research Per School Year',
                data: [ccjeTwenty20Totwenty21, ccjeTwenty21Totwenty22, ccjeTwenty22Totwenty23,
                    ccjeTwenty23Totwenty24,
                    ccjeTwenty24Totwenty25
                ],
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
            document.getElementById('ccjeResearchPerSchoolYear'), {
                type: 'line',
                data: ccjeResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //ccsict research line chart
        let ccsictTwenty20Totwenty21 = @json($ccsictTwenty20Totwenty21);
        let ccsictTwenty21Totwenty22 = @json($ccsictTwenty21Totwenty22);
        let ccsictTwenty22Totwenty23 = @json($ccsictTwenty22Totwenty23);
        let ccsictTwenty23Totwenty24 = @json($ccsictTwenty23Totwenty24);
        let ccsictTwenty24Totwenty25 = @json($ccsictTwenty24Totwenty25);
        const ccsictResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'CCSICT Research Per School Year',
                data: [ccsictTwenty20Totwenty21, ccsictTwenty21Totwenty22, ccsictTwenty22Totwenty23,
                    ccsictTwenty23Totwenty24,
                    ccsictTwenty24Totwenty25
                ],
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
            document.getElementById('ccsictResearchPerSchoolYear'), {
                type: 'line',
                data: ccsictResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //ced research line chart
        let cedTwenty20Totwenty21 = @json($cedTwenty20Totwenty21);
        let cedTwenty21Totwenty22 = @json($cedTwenty21Totwenty22);
        let cedTwenty22Totwenty23 = @json($cedTwenty22Totwenty23);
        let cedTwenty23Totwenty24 = @json($cedTwenty23Totwenty24);
        let cedTwenty24Totwenty25 = @json($cedTwenty24Totwenty25);
        const cedResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'CED Research Per School Year',
                data: [cedTwenty20Totwenty21, cedTwenty21Totwenty22, cedTwenty22Totwenty23,
                    cedTwenty23Totwenty24,
                    cedTwenty24Totwenty25
                ],
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
            document.getElementById('cedResearchPerSchoolYear'), {
                type: 'line',
                data: cedResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //iat research line chart
        let iatTwenty20Totwenty21 = @json($iatTwenty20Totwenty21);
        let iatTwenty21Totwenty22 = @json($iatTwenty21Totwenty22);
        let iatTwenty22Totwenty23 = @json($iatTwenty22Totwenty23);
        let iatTwenty23Totwenty24 = @json($iatTwenty23Totwenty24);
        let iatTwenty24Totwenty25 = @json($iatTwenty24Totwenty25);
        const iatResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'IAT Research Per School Year',
                data: [iatTwenty20Totwenty21, iatTwenty21Totwenty22, iatTwenty22Totwenty23,
                    iatTwenty23Totwenty24,
                    iatTwenty24Totwenty25
                ],
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
            document.getElementById('iatResearchPerSchoolYear'), {
                type: 'line',
                data: iatResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //ps research line chart
        let psTwenty20Totwenty21 = @json($psTwenty20Totwenty21);
        let psTwenty21Totwenty22 = @json($psTwenty21Totwenty22);
        let psTwenty22Totwenty23 = @json($psTwenty22Totwenty23);
        let psTwenty23Totwenty24 = @json($psTwenty23Totwenty24);
        let psTwenty24Totwenty25 = @json($psTwenty24Totwenty25);
        const psResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'PS Research Per School Year',
                data: [psTwenty20Totwenty21, psTwenty21Totwenty22, psTwenty22Totwenty23,
                    psTwenty23Totwenty24,
                    psTwenty24Totwenty25
                ],
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
            document.getElementById('psResearchPerSchoolYear'), {
                type: 'line',
                data: psResearchPerYearData,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            },
        );
        //sas research line chart
        let sasTwenty20Totwenty21 = @json($sasTwenty20Totwenty21);
        let sasTwenty21Totwenty22 = @json($sasTwenty21Totwenty22);
        let sasTwenty22Totwenty23 = @json($sasTwenty22Totwenty23);
        let sasTwenty23Totwenty24 = @json($sasTwenty23Totwenty24);
        let sasTwenty24Totwenty25 = @json($sasTwenty24Totwenty25);
        const sasResearchPerYearData = {
            labels: [
                '2020-2021',
                '2021-2022',
                '2022-2023',
                '2023-2024',
                '2024-2025',
            ],
            datasets: [{
                label: 'SAS Research Per School Year',
                data: [sasTwenty20Totwenty21, sasTwenty21Totwenty22, sasTwenty22Totwenty23,
                    sasTwenty23Totwenty24,
                    sasTwenty24Totwenty25
                ],
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
            document.getElementById('sasResearchPerSchoolYear'), {
                type: 'line',
                data: sasResearchPerYearData,
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
