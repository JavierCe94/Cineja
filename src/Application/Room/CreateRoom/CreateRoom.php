<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Room\CanNotCreateRoomException;
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
     * @throws CanNotCreateRoomException
     */
    public function handle(CreateRoomCommand $createRoomCommand): array
    {
        $room = new Room(
            $createRoomCommand->name(),
            $createRoomCommand->totalSeatsByRow()
        );

        try {
            $this->roomRepository->createRoom($room);
        } catch (ORMException $ORMException) {
            throw new CanNotCreateRoomException('No se ha podido crear la sala');
        }

        return ['ok' => 200];
    }
}
