<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundFilms extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna película';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
