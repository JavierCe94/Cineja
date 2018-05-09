<?php

namespace Javier\Cineja\Application\UserSeatFilm\ShowUserSeatsFilm;

class ShowUserSeatsFilmCommand
{
    private $filmRoom;
    private $user;

    public function __construct($filmRoom, $user)
    {
        $this->filmRoom = $filmRoom;
        $this->user = $user;
    }

    public function filmRoom(): int
    {
        return $this->filmRoom;
    }

    public function user(): int
    {
        return $this->user;
    }
}
