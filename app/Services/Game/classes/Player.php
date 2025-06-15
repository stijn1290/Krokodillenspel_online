<?php

namespace App\Services\Game\classes;
use App\Models\User;
use App\Services\Game\classes\Tooth;
class Player
{
    private bool $winner = false;
    private User $dbUser;
    private array $teethesPressed = [];
    public function __construct(User $user)
    {
        $this->dbUser = $user;
    }
    public function pressTooth(GameClass $game, int $gameIndex): string
    {
        $targetTooth = $game->getCrocodile()->getTooth($gameIndex);
        if ($targetTooth->isPressed()) {
            return 0;
        }
        $targetTooth->setPressed($game->getCrocodile());
        $game->getCrocodile()->setToothPressedTotal();
        $this->setTeethesPressed($targetTooth);
        if ($targetTooth->doesBite()) {
            return "Tooth pressed and it bit";
        }
        else
        {
            return "Tooth pressed it doesn't bit";
        }
    }
    public function setTeethesPressed(Tooth $tooth) : void
    {
        $this->teethesPressed = [$tooth];
    }
    public function getTeethesPressed() : array
    {
        return $this->teethesPressed;
    }
    public function isWinner() : bool
    {
        return $this->winner;
    }
    public function getDbUser()
    {
        return $this->dbUser;
    }
    public function getTeethesPressedInt() :int
    {
        return count($this->teethesPressed);
    }
}
