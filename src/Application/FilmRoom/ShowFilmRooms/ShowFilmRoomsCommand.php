<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRooms;

class ShowFilmRoomsCommand
{
    private $film;

    public function __construct($film)
    {
        $this->film = $film;
    }

    public function film(): int
    {
        return $this->film;
    }
}
