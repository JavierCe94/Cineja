<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

class ChangeRoomToStateOpenCommand
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
