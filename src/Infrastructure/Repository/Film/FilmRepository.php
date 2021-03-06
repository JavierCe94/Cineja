<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository as FilmRepositoryI;
use Javier\Cineja\Domain\Model\Entity\Film\StateFilm;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;
use Javier\Cineja\Infrastructure\Util\Specification\AndX;
use Javier\Cineja\Infrastructure\Util\Specification\AsArray;
use Javier\Cineja\Infrastructure\Util\Specification\Film\FilterFilmByDate;

class FilmRepository extends ServiceEntityRepository implements FilmRepositoryI
{
    private const MAX_FILMS = 30;

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

    /**
     * @param Film $film
     * @return Film
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeToStateRetiredFilm(Film $film): Film
    {
        $film->setStateFilm(StateFilm::STATE_RETIRED);
        $this->getEntityManager()->flush();

        return $film;
    }

    /**
     * @param int $id
     * @return object|Film
     */
    public function findFilmById(int $id): ?Film
    {
        return $this->find($id);
    }

    /**
     * @param string $name
     * @return object|Film
     */
    public function findFilmByName(string $name): ?Film
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findRoomsWhereVisualizeFilmStateVisible(\DateTime $startDate, \DateTime $endDate): array
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.filmRooms', 'fr')
            ->innerJoin('fr.room', 'ro')
            ->andWhere('f.stateFilm = :stateFilm')
            ->andWhere('ro.stateRoom = :stateRoom')
            ->andWhere('fr.releaseDate BETWEEN :startDate AND :endDate')
            ->setParameter('stateFilm', StateFilm::STATE_VISIBLE)
            ->setParameter('stateRoom', StateRoom::STATE_OPEN)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('f.id', 'desc')
            ->getQuery()
            ->execute();
    }

    public function findFilms(?\DateTime $startDate, ?\DateTime $endDate): array
    {
        $query = $this->createQueryBuilder('f')
            ->leftJoin('f.filmRooms', 'fr')
            ->andWhere('f.stateFilm = :stateFilm')
            ->setParameter('stateFilm', StateFilm::STATE_VISIBLE)
            ->orderBy('f.id', 'desc')
            ->setMaxResults(self::MAX_FILMS);
        (new AsArray(
            new AndX(
                new FilterFilmByDate($startDate, $endDate)
            )
        ))->match($query);

        return $query->getQuery()->execute();
    }
}
