<?php

namespace Javier\Cineja\Infrastructure\Repository\FilmRoom;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoomRepositoryInterface;

class FilmRoomRepository extends ServiceEntityRepository implements FilmRoomRepositoryInterface
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

    public function findFilmRoomById(int $id): FilmRoom
    {
        /* @var FilmRoom $filmRoom */
        $filmRoom = $this->find($id);

        return $filmRoom;
    }

    /**
     * @param int $idFilm
     * @return array|FilmRoom[]
     */
    public function findFilmRooms(int $idFilm): array
    {
        $query = $this->createQueryBuilder('fr')
            ->innerJoin('fr.film', 'f')
            ->andWhere('f.id = :idFilm')
            ->setParameter('idFilm', $idFilm)
            ->getQuery();

        return $query->execute();
    }
}
