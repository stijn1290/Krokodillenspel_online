<?php

namespace App\Services\Game\classes;

class Tooth
{
    private bool $bitemark;
    private bool $pressed;
    public function __construct(bool $bitemark, bool $pressed)
    {
        $this->bitemark = $bitemark;
        $this->pressed = $pressed;
    }
    public function doesBite(): bool
    {
        return $this->bitemark;
    }
    public function isPressed(): bool
    {
        return $this->pressed;
    }
    public function setPressed(Crocodile $crocodile): void
    {
        $this->pressed = true;
        if ($this->doesBite())
        {
            $crocodile->setBitten();
        }
    }
}
