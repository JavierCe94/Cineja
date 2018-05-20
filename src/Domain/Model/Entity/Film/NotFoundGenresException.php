<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class NotFoundGenresException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún género';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
