<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundFilms extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna película';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
