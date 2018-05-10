<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

class ShowFilmsWithRoomsTransformer implements ShowFilmsWithRoomsTransformerInterface
{
    /**
     * @param array|Film[] $filmsWithRooms
     * @return array
     */
    public function transform(array $filmsWithRooms)
    {
        $listFilmsWithRooms = [];
        foreach ($filmsWithRooms as $filmWithRooms) {
            $listGenres = [];
            foreach ($filmWithRooms->filmGenres() as $filmGenre) {
                $listGenres[] = [
                    'idFilmGenre' => $filmGenre->id(),
                    'nameGenre' => $filmGenre->genre()->name()
                ];
            }
            $listRooms = [];
            foreach ($filmWithRooms->filmRooms() as $room) {
                $listRooms[] = [
                    'idRoom' => $room->room()->id(),
                    'idFilmRoom' => $room->id(),
                    'releaseDate' => $room->releaseDate()
                ];
            }
            $listFilmsWithRooms[] = [
                'id' => $filmWithRooms->id(),
                'image' => $filmWithRooms->image(),
                'name' => $filmWithRooms->name(),
                'description' => $filmWithRooms->description(),
                'minAge' => $filmWithRooms->minAge(),
                'duration' => $filmWithRooms->duration(),
                'filmGenres' => $listGenres,
                'filmRooms' => $listRooms
            ];
        }

        return $listFilmsWithRooms;
    }
}
