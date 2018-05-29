<?php

namespace Javier\Cineja\Application\Room\CreateRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class CreateRoom extends RoleAdmin
{
    private $roomRepository;
    private $createRoomTransform;

    public function __construct(
        RoomRepository $roomRepository,
        CreateRoomTransformInterface $createRoomTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->createRoomTransform = $createRoomTransform;
    }

    public function handle(CreateRoomCommand $createRoomCommand): string
    {
        $room = new Room(
            $createRoomCommand->name(),
            $createRoomCommand->totalSeatsByRow()
        );
        $this->roomRepository->createRoom($room);

        return $this->createRoomTransform->transform();
    }
}
