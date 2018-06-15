<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;

class ShowSeatsFilmRoomTransform implements ShowSeatsFilmRoomTransformI
{
    /**
     * @param array|Seat[] $seats
     * @param int $filmRoom
     * @return array
     */
    public function transform(array $seats, int $filmRoom)
    {
        $listSeats = [];
        foreach ($seats as $seat) {
            $usersSeatFilm = [];
            $userSeatFilmFilter = $seat->userSeatFilm()->filter(
                function (UserSeatFilm $userSeatFilm) use ($filmRoom)
                {
                    return $filmRoom === $userSeatFilm->filmRoom()->id();
                }
            );
            foreach ($userSeatFilmFilter as $userSeatFilm) {
                $usersSeatFilm[] = [
                    'id' => $userSeatFilm->id(),
                    'codeQr' => $userSeatFilm->codeQr()
                ];
            }
            $listSeats[] = [
                'id' => $seat->id(),
                'price' => $seat->price(),
                'typeSpace' => $seat->typeSpace(),
                'usersSeatFilm' => $usersSeatFilm
            ];
        }

        return $listSeats;
    }
}
