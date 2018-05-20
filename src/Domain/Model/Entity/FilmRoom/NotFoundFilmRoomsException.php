<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundFilmRoomsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala, en la que se visualize la película';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
