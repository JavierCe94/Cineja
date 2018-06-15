<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

class CreateUserSeatsFilmCommand
{
    private $seats;
    private $filmRoom;
    private $user;

    public function __construct($seats, $filmRoom, $user)
    {
        $this->seats = $seats;
        $this->filmRoom = $filmRoom;
        $this->user = $user;
    }

    public function seats(): array
    {
        return $this->seats;
    }

    public function filmRoom(): int
    {
        return $this->filmRoom;
    }

    public function user(): string
    {
        return $this->user;
    }
}
