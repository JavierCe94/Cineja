<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

class CreateSeatsRoomCommand
{
    private $idRoom;
    private $price;
    private $totalSeats;

    public function __construct($idRoom, $price, $totalSeats)
    {
        $this->idRoom = $idRoom;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
    }

    public function idRoom(): int
    {
        return $this->idRoom;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function totalSeats(): int
    {
        return $this->totalSeats;
    }
}
