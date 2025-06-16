@include('layouts.header', ['title' => 'Home'])

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Games Played</h2>

                @if ($games->isEmpty())
                    <p class="text-gray-600">No games played yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-200 rounded">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Game ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Winner</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Loser</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Total Pressed</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach ($games as $game)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $game->id }}</td>
                                    <td class="px-4 py-2">{{ $game->winner->name }}</td>
                                    <td class="px-4 py-2">{{ $game->loser->name }}</td>
                                    <td class="px-4 py-2">{{ $game->toothsPressedTotal }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
