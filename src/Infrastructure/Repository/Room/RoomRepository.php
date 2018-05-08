<?php

namespace Javier\Cineja\Infrastructure\Repository\Room;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Room;

class RoomRepository extends ServiceEntityRepository
{
    /**
     * @param Room $room
     * @return Room
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createRoom(Room $room): Room
    {
        $this->getEntityManager()->persist($room);
        $this->getEntityManager()->flush();

        return $room;
    }

    public function findRoomById(int $id): Room
    {
        /* @var Room $room */
        $room = $this->find($id);

        return $room;
    }

    /**
     * @return array|Room[]
     */
    public function findRooms(): array
    {
        $rooms = $this->findAll();

        return $rooms;
    }
}
