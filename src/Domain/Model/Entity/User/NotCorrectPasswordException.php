<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotCorrectPasswordException extends \Exception
{
    public function __construct()
    {
        $message = 'La contraseña introducida no es correcta';
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
