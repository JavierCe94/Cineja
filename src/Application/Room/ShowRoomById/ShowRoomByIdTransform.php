<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

use Javier\Cineja\Domain\Model\Entity\Room\Room;

class ShowRoomByIdTransform implements ShowRoomByIdTransformInterface
{
    /**
     * @param array|Room[] $rooms
     * @return array
     */
    public function transform(array $rooms)
    {
        $listRooms = [];
        foreach ($rooms as $room) {
            $listRooms[] = [
                'id' => $room->id(),
                'name' => $room->name(),
                'totalSeatsByRow' => $room->totalSeatsByRow(),
                'stateRoom' => $room->stateRoom()
            ];
        }

        return $listRooms;
    }
}
