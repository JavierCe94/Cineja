<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRooms;

use Javier\Cineja\Infrastructure\Repository\FilmRoom\FilmRoomRepository;

class ShowFilmRooms
{
    private $filmRoomRepository;

    public function __construct(FilmRoomRepository $filmRoomRepository)
    {

    }
}
