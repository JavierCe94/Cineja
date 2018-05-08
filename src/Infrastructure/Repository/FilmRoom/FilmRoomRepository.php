<?php

namespace Javier\Cineja\Infrastructure\Repository\FilmRoom;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;

class FilmRoomRepository extends ServiceEntityRepository
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
}
