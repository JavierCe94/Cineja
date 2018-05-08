<?php

namespace Javier\Cineja\Application\FilmRoom\CreateFilmRoom;

class CreateFilmRoomCommand
{
    private $film;
    private $room;
    private $releaseDate;

    public function __construct($film, $room, $releaseDate)
    {
        $this->film = $film;
        $this->room = $room;
        $this->releaseDate = $releaseDate;
    }

    public function film(): int
    {
        return $this->film;
    }

    public function room(): int
    {
        return $this->room;
    }

    public function releaseDate(): string
    {
        return $this->releaseDate;
    }
}
