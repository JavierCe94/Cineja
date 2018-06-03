<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class FoundMailUserException extends \Exception
{
    public function __construct()
    {
        $message = 'El email del usuario introducido ya existe';
        parent::__construct(
            $message,
            HttpResponses::CONFLICT_SEARCH
        );
    }
}
