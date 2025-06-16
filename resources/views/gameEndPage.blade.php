<x-app-layout>
    @php
        $game = \App\Models\Game::first();
        $winner = $game->winner->name;
        $winnerScore = $game->score_winner;
        $loser = $game->loser->name;
        $loserScore = $game->toothsPressedTotal - $winnerScore;
    @endphp

    <main class="flex items-center justify-center mt-20">
        <div class="bg-[#57B404] w-full max-w-xl p-8 rounded-2xl shadow-lg text-white text-center space-y-4">
            <h2 class="text-2xl font-bold">🎉 Congratulations, {{ $winner }}!</h2>
            <p class="text-lg">You won with <span class="font-semibold">{{ $winnerScore }}</span> points.</p>

            <h2 class="text-xl font-semibold">😞 {{ $loser }}, better luck next time!</h2>
            <p class="text-lg">You scored <span class="font-semibold">{{ $loserScore }}</span> points.</p>

            <p class="mt-4">📊 You can visit your stats on your profile.</p>

            <a href="{{ route('dashboard') }}"
               class="inline-block mt-4 bg-white text-[#57B404] font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition">
                Go to Profile
            </a>
        </div>
    </main>
</x-app-layout>
