<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Current_game;
use App\Services\Game\classes\GameClass;
use App\Services\Game\GameEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::where('winner_id', Auth::id())->orWhere('loser_id', Auth::id())->get();
        return view('game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'player_id_2' => 'required',
        ]);
        $game = Current_game::create([
            "player_id_1" => Auth::id(),
            "player_id_2" => $request->get("player_id_2"),
        ]);
        return redirect()->route('game.show', $game);
    }

    /**
     * Display the specified resource.
     */
    public function show(Current_game $game)
    {
        $engine = new GameEngine();
        $match = $engine->gameSetup($game->player1 , $game->player2);
        if (session('current_match') == null && session('turn') == null) {
            session([
                'current_match' => $match,
                'turn' => $match->getPlayer1()->getDbUser()->name,
            ]);
        }
        else
        {
            $match = session('current_match');
        }
        session(['engine' => $engine]);
        return view('game.show', compact('match', 'engine', 'game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Current_game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Current_game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Current_game $game)
    {
        $game->delete();
        session()->flush();
        return redirect()->route('home');
    }
    public function pressTooth($tooth)
    {
        $match = session('current_match');
        $message = $match->getPlayer1()->pressTooth($match, $tooth);
        if ($message == "Tooth pressed and it bit") {
            session('engine')->gameEnd($match);
            return view('gameEndPage');
        }
        session(['message' => $message]);
        session([$tooth => true]);
        $currentPlayer = session('turn');
        if ($currentPlayer == $match->getPlayer1()->getDbUser()->name) {
            session(['score_player_1' => session('score_player_1') + 1]);
            session(['turn' => $match->getPlayer2()->getDbUser()->name]);
        }
        else
        {
            session(['score_player_2' => session('score_player_2') + 1]);
            session(['turn' => $match->getPlayer1()->getDbUser()->name]);
        }
        return redirect()->back();
    }
}
