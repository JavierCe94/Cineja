<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

class NotFoundGenresException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ningún género';
        parent::__construct($message);
    }
}
