<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class InvalidUserTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'El usuario al que intentas acceder no es tuyo';
        $code = HttpResponses::UNAUTHORIZED;
        parent::__construct($message, $code);
    }
}
