<x-app-layout>
    <form class="bg-[#57B404] w-1/2 p-6 rounded-2xl flex flex-col items-center gap-3" method="POST" action="{{ route('game.store') }}">
        @csrf
        <label for="player_id_2">Play against</label>
        <select name="player_id_2" id="player_id_2">
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="Start game" class="bg-white text-black p-4 rounded-2xl cursor-pointer hover:bg-gray-500">
    </form>
</x-app-layout>
