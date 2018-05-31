<?php

namespace Javier\Cineja\Domain\Model\PasswordHash;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class IncorrectPasswordException extends \Exception
{
    public function __construct()
    {
        $message = 'La contraseña introducida no es correcta';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
