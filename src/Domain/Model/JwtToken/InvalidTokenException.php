<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidTokenException extends UnauthorizedHttpException
{
    public function __construct()
    {
        $message = 'No se ha iniciado una sesión';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
