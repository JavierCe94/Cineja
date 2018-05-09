<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\StateFilm;

class FilmRepository extends ServiceEntityRepository
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

    /**
     * @return array|Film[]
     */
    public function findFilms(): array
    {
        $films = $this->findAll();

        return $films;
    }
}
