<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6">
                <!-- Area Chart -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 sm:px-10 bg-gradient-to-r from-blue-200 to-green-200 border-b border-blue-300">
                    <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                        Evaluation Form Report
                    </div>

                    <div id="area-chart"></div>
                </div>

                <!-- Column Chart -->
                <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 sm:px-10 bg-gradient-to-r from-purple-200 to-pink-200 border-b border-purple-300">
                    <div class="mt-8 text-2xl font-bold text-center text-purple-900">
                        Gender-Based Depression Levels
                    </div>

                    <div id="column-chart"></div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const evaluationData =<?php echo json_encode($data)?>;
           

            const dates = evaluationData.map(entry => entry.date);
            const minimal = evaluationData.map(entry => entry.minimal);
            const mild = evaluationData.map(entry => entry.mild);
            const moderate = evaluationData.map(entry => entry.moderate);
            const moderatelySevere = evaluationData.map(entry => entry.moderately_severe);
            const severe = evaluationData.map(entry => entry.severe);

            const getEvaluationChartOptions = (dates, minimal, mild, moderate, moderatelySevere, severe) => {
                return {
                    series: [
                        { name: 'Minimal depression', data: minimal, color: '#3498db' },
                        { name: 'Mild depression', data: mild, color: '#e74c3c' },
                        { name: 'Moderate depression', data: moderate, color: '#f39c12' },
                        { name: 'Moderately severe depression', data: moderatelySevere, color: '#8e44ad' },
                        { name: 'Severe depression', data: severe, color: '#2ecc71' },
                    ],
                    chart: {
                        height: "100%",
                        maxWidth: "100%",
                        type: "area",
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
                        type: "gradient",
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#1C64F2",
                            gradientToColors: ["#1C64F2"],
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: 0
                        },
                    },
                    xaxis: {
                        categories: dates,
                        labels: {
                            show: true,
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
                    },
                }
            }
            
            if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
                const areaChart = new ApexCharts(document.getElementById("area-chart"), getEvaluationChartOptions(dates, minimal, mild, moderate, moderatelySevere, severe));
                areaChart.render();
            }

           
        });
    </script>
    @endpush
</x-app-layout>
