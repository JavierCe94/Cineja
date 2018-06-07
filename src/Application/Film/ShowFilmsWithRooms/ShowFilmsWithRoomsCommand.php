<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

class ShowFilmsWithRoomsCommand
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
