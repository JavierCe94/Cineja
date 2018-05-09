<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

class ShowRoomByIdCommand
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
