<?php

namespace Javier\Cineja\Application\Film\ShowFilmById;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

class ShowFilmByIdTransform implements ShowFilmByIdTransformI
{
    public function transform(Film $film)
    {
        $listGenres = [];
        foreach ($film->filmGenres() as $filmGenre) {
            $listGenres[] = [
                'id' => $filmGenre->id(),
                'name' => $filmGenre->genre()->name()
            ];
        }

        return [
            'id' => $film->id(),
            'image' => $film->image(),
            'name' => $film->name(),
            'description' => $film->description(),
            'minAge' => $film->minAge(),
            'duration' => $film->duration(),
            'genres' => $listGenres
        ];
    }
}
