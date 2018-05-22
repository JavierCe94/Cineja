<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

class CreateUserSeatsFilmCommand
{
    private $seats;
    private $filmRoom;
    private $codeQr;

    public function __construct($seats, $filmRoom, $codeQr)
    {
        $this->seats = $seats;
        $this->filmRoom = $filmRoom;
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

    public function codeQr(): string
    {
        return $this->codeQr;
    }
}
