<?php

namespace Javier\Cineja\Application\UserSeatFilm\ShowUserSeatsFilm;

use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;

class ShowUserSeatsFilmTransform implements ShowUserSeatsFilmTransformInterface
{
    /**
     * @param array|UserSeatFilm[] $seatsFilm
     * @return array
     */
    public function transform(array $seatsFilm)
    {
        $listSeatsFilm = [];
        foreach ($seatsFilm as $seatFilm) {
            $listSeatsFilm[] = [
                'id' => $seatFilm->id(),
                'seat' => [
                    'id' => $seatFilm->seat()->id(),
                    'price' => $seatFilm->seat()->price(),
                    'typeSpace' => $seatFilm->seat()->typeSpace()
                ]
            ];
        }

        return $listSeatsFilm;
    }
}
