<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class FoundCreditCardUserException extends \Exception
{
    public function __construct()
    {
        $message = 'La tarjeta de crédito del usuario introducida ya existe';
        parent::__construct(
            $message,
            HttpResponses::CONFLICT_SEARCH
        );
    }
}
