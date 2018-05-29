<?php

namespace Javier\Cineja\Domain\Model\Entity\UserSeatFilm;

interface UserSeatFilmRepository
{
    public function createUserSeatFilm(array $userSeatsFilm): array;
}
