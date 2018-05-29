<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

class CreateFilmTransform implements CreateFilmTransformInterface
{
    public function transform()
    {
        return 'Se ha creado la película con éxito';
    }
}
