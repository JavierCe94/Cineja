<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;

class ShowSeatsFilmRoomTransform implements ShowSeatsFilmRoomTransformInterface
{
    /**
     * @param array|Seat[] $seatsFilmRoom
     * @return array
     */
    public function transform(array $seatsFilmRoom)
    {
        $listSeatsFilmRoom = [];
        foreach ($seatsFilmRoom as $seatFilmRoom) {
            $userSeat = 0;
            foreach ($seatFilmRoom->userSeatsFilm() as $user) {
                $userSeat = $user->user()->id();
            }
            $listSeatsFilmRoom[] = [
                'id' => $seatFilmRoom->id(),
                'price' => $seatFilmRoom->price(),
                'typeSpace' => $seatFilmRoom->typeSpace(),
                'userSeat' => $userSeat
            ];
        }

        return $listSeatsFilmRoom;
    }
}
