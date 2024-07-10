<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form') }}
        </h2>
    </x-slot>

    <style>
    .sticky-header {
        position: sticky;
        top: 0;
        background: white; /* Background color to avoid overlap issues */
        z-index: 1; /* Ensure it is above other content */
    }

    .table-container {
        max-height: 600px; /* Adjust the height as needed */
        overflow-y: auto; /* Enable vertical scrolling */
    }
</style>


    <form method="POST" action="{{ route('submit-evaluation') }}">
        @csrf <!-- Add CSRF protection for POST requests -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <span class="block sm:inline"> Total Score: {{ session('totalScore') }}</span>
                            <span class="block sm:inline"> Severity: {{ session('severity') }}</span>
                        </div>
                        
                        @if(session('showSuicidePreventionMessage'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                                <p><strong>Here are some suicide emergency numbers and free counseling centres in Kenya</strong></p>
                                <p><strong>Niskize’s suicide prevention helpline:</strong> 0900 620 800</p>
                                <p><strong>Emergency Medicine Kenya Foundation (EMKF) suicide prevention hotline:</strong> 0800 723 253</p>
                                <p><strong>Oasis Africa:</strong> 254 725 366 614 and +254 (0) 110 862 23</p>
                                <p><strong>Cognitive Behavioral Therapy-Kenya (CBT-Kenya):</strong> +254 739 935 333 or +254 756 454 585</p>
                                <p><strong>Please book an appointment with a therapist.</strong></p>
                            </div>
                        @endif
                    @else
                        <div class="container_1">
                            <h2 class="text-2xl font-bold mb-4">Patient Health Questionnaire-9 (PHQ-9)</h2>
                            <p class="mb-4">This is a multipurpose instrument for screening, diagnosing, monitoring, and measuring the severity of depression.</p>
                            <p class="mb-4"><strong>Over the last 2 weeks</strong>, how often have you been bothered by the following problems?</p>
                            <div class="table-container">
                                <table class="min-w-full divide-y divide-gray-200" id="evaluation-table">
                                    <thead class="bg-gray-50 sticky-header">
                                        <tr>
                                            <th class="w-1/2 p-2"></th>
                                            <th class="w-1/8 p-2 text-center">Not at all</th>
                                            <th class="w-1/8 p-2 text-center">Several days</th>
                                            <th class="w-1/8 p-2 text-center">More than half the days</th>
                                            <th class="w-1/8 p-2 text-center">Nearly every day</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach([
                                            'Little interest or pleasure in doing things',
                                            'Feeling down, depressed, or hopeless',
                                            'Trouble falling asleep, staying asleep, or sleeping too much',
                                            'Feeling tired or having little energy',
                                            'Poor appetite or overeating',
                                            'Feeling bad about yourself — or that you are a failure or have let yourself or your family down',
                                            'Trouble concentrating on things, such as reading the newspaper or watching television',
                                            'Moving or speaking so slowly that other people could have noticed. Or the opposite — being so fidgety or restless that you have been moving around a lot more than usual',
                                            'Thoughts that you would be better off dead, or thoughts of hurting yourself in some way'
                                        ] as $index => $question)
                                        <tr>
                                            <td class="p-2">{{ $index + 1 }}. {{ $question }}</td>
                                            @for($i = 0; $i < 4; $i++)
                                            <td class="p-2 text-center">
                                                <input type="radio" name="q{{ $index + 1 }}" value="{{ $i }}" class="form-radio text-peach-600" required>
                                            </td>
                                            @endfor
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <x-button type="submit" class="mt-4 bg-peach-500 hover:bg-peach-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('evaluation-table');
            const thead = table.querySelector('thead');
            const ths = thead.querySelectorAll('th');

            function adjustTableHeaderWidth() {
                const tableWidth = table.offsetWidth;
                thead.style.width = `${tableWidth}px`;

                const headerCells = thead.querySelectorAll('th');
                const bodyCells = table.querySelectorAll('tbody tr:first-child td');
                
                if (bodyCells.length) {
                    headerCells.forEach((headerCell, index) => {
                        headerCell.style.width = `${bodyCells[index].offsetWidth}px`;
                    });
                }
            }

            adjustTableHeaderWidth();
            window.addEventListener('resize', adjustTableHeaderWidth);
        });
    </script>
</x-app-layout>
