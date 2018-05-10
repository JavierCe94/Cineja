<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

class ChangeRoomToStateCloseCommand
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
