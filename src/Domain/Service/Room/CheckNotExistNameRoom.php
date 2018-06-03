<?php

namespace Javier\Cineja\Domain\Service\Room;

use Javier\Cineja\Domain\Model\Entity\Room\FoundNameRoomException;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;

class CheckNotExistNameRoom
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param string $name
     * @throws FoundNameRoomException
     */
    public function execute(string $name): void
    {
        $room = $this->roomRepository->findRoomByName($name);
        if (null !== $room) {
            throw new FoundNameRoomException();
        }
    }
}
