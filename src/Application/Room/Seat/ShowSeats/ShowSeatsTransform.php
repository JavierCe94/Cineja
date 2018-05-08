<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeats;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;

class ShowSeatsTransform implements ShowSeatsTransformInterface
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
