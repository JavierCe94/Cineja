<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

interface ShowSeatsFilmRoomTransformI
{
    public function transform(array $seats, int $filmRoom);
}
