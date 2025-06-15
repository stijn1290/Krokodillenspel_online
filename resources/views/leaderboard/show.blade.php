<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Leaderboard</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-[#57B404] text-white">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Score</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($leaders as $index => $leader)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $leader->name }}</td>
                        <td class="px-6 py-4">{{ $leader->total_score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

