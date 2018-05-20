<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class CreateRoom
{
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function handle(CreateRoomCommand $createRoomCommand): array
    {
        $room = new Room(
            $createRoomCommand->name(),
            $createRoomCommand->totalSeatsByRow()
        );
        $this->roomRepository->createRoom($room);

        return [
            'data' => 'Se ha creado la sala con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
