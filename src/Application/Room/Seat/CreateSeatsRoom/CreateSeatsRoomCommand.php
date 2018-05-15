<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

class CreateSeatsRoomCommand
{
    private $room;
    private $priceSeat;
    private $totalSeatsRoom;

    public function __construct($room, $priceSeat, $totalSeatsRoom)
    {
        $this->room = $room;
        $this->priceSeat = $priceSeat;
        $this->totalSeatsRoom = $totalSeatsRoom;
    }

    public function room(): int
    {
        return $this->room;
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
