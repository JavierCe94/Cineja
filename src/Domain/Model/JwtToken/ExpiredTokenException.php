<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ExpiredTokenException extends UnauthorizedHttpException
{
    public function __construct()
    {
        $message = 'Tu sesión a expirado';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
