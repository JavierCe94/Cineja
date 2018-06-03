<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Service\Room\CheckNotExistNameRoom;

class CreateRoom
{
    private $roomRepository;
    private $createRoomTransform;
    private $checkNotExistNameRoom;

    public function __construct(
        RoomRepository $roomRepository,
        CreateRoomTransformI $createRoomTransform,
        CheckNotExistNameRoom $checkNotExistNameRoom
    ) {
        $this->roomRepository = $roomRepository;
        $this->createRoomTransform = $createRoomTransform;
        $this->checkNotExistNameRoom = $checkNotExistNameRoom;
    }

    /**
     * @param CreateRoomCommand $createRoomCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\FoundNameRoomException
     */
    public function handle(CreateRoomCommand $createRoomCommand): string
    {
        $this->checkNotExistNameRoom->execute(
            $createRoomCommand->name()
        );
        $this->roomRepository->createRoom(
            new Room(
                $createRoomCommand->name(),
                $createRoomCommand->totalSeatsByRow()
            )
        );

        return $this->createRoomTransform->transform();
    }
}
