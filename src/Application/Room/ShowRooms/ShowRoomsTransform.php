<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\Room;

class ShowRoomsTransform implements ShowRoomsTransformI
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
                'seatsRow' => $room->totalSeatsByRow(),
                'state' => $room->stateRoom()
            ];
        }

        return $listRooms;
    }
}
