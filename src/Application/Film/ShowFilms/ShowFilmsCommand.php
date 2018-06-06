<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

class ShowFilmsCommand
{
    private $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function date(): ?string
    {
        return $this->date;
    }
}
