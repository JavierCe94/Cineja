<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

use Javier\Cineja\Domain\Model\Entity\Room\Room;

class ShowRoomByIdTransform implements ShowRoomByIdTransformI
{
    public function transform(Room $room)
    {
        return [
            'id' => $room->id(),
            'name' => $room->name(),
            'seatsRow' => $room->totalSeatsByRow(),
            'state' => $room->stateRoom()
        ];
    }
}
