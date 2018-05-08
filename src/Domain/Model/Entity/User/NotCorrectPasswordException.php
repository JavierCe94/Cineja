<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

class NotCorrectPasswordException extends \Exception
{
    public function __construct()
    {
        $message = 'La contraseña introducida no es correcta';
        parent::__construct($message);
    }
}
