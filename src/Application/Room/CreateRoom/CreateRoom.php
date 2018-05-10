<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;

class CreateRoom
{
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param CreateRoomCommand $createRoomCommand
     * @return array
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
