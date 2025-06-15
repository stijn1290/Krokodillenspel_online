<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Krokodillen Spel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-500 min-h-screen flex flex-col items-center justify-center p-10 space-y-10">
<div class="grid grid-cols-2 gap-10">
    <div class="w-96 bg-green-400 rounded-lg shadow-lg p-6">
        <ul class="text-white text-lg flex flex-row justify-between">
            @foreach([$match->getPlayer1()->getDbUser(), $match->getPlayer2()->getDbUser()] as $user)
                <li>Player: {{ $user->name }}</li>
                @if($user->id === $match->getPlayer1()->getDbUser()->id)
                    <li>Score: {{ session('score_player_1') }}</li>
                @else
                    <li>Score: {{ session('score_player_2') }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="w-96 bg-green-400 rounded-lg shadow-lg p-6">
        <h2>{{ session('turn') }}: it's your turn</h2>
        <h2>{{ session('message') }}</h2>
        <form method="POST" action="{{ route('game.destroy', $game) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Quit game"
                   class="bg-red-600 rounded-lg shadow-lg p-2 text-white cursor-pointer">
        </form>
    </div>
</div>
<div class="bg-green-500 border border-black p-14 rounded-3xl shadow-2xl w-[800px]">
    <div class="flex justify-between items-center mb-10">
        <div class="text-white text-2xl font-mono" id="timer">0 s</div>
        <a href="/">
            <h1 class="text-white text-2xl font-mono font-bold">Home</h1>
        </a>
    </div>

    <div class="flex justify-center gap-52 mb-20">
        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-lg">
            <div class="w-10 h-10 bg-black rounded-full"></div>
        </div>
        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-lg">
            <div class="w-10 h-10 bg-black rounded-full"></div>
        </div>
    </div>

    <div class="flex justify-center gap-4 mb-6">
        @for ($i = 0; $i < count($match->getCrocodile()->toothes); $i++)
            @if($i <= 5)
                @if(session($i))
                    <div class="w-12 h-20 bg-green-400 rounded-b-full shadow-inner"></div>
                @else
                    <a class="w-12 h-20 bg-white rounded-b-full shadow-inner"
                       href="{{ route('match.presstooth', ["tooth" => $i]) }}"></a>
                @endif
            @endif
        @endfor
    </div>

    <div class="bg-red-600 h-8"></div>

    <div class="flex justify-center gap-4 mt-6">
        @for ($i = 0; $i < count($match->getCrocodile()->toothes); $i++)
            @if($i >= 6)
                @if(session($i))
                    <div class="w-12 h-20 bg-green-400 rounded-t-full shadow-inner"></div>
                @else
                    <a class="w-12 h-20 bg-white rounded-t-full shadow-inner"
                       href="{{ route('match.presstooth', ["tooth" => $i]) }}"></a>
                @endif
            @endif
        @endfor
    </div>
</div>

<script>

    let seconds = 0;
    const timer = document.getElementById('timer');

    setInterval(() => {
        seconds++;
        timer.textContent = seconds + ' s';
    }, 1000);

</script>
</body>
</html>
