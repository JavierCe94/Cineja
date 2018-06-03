<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

use Javier\Cineja\Domain\Model\Entity\Room\Room;

interface ShowRoomByIdTransformI
{
    public function transform(Room $room);
}
