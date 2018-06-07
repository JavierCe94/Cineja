<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRoomsByIdAndDate;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;

class ShowFilmRoomsByIdAndDateTransform implements ShowFilmRoomsByIdAndDateTransformI
{
    /**
     * @param array|FilmRoom[] $filmRooms
     * @return array
     */
    public function transform(array $filmRooms)
    {
        $listFilmRooms = [];
        foreach ($filmRooms as $filmRoom) {
            $listFilmRooms[] = [
                'id' => $filmRoom->id(),
                'releaseDate' => $filmRoom->releaseDate()->format('H:i'),
                'room' => [
                    'id' => $filmRoom->room()->id(),
                    'name' => $filmRoom->room()->name(),
                    'state' => $filmRoom->room()->stateRoom(),
                    'seatsRow' => $filmRoom->room()->totalSeatsByRow()
                ]
            ];
        }

        return $listFilmRooms;
    }
}
