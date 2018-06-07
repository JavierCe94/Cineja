<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRoomsByIdAndDate;

class ShowFilmRoomsByIdAndDateCommand
{
    private $film;
    private $date;

    public function __construct($film, $date)
    {
        $this->film = $film;
        $this->date = $date;
    }

    public function film(): int
    {
        return $this->film;
    }

    public function date(): string
    {
        return $this->date;
    }
}
