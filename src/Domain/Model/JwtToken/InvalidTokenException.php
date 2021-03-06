<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class InvalidTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha iniciado una sesión';
        parent::__construct(
            $message,
            HttpResponses::UNAUTHORIZED
        );
    }
}
