<?php

namespace Javier\Cineja\Infrastructure\Repository\UserSeatFilm;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;

class UserSeatFilmRepository extends ServiceEntityRepository
{
    /**
     * @param array|UserSeatFilm[] $userSeatsFilm
     * @return array|UserSeatFilm[]
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createUserSeatFilm(array $userSeatsFilm): array
    {
        foreach ($userSeatsFilm as $userSeatFilm) {
            $this->getEntityManager()->persist($userSeatFilm);
        }
        $this->getEntityManager()->flush();

        return $userSeatsFilm;
    }

    public function findUserSeatsFilm()
    {

    }
}
