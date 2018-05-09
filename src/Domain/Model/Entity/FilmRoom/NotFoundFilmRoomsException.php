<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

class NotFoundFilmRoomsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala, en la que se visualize la película';
        parent::__construct($message);
    }
}
