<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;

class CreateRoom
{
    private $roomRepository;
    private $createRoomTransform;

    public function __construct(
        RoomRepository $roomRepository,
        CreateRoomTransformInterface $createRoomTransform
    ) {
        $this->roomRepository = $roomRepository;
        $this->createRoomTransform = $createRoomTransform;
    }

    public function handle(CreateRoomCommand $createRoomCommand): string
    {
        $this->roomRepository->createRoom(
            new Room(
                $createRoomCommand->name(),
                $createRoomCommand->totalSeatsByRow()
            )
        );

        return $this->createRoomTransform->transform();
    }
}
