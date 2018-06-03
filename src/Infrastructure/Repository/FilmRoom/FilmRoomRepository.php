<?php

namespace Javier\Cineja\Infrastructure\Repository\FilmRoom;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepository as FilmRoomRepositoryI;

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
     * @return array|FilmRoom[]
     */
    public function findFilmRooms(int $idFilm): array
    {
        return $this->createQueryBuilder('fr')
            ->innerJoin('fr.film', 'f')
            ->andWhere('f.id = :idFilm')
            ->setParameter('idFilm', $idFilm)
            ->getQuery()
            ->execute();
    }
}
