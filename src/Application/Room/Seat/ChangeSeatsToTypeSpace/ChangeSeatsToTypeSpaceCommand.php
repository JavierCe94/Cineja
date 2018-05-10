<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace;

class ChangeSeatsToTypeSpaceCommand
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
