@section('title')
    {{ $title }}
@endsection
<main class="flex min-h-screen">
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
                    <h1 class="text-center">Research Completed Per Year</h1>
                    <canvas id="researchCompletedPerYear" style="width:5px"></canvas>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="w-full h-fit p-4 bg-white rounded-lg drop-shadow-md">
                    <h1 class="mb-4">Authors below success rate</h1>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-3/12">Authors</th>
                                <th scope="col" class="px-4 py-3 w-3/12">Note</th>
                                <th scope="col" class="px-4 py-3 w-3/12"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3">
                                    Test author
                                </td>
                                <td class="px-4 py-3">
                                    Test Note
                                </td>
                                <td class="px-4 py-3 flex items-center justify-start">
                                    <a href="" class="px-3 py-1 text-blue-400 rounded">
                                        Add Note
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
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
