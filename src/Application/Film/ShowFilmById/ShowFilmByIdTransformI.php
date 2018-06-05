<?php

namespace Javier\Cineja\Application\Film\ShowFilmById;

use Javier\Cineja\Domain\Model\Entity\Film\Film;

interface ShowFilmByIdTransformI
{
    public function transform(Film $film);
}
