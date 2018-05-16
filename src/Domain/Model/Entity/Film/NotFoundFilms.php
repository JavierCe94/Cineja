<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

class NotFoundFilms extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna película';
        parent::__construct($message);
    }
}