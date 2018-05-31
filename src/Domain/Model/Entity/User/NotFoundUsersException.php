<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundUsersException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún usuario';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
