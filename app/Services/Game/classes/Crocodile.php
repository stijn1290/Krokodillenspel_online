<?php

namespace App\Services\Game\classes;

class Crocodile
{
    public array $toothes;
    private bool $bitten = false;
    private int $toothesPressedTotal = 0;
    public function __construct()
    {
        $randomIndex = rand(0, 12);
        for ($i = 0; $i < 12; $i++) {
            if ($i === $randomIndex) {
                $tooth = new Tooth(true, false);
            } else {
                $tooth = new Tooth(false, false);
            }
            $this->toothes[$i] = $tooth;
        }
    }
    public function setBitten() : void
    {
        $this->bitten = true;
    }
    public function bitten() :bool
    {
        return $this->bitten;
    }
    public function getTooth(int $i) : Tooth
    {
        return $this->toothes[$i];
    }
    public function setToothPressedTotal() : void
    {
        $this->toothesPressedTotal++;
    }
    public function getToothPressedTotal() :int
    {
        return $this->toothesPressedTotal;
    }
}
