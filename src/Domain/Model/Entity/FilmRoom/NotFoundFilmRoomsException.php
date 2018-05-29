<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundFilmRoomsException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala, en la que se visualize la película';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
