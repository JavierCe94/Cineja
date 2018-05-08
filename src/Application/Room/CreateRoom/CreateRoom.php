<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;

class CreateRoom
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param CreateRoomCommand $createRoomCommand
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateRoomCommand $createRoomCommand): array
    {
        $room = new Room(
            $createRoomCommand->name(),
            $createRoomCommand->totalSeatsByRow()
        );
        $this->roomRepository->createRoom($room);

        return ['ok' => 200];
    }
}
