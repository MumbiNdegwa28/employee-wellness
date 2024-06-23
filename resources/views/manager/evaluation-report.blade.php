<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Evaluation Form Report
                    </div>
                    <div class="mt-6 text-gray-500">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Q1</th>
                                    <th class="px-4 py-2">Q2</th>
                                    <th class="px-4 py-2">Q3</th>
                                    <th class="px-4 py-2">Q4</th>
                                    <th class="px-4 py-2">Q5</th>
                                    <th class="px-4 py-2">Q6</th>
                                    <th class="px-4 py-2">Q7</th>
                                    <th class="px-4 py-2">Q8</th>
                                    <th class="px-4 py-2">Q9</th>
                                    <th class="px-4 py-2">Total Score</th>
                                    <th class="px-4 py-2">Severity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluationForms as $form)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $form->id }}</td>
                                        <td class="border px-4 py-2">{{ $form->q1 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q2 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q3 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q4 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q5 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q6 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q7 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q8 }}</td>
                                        <td class="border px-4 py-2">{{ $form->q9 }}</td>
                                        <td class="border px-4 py-2">{{ $form->total_score }}</td>
                                        <td class="border px-4 py-2">{{ $form->severity }}</td>
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
