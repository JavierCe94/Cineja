<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

class NotFoundUsersException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún usuario';
        parent::__construct($message);
    }
}
