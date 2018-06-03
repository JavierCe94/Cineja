<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class FoundNameFilmException extends \Exception
{
    public function __construct()
    {
        $message = 'El nombre de la película introducida ya existe';
        parent::__construct(
            $message,
            HttpResponses::CONFLICT_SEARCH
        );
    }
}
