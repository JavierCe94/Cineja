<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

class ShowFilmsWithRoomsTransformer implements ShowFilmsWithRoomsTransformerI
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
            foreach ($filmWithRooms->filmRooms() as $filmRoom) {
                $listRooms[] = [
                    'idFilmRoom' => $filmRoom->id(),
                    'idRoom' => $filmRoom->room()->id(),
                    'releaseDate' => $filmRoom->releaseDate()->format('d-m-Y')
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
