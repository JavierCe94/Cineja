<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class FoundNameGenreException extends \Exception
{
    public function __construct()
    {
        $message = 'El nombre del género introducido ya existe';
        parent::__construct(
            $message,
            HttpResponses::CONFLICT_SEARCH
        );
    }
}
