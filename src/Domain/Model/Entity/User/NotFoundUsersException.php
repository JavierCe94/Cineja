<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundUsersException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún usuario';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
