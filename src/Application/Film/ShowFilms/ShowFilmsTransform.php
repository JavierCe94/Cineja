<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

class ShowFilmsTransform implements ShowFilmsTransformInterface
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
            $listFilms[] = [
                'id' => $film->id(),
                'image' => $film->image(),
                'name' => $film->name(),
                'description' => $film->description(),
                'minAge' => $film->minAge(),
                'duration' => $film->duration(),
                'filmGenres' => $listGenres
            ];
        }

        return $listFilms;
    }
}
