<?php

namespace Javier\Cineja\Domain\Model\Entity\Room\Seat;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundSeatsException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna butaca';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
