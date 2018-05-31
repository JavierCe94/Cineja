<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class ExpiredTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'Tu sesión a expirado';
        parent::__construct(
            $message,
            HttpResponses::UNAUTHORIZED
        );
    }
}
