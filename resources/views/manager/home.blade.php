<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/css/slideshow.css')
</head>
<body class="font-sans antialiased">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manager Dashboard') }}
            </h2>
        </x-slot>

        <div class="slideshow-container">
            <!-- Add your slideshow images here -->
            <img src="{{ asset('images/slide1.jpg') }}" class="slideshow-image active" alt="Slide 1">
            <img src="{{ asset('images/slide2.jpg') }}" class="slideshow-image" alt="Slide 2">
            <img src="{{ asset('images/slide3.jpg') }}" class="slideshow-image" alt="Slide 3">
            <img src="{{ asset('images/slide4.jpg') }}" class="slideshow-image" alt="Slide 4">
            <img src="{{ asset('images/slide5.jpg') }}" class="slideshow-image" alt="Slide 5">
        </div>

        <div class="py-12 relative">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <!-- Link to the Chat page -->
                        <a href="{{ route('chat') }}" class="btn btn-primary">Open Chat</a>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div id="pie-chart" class="mt-8 text-2xl"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const getChartOptions = () => {
                return {
                    series: [52.8, 26.8, 20.4],
                    colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                    chart: {
                        height: 420,
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -25
                            }
                        },
                    },
                    labels: ["Direct", "Organic search", "Referrals"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%"
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%"
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }

             // Slideshow functionality
             document.addEventListener("DOMContentLoaded", function () {
                let slideIndex = 0;
                showSlides();

                function showSlides() {
                    let slides = document.getElementsByClassName("slideshow-image");
                    for (let i = 0; i < slides.length; i++) {
                        slides[i].style.opacity = "0";
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {
                        slideIndex = 1;
                    }
                    slides[slideIndex - 1].style.opacity = "1";
                    setTimeout(showSlides, 2000); // Change image every 2 seconds
                }
            });
        </script>

        @vite('resources/js/slideshow.js')
    </x-app-layout>
</body>
</html>
