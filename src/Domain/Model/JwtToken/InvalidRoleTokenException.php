<?php

namespace Javier\Cineja\Domain\Model\JwtToken;


use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidRoleTokenException extends UnauthorizedHttpException
{
    public function __construct()
    {
        $message = 'No puedes acceder a esta información';
        parent::__construct(
            $message,
            $this->getStatusCode()
        );
    }
}
