<?php

namespace Javier\Cineja\Application\FilmRoom\ShowFilmRooms;

use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;

class ShowFilmRoomsTransform implements ShowFilmRoomsTransformInterface
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
                'releaseDate' => $filmRoom->releaseDate()
            ];
        }

        return $listFilmRooms;
    }
}
