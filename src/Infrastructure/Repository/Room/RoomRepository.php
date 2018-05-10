<?php

namespace Javier\Cineja\Infrastructure\Repository\Room;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;

class RoomRepository extends ServiceEntityRepository implements RoomRepositoryInterface
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
     * @return Room
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeToStateCloseRoom(Room $room): Room
    {
        $room->setStateRoom(StateRoom::STATE_CLOSE);
        $this->getEntityManager()->flush();

        return $room;
    }

    /**
     * @param Room $room
     * @return Room
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeToStateOpenRoom(Room $room): Room
    {
        $room->setStateRoom(StateRoom::STATE_OPEN);
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
