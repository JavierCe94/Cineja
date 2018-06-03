<?php

namespace Javier\Cineja\Infrastructure\Repository\Room;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository as RoomRepositoryI;

class RoomRepository extends ServiceEntityRepository implements RoomRepositoryI
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

    /**
     * @param Room $room
     * @param string $state
     * @return Room
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeStateRoom(Room $room, string $state): Room
    {
        $room->setStateRoom($state);
        $this->getEntityManager()->flush();

        return $room;
    }

    /**
     * @param int $id
     * @return object|Room
     */
    public function findRoomById(int $id): ?Room
    {
        return $this->find($id);
    }

    /**
     * @param string $name
     * @return object|Room
     */
    public function findRoomByName(string $name): ?Room
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * @return array|Room[]
     */
    public function findRooms(): array
    {
        return $this->findAll();
    }
}
