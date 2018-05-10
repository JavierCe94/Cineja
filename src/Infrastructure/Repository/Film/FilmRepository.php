<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\StateFilm;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;

class FilmRepository extends ServiceEntityRepository implements FilmRepositoryInterface
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

    public function findFilmById(int $id): ?Film
    {
        /* @var Film $film */
        $film = $this->find($id);

        return $film;
    }

    public function findRoomsWhereVisualizeFilmStateVisible(): array
    {
        $query = $this->createQueryBuilder('f')
            ->leftJoin('f.filmRooms', 'fr')
            ->innerJoin('fr.room', 'r')
            ->andWhere('f.stateFilm = :stateFilm')
            ->andWhere('r.stateRoom = :stateRoom')
            ->setParameter('stateFilm', StateFilm::STATE_VISIBLE)
            ->setParameter('stateRoom', StateRoom::STATE_OPEN)
            ->getQuery();

        return $query->execute();
    }

    /**
     * @return array|Film[]
     */
    public function findFilms(): array
    {
        $films = $this->findAll();

        return $films;
    }
}
