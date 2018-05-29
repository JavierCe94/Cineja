<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidUserTokenException extends UnauthorizedHttpException
{
    public function __construct()
    {
        $message = 'El usuario al que intentas acceder no es tuyo';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
