<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

class ChangeStateToRetiredFilmCommand
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
