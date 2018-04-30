<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\Room;

class ShowRoomsTransform implements ShowRoomsTransformInterface
{
    /**
     * @param array|Room[] $rooms
     * @return array
     */
    public function transform(array $rooms): array
    {
        $listRooms = [];
        foreach ($rooms as $room) {
            $listRooms[] = [
                'id' => $room->id(),
                'name' => $room->name()
            ];
        }

        return $listRooms;
    }
}
