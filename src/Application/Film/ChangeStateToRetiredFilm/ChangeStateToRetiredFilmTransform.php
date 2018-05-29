<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

class ChangeStateToRetiredFilmTransform implements ChangeStateToRetiredFilmTransformInterface
{
    public function transform()
    {
        return 'Se ha retirado la película con éxito';
    }
}
