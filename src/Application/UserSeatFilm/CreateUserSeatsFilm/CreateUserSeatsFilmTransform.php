<?php

namespace Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm;

class CreateUserSeatsFilmTransform implements CreateUserSeatsFilmTransformI
{
    public function transform()
    {
        return 'Se ha creado la relación usuario, asiento, película con éxito';
    }
}
