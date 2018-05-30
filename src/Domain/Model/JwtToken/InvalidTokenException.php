<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

class InvalidTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha iniciado una sesión';
        parent::__construct(
            $message,
            401
        );
    }
}
