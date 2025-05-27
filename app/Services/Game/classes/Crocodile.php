<?php

namespace App\Services\Game\classes;

class Crocodile
{
    public array $toothes;
    public function __construct()
    {
        for ($i = 0; $i < 12; $i++) {
            $tooth = new Tooth(false, false);
            $this->toothes[$i] = $tooth;
        }
    }
    public function bitten() :bool
    {
        return true;
    }
}
