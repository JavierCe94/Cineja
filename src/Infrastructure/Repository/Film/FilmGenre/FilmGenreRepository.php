<?php

namespace Javier\Cineja\Infrastructure\Repository\Film\FilmGenre;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepository as FilmGenreRepositoryI;

class FilmGenreRepository extends ServiceEntityRepository implements FilmGenreRepositoryI
{
    /**
     * @param FilmGenre $filmGenre
     * @return FilmGenre
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFilmGenre(FilmGenre $filmGenre): FilmGenre
    {
        $this->getEntityManager()->persist($filmGenre);
        $this->getEntityManager()->flush();

        return $filmGenre;
    }

    public function findFilmsGenresWithStateVisible(string $stateFilm): array
    {
        return $this->createQueryBuilder('fg')
            ->innerJoin('fg.film', 'f')
            ->innerJoin('fg.genre', 'g')
            ->andWhere('f.stateFilm = :stateFilm')
            ->setParameter('stateFilm', $stateFilm)
            ->getQuery()
            ->execute();
    }
}
