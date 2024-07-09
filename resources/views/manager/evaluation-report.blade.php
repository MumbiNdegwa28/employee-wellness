<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 sm:px-10 bg-gradient-to-r from-blue-200 to-green-200 border-b border-blue-300">
                <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                    Evaluation Form Report
                </div>
                
                <div class="mt-6">
                    <canvas id="chartContainer" style="height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var evaluationForms = @json($evaluationForms); // Convert PHP variable to JavaScript object

            // Extract data for chart
            var labels = evaluationForms.map(function(form) {
                return 'Form ' + form.id; // Example label
            });

            var data = evaluationForms.map(function(form) {
                return form.total_score; // Example data point
            });

            // Chart.js code
            var ctx = document.getElementById('chartContainer').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Score',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
