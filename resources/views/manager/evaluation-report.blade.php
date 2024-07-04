<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-900 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-xl">
                <div class="p-6 sm:px-10 bg-gradient-to-r from-blue-200 to-green-200 border-b border-blue-300">
                    <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                        Evaluation Form Report
                    </div>
                    <div class="mt-6 text-gray-700 table-container">
                        <table class="table-auto w-full border-collapse">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">ID</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q1</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q2</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q3</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q4</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q5</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q6</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q7</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q8</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Q9</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Total Score</th>
                                    <th class="px-4 py-2 border-b font-medium text-gray-700 text-center">Severity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluationForms as $form)
                                    <tr class="hover:bg-blue-100">
                                        <td class="border px-4 py-2 text-center">{{ $form->id }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q1 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q2 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q3 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q4 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q5 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q6 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q7 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q8 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->q9 }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->total_score }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $form->severity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
