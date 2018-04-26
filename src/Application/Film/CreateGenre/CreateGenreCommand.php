<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Assert\Assertion;

class CreateGenreCommand
{
    private $name;

    public function __construct($name)
    {
        Assertion::notBlank($name, 'Tienes que especificar un nombre');
        Assertion::string($name, 'El nombre tiene que ser de tipo texto');

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
