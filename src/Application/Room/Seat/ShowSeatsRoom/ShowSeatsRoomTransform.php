<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;

class ShowSeatsRoomTransform implements ShowSeatsRoomTransformInterface
{
    /**
     * @param array|Seat[] $seats
     * @return array
     */
    public function transform(array $seats)
    {
        $listSeats = [];
        foreach ($seats as $seat) {
            $listSeats[] = [
                'id' => $seat->id(),
                'price' => $seat->price(),
                'typeSpace' => $seat->typeSpace()
            ];
        }

        return $listSeats;
    }
}
