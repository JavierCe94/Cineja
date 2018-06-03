<?php

namespace Javier\Cineja\Infrastructure\Repository\UserSeatFilm;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilmRepository as UserSeatFilmRepositoryI;

class UserSeatFilmRepository extends ServiceEntityRepository implements UserSeatFilmRepositoryI
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

    /**
     * @param string $codeQr
     * @return object|UserSeatFilm
     */
    public function findUserSeatFilmByCodeQr(string $codeQr): ?UserSeatFilm
    {
        return $this->findOneBy(['codeQr' => $codeQr]);
    }
}
