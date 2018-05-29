<?php

namespace Javier\Cineja\Infrastructure\Repository\Film\FilmGenre;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepository as FilmGenreRepositoryInterface;

class FilmGenreRepository extends ServiceEntityRepository implements FilmGenreRepositoryInterface
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
        $query = $this->createQueryBuilder('fg')
            ->innerJoin('fg.film', 'f')
            ->innerJoin('fg.genre', 'g')
            ->andWhere('f.stateFilm = :stateFilm')
            ->setParameter('stateFilm', $stateFilm)
            ->getQuery();

        return $query->execute();
    }
}
