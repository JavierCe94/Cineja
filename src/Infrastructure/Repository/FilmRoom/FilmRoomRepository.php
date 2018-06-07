<?php

namespace Javier\Cineja\Infrastructure\Repository\FilmRoom;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepository as FilmRoomRepositoryI;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;

class FilmRoomRepository extends ServiceEntityRepository implements FilmRoomRepositoryI
{
    /**
     * @param FilmRoom $filmRoom
     * @return FilmRoom
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFilmRoom(FilmRoom $filmRoom): FilmRoom
    {
        $this->getEntityManager()->persist($filmRoom);
        $this->getEntityManager()->flush();

        return $filmRoom;
    }

    /**
     * @param int $id
     * @return object|FilmRoom
     */
    public function findFilmRoomById(int $id): ?FilmRoom
    {
        return $this->find($id);
    }

    /**
     * @param int $idFilm
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return array|FilmRoom[]
     */
    public function findFilmRoomsByIdAndDate(int $idFilm, \DateTime $startDate, \DateTime $endDate): array
    {
        return $this->createQueryBuilder('fr')
            ->innerJoin('fr.film', 'f')
            ->innerJoin('fr.room', 'ro')
            ->andWhere('f.id = :idFilm')
            ->andWhere('ro.stateRoom = :stateRoom')
            ->andWhere('fr.releaseDate BETWEEN :startDate AND :endDate')
            ->setParameter('idFilm', $idFilm)
            ->setParameter('stateRoom', StateRoom::STATE_OPEN)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('fr.releaseDate', 'asc')
            ->getQuery()
            ->execute();
    }
}
