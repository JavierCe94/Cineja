<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

class ChangeSeatsToTypeNormalCommand
{
    private $seats;

    public function __construct($seats)
    {
        $this->seats = $seats;
    }

    public function seats(): array
    {
        return $this->seats;
    }
}
