<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

class InvalidRoleTokenException extends \Exception
{
    public function __construct()
    {
        $message = 'No puedes acceder a esta información';
        parent::__construct(
            $message,
            401
        );
    }
}
