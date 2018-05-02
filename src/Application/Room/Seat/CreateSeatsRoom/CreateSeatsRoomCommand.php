<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

class CreateSeatsRoomCommand
{
    private $idRoom;
    private $priceSeat;
    private $totalSeatsRoom;

    public function __construct($idRoom, $priceSeat, $totalSeatsRoom)
    {
        $this->idRoom = $idRoom;
        $this->priceSeat = $priceSeat;
        $this->totalSeatsRoom = $totalSeatsRoom;
    }

    public function idRoom(): int
    {
        return $this->idRoom;
    }

    public function priceSeat(): float
    {
        return $this->priceSeat;
    }

    public function totalSeatsRoom(): int
    {
        return $this->totalSeatsRoom;
    }
}
