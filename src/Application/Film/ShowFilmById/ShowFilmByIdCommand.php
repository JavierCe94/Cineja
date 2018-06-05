<?php

namespace Javier\Cineja\Application\Film\ShowFilmById;

class ShowFilmByIdCommand
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
