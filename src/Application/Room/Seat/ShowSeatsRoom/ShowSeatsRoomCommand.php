<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

class ShowSeatsRoomCommand
{
    private $room;

    public function __construct($room)
    {
        $this->room = $room;
    }

    public function room(): int
    {
        return $this->room;
    }
}
