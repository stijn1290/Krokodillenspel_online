<?php

namespace App\Services\Game\classes;
use App\Services\Game\classes\Player;

class Game
{
    private array $players = [];
    private Crocodile $crocodile;
    public function __construct(array $players)
    {
        for ($i = 0; $i < $players; $i++) {
            $this->players[$i] = $players[$i];
        }
    }
    public function getPlayer1(): Player
    {
        return $this->players[0];
    }
    public function getPlayer2(): Player
    {
        return $this->players[1];
    }
    public function getCrocodile(): Crocodile
    {
        return $this->crocodile;
    }
    public function setCrocodile() :void
    {
        $this->crocodile = new Crocodile();
    }
}
