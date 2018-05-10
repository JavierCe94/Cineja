<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

class ShowSeatsFilmRoomCommand
{
    private $room;
    private $filmRoom;

    public function __construct($room, $filmRoom)
    {
        $this->room = $room;
        $this->filmRoom = $filmRoom;
    }

    public function room(): int
    {
        return $this->room;
    }

    public function filmRoom(): int
    {
        return $this->filmRoom;
    }
}
