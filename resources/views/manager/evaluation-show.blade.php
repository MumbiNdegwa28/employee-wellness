<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Evaluation Form Details
                    </div>
                    <div class="mt-6 text-gray-500">
                        <table class="table-auto w-full">
                            <tr>
                                <th class="px-4 py-2">Question</th>
                                <th class="px-4 py-2">Answer</th>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Q1</td>
                                <td class="border px-4 py-2">{{ $evaluationForm->q1 }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Q2</td>
                                <td class="border px-4 py-2">{{ $evaluationForm->q2 }}</td>
                            </tr>
                            <!-- Repeat for other questions -->
                            <tr>
                                <td class="border px-4 py-2">Total Score</td>
                                <td class="border px-4 py-2">{{ $evaluationForm->total_score }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">Severity</td>
                                <td class="border px-4 py-2">{{ $evaluationForm->severity }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
