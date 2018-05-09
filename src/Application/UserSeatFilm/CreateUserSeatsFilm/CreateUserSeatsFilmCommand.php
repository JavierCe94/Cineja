<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

class CreateUserSeatsFilmCommand
{
    private $seats;
    private $filmRoom;
    private $user;
    private $codeQr;

    public function __construct($seats, $filmRoom, $user, $codeQr)
    {
        $this->seats = $seats;
        $this->filmRoom = $filmRoom;
        $this->user = $user;
        $this->codeQr = $codeQr;
    }

    public function seats(): array
    {
        return $this->seats;
    }

    public function filmRoom(): int
    {
        return $this->filmRoom;
    }

    public function user(): int
    {
        return $this->user;
    }

    public function codeQr(): string
    {
        return $this->codeQr;
    }
}
