<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6">
                <!-- Line Chart -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 sm:px-10 bg-gradient-to-r from-blue-200 to-green-200 border-b border-blue-300">
                    <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                        Evaluation Form Report
                    </div>

                    <div id="line-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var evaluationForms = @json($evaluationForms); // Convert PHP variable to JavaScript object

            // Extract data for chart
            var maleForms = evaluationForms.filter(form => form.gender === 'Male');
            var femaleForms = evaluationForms.filter(form => form.gender === 'Female');

            var labels = evaluationForms.map(function(form) {
                return 'Form ' + form.id; // Example label
            });

            var maleData = maleForms.map(function(form) {
                return form.total_score; // Example data point
            });

            var femaleData = femaleForms.map(function(form) {
                return form.total_score; // Example data point
            });

            // Calculate total scores
            var maleTotalScore = maleData.reduce((acc, curr) => acc + curr, 0);
            var femaleTotalScore = femaleData.reduce((acc, curr) => acc + curr, 0);

            const options = {
                chart: {
                    height: "100%",
                    type: "line",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: "solid",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 4, // Ensures defined lines
                    curve: 'smooth',
                    colors: ["#1A56DB", "#7E3AF2"], // Line colors
                },
                markers: {
                    size: 6, // Ensure markers are visible
                    hover: {
                        size: 8
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -26
                    },
                },
                series: [
                    {
                        name: "Male Total Score",
                        data: maleData,
                        color: "#1A56DB",
                    },
                    {
                        name: "Female Total Score",
                        data: femaleData,
                        color: "#7E3AF2",
                    },
                ],
                legend: {
                    show: true
                },
                xaxis: {
                    categories: labels,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: true,
                    min: 0,
                    max: Math.max(...maleData, ...femaleData) + 5, // Dynamically setting the max value based on the data
                    labels: {
                        formatter: function(value) {
                            return Math.floor(value);
                        }
                    }
                },
            }

            if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("line-chart"), options);
                chart.render();
            }
        });
    </script>
</x-app-layout>
