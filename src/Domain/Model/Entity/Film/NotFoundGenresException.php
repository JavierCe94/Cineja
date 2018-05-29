<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundGenresException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún género';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
