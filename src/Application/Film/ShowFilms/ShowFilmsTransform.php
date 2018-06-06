<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

class ShowFilmsTransform implements ShowFilmsTransformI
{
    /**
     * @param array|Film[] $films
     * @return array
     */
    public function transform(array $films)
    {
        $listFilms = [];
        foreach ($films as $film) {
            $listGenres = [];
            foreach ($film->filmGenres() as $filmGenre) {
                $listGenres[] = [
                    'idFilmGenre' => $filmGenre->id(),
                    'nameGenre' => $filmGenre->genre()->name()
                ];
            }
            $listRooms = [];
            foreach ($film->filmRooms() as $filmRoom) {
                $listRooms[] = [
                    'idFilmRoom' => $filmRoom->id(),
                    'idRoom' => $filmRoom->room()->id(),
                    'releaseDate' => $filmRoom->releaseDate()->format('d-m-Y')
                ];
            }
            $listFilms[] = [
                'id' => $film->id(),
                'image' => $film->image(),
                'name' => $film->name(),
                'description' => $film->description(),
                'minAge' => $film->minAge(),
                'duration' => $film->duration(),
                'filmGenres' => $listGenres,
                'filmRooms' => $listRooms
            ];
        }

        return $listFilms;
    }
}
