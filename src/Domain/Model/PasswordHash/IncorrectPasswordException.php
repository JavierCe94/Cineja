<?php

namespace Javier\Cineja\Domain\Model\PasswordHash;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IncorrectPasswordException extends NotFoundHttpException
{
    public function __construct()
    {
        $message = 'La contraseña introducida no es correcta';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
