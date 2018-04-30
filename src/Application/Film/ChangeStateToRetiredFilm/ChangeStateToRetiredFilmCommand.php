<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

class ChangeStateToRetiredFilmCommand
{
    private $id;
    private $state;

    public function __construct($id, $state)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function id()
    {
        return $this->id;
    }

    public function state()
    {
        return $this->state;
    }
}
