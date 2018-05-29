<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundRoomsException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna sala';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
