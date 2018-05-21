<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class InvalidRoleTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'No puedes acceder a esta información';
        $code = HttpResponses::UNAUTHORIZED;
        parent::__construct($message, $code);
    }
}
