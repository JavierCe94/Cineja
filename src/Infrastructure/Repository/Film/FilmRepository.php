<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\ORM\EntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Film;

class FilmRepository extends EntityRepository
{
    /**
     * @param Film $film
     * @return Film
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFilm(Film $film): Film
    {
        $this->getEntityManager()->persist($film);
        $this->getEntityManager()->flush();

        return $film;
    }
}
