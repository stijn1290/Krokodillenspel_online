<?php

namespace App\Services\Game;

use App\Models\User;
use App\Models\Game;
use App\Services\Game\classes\Crocodile;
use App\Services\Game\classes\GameClass;
use App\Services\Game\classes\Player;

class GameEngine
{
    public function gameSetup(User $user1, User $user2): GameClass
    {
        $player1 = new Player($user1);
        $player2 = new Player($user2);
        $players = [$player1, $player2];
        $game = new GameClass($players);
        $game->setCrocodile();
        return $game;
    }

    public function gamePlay($game)
    {
        $maxRounds = 100;  // Failsafe
        $round = 0;

        while (!$game->getCrocodile()->bitten() && $round++ < $maxRounds) {
            $this->round($game);
        }

        $this->gameEnd($game);
    }

    public function turn(Player $player, GameClass $game)
    {
        $index = $this->getUnpressedToothIndex($game->getCrocodile());

        if ($index !== null) {
            $player->pressTooth($game, $index);
        }
    }

    public function round(GameClass $game): void
    {
        $this->turn($game->getPlayer1(), $game);
        $this->turn($game->getPlayer2(), $game);
    }

    public function gameEnd(GameClass $game): void
    {
        Game::create([
            'winner_id' => $game->getWinner()->getDbUser()->id,
            'loser_id' => $game->getLoser()->getDbUser()->id,
            'score_winner' => $game->getWinner()->getTeethesPressedInt(),
            'toothsPressedTotal' => $game->getCrocodile()->getToothPressedTotal(),
        ]);
        session()->flush();
    }
    private function getUnpressedToothIndex(Crocodile $crocodile): ?int
    {
        $indexes = [];

        foreach ($crocodile->toothes as $i => $tooth) {
            if (!$tooth->isPressed()) {
                $indexes[] = $i;
            }
        }

        if (empty($indexes)) return null;

        return $indexes[array_rand($indexes)];
    }

}
