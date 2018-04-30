<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

class CreateRoomCommand
{
    private $name;
    private $totalSeatsByRow;

    public function __construct($name, $totalSeatsByRow)
    {
        $this->name = $name;
        $this->totalSeatsByRow = $totalSeatsByRow;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function totalSeatsByRow(): int
    {
        return $this->totalSeatsByRow;
    }
}
