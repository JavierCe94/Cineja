<?php

namespace Javier\Cineja\Infrastructure\Repository\UserSeatFilm;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;

class UserSeatFilmRepository extends ServiceEntityRepository
{
    /**
     * @param UserSeatFilm $userSeatFilm
     * @return UserSeatFilm
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createUserSeatFilm(UserSeatFilm $userSeatFilm): UserSeatFilm
    {
        $this->getEntityManager()->persist($userSeatFilm);
        $this->getEntityManager()->flush();

        return $userSeatFilm;
    }
}
