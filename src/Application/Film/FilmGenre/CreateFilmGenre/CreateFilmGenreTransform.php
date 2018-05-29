<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

class CreateFilmGenreTransform implements CreateFilmGenreTransformInterface
{
    public function transform()
    {
        return 'Se ha creado la relación género película con éxito';
    }
}
