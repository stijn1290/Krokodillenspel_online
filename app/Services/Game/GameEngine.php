<?php

namespace App\Services\Game;

use App\Models\User;
use App\Services\Game\classes\Game;
use App\Services\Game\classes\Player;

class GameEngine
{
    public function gameSetup() :Game
    {
        $player1 = new Player(User::all()->first());
        $player2 = new Player(User::all()->last());
        $players = [$player1, $player2];
        $game = new Game($players);
        $game->setCrocodile();
        return $game;
    }
    public function gamePlay()
    {
        $game = $this->gameSetup();
        while(!$game->getCrocodile()->bitten())
        {
            $this->round($game);
        }
        $this->gameEnd();
    }
    public function turn(Player $player)
    {

    }
    public function round(Game $game) :void
    {
        for ($i = 0; $i < 1; $i++) {
            if ($i == 0) {
                $this->turn($game->getPlayer1());
            }
            else
            {
                $this->turn($game->getPlayer2());
            }
        }
    }
    public function gameEnd() :void
    {

    }
}
