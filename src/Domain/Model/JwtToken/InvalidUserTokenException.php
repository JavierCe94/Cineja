<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

class InvalidUserTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'El usuario al que intentas acceder no es tuyo';
        parent::__construct(
            $message,
            401
        );
    }
}
