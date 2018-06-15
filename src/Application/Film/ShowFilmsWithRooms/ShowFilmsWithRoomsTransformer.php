<?php

namespace Javier\Cineja\Application\Film\ShowFilmsWithRooms;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;

class ShowFilmsWithRoomsTransformer implements ShowFilmsWithRoomsTransformerI
{
    /**
     * @param array|Film[] $filmsWithRooms
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return array
     */
    public function transform(array $filmsWithRooms, \DateTime $startDate, \DateTime $endDate)
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
            /* @var array|FilmRoom[] $roomsFilter */
            $roomsFilter = $filmWithRooms->filmRooms()->filter(
                function (FilmRoom $filmRoom) use ($startDate, $endDate)
                {
                    return $startDate <= $filmRoom->releaseDate() && $endDate >= $filmRoom->releaseDate();
                }
            )->getValues();
            uasort(
                $roomsFilter,
                function(FilmRoom $first, FilmRoom $second)
                {
                    return ($first->releaseDate() < $second->releaseDate()) ? -1 : 1;
                }
            );
            foreach ($roomsFilter as $filmRoom) {
                $listRooms[] = [
                    'idFilmRoom' => $filmRoom->id(),
                    'idRoom' => $filmRoom->room()->id(),
                    'releaseDate' => $filmRoom->releaseDate()->format('H:i')
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
