<?php

namespace App\Services\Game\classes;
use App\Models\User;
use App\Services\Game\classes\Tooth;
class Player
{
    private User $dbUser;
    private array $toothesPressed = [];
    public function __construct(User $user)
    {
        $this->dbUser = $user;
    }
    public function pressTooth (Tooth $tooth) : void
    {

    }
}
