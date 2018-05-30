<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

class ExpiredTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'Tu sesión a expirado';
        parent::__construct(
            $message,
            401
        );
    }
}
