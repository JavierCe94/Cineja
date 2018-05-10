<?php

namespace Javier\Cineja\Domain\Model\Entity\UserSeatFilm;

interface UserSeatFilmRepositoryInterface
{
    public function createUserSeatFilm(array $userSeatsFilm): array;
}
