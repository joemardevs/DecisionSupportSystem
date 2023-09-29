@extends('livewire.layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <main class="flex min-h-screen">
        <livewire:components.sidebar />
        <div class="w-full bg-gray-200">
            <section class="p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full h-fit md:w-96 p-4 bg-white rounded-lg drop-shadow-md">
                        <div class="w-80 mx-auto">
                            <canvas id="myChart" style="height:10px; width:10px"></canvas>
                        </div>
                    </div>
                    <div class="w-full h-[35rem] bg-white rounded-lg drop-shadow-md">
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                data: [100, 50, 70],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        new Chart(
            document.getElementById('myChart'), {
                type: 'doughnut',
                data: data,
            }
        );
    </script>
@endsection
