<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundFilms extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna película';
        parent::__construct(
            $message,
            HttpResponses::NOT_FOUND
        );
    }
}
