@include('layouts.header', ['title' => 'Home'])

<body class="container flex items-center justify-center min-h-screen bg-gray-100">
<main class="flex items-center justify-center mt-20">
    <div class="bg-[#57B404] w-1/2 p-6 rounded-2xl">
        <h2 class="custom-outline text-[36px] font-bold mb-6">Tandjes Druk Spel – De Drankvariant</h2>
        <p class="custom-outline text-[28px] leading-relaxed mb-6">
            Het klassieke kinderspel is volwassen geworden en hij is dorstig! Het Tandjes Druk Spel: Drankvariant is dé perfecte ijsbreker voor feestjes, borrels of gewoon een hilarische avond met vrienden. Simpel, spannend en een tikje gevaarlijk... voor je lever.
        </p>

        <h2 class="custom-outline text-[36px] font-bold mb-4">Hoe werkt het?</h2>
        <p class="custom-outline text-[28px] leading-relaxed mb-6">
            Elke speler drukt om de beurt op één tand van de krokodil. Eén daarvan is de foute tand – druk daarop, en de krokodil hapt toe! Word jij gebeten? Dan drink je. Zo simpel is het.
        </p>

        <h2 class="custom-outline text-[36px] font-bold mb-4">Spelregels</h2>
        <ul class="custom-outline text-[28px] leading-relaxed list-disc list-inside mb-6">
            <li>Druk om de beurt op een tand.</li>
            <li>Word je gebeten? → Neem een slok of een shotje!</li>
            <li>Reset en speel verder. De ‘gebetene’ begint de volgende ronde.</li>
            <li>Maak het nog spannender!</li>
            <li>Shotmodus: Word je gebeten? Shot erin!</li>
            <li>Opdrachtenversie: Verstop kaartjes met opdrachten onder de tanden.</li>
            <li>Laatste Kans: Wie drie keer wordt gebeten, doet een dubbele straf.</li>
        </ul>

        <h2 class="custom-outline text-[36px] font-bold mb-4">Let op</h2>
        <p class="custom-outline text-[28px] leading-relaxed mb-6">
            Dit spel is alleen voor 18+ en moet verantwoord gespeeld worden. Drink met mate en ken je grenzen.
        </p>

        <h2 class="custom-outline text-[36px] font-bold mb-4">Wat heb je nodig?</h2>
        <ul class="custom-outline text-[28px] leading-relaxed list-disc list-inside">
            <li>Drankje naar keuze (bier, wijn, mix, shotjes)</li>
            <li>Gezellig gezelschap</li>
        </ul>
        @if(Auth::check())
            <div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">My Friends</h2>

                @if($friends->isEmpty())
                    <p>No friends</p>
                @else
                    <ul class="space-y-2">
                        @foreach($friends as $friend)
                            <li class="p-3 bg-gray-100 rounded-md shadow-sm flex items-center justify-between">
                                <span>{{ $friend->name }}</span>
                                <form method="POST" action="{{ url('/friend-remove/' . $friend->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700">Remove</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @else
            <p class="text-center mt-6 text-gray-600">Please <a href="/login" class="text-blue-500">log in</a> to see your friends.</p>
        @endif
    </div>


</main>

<style>
    @layer utilities {
        .custom-outline {
            -webkit-text-stroke: 1.5px #003b1f;
            color: #FECB08;
        }
    }
</style>
</body>
</html>
