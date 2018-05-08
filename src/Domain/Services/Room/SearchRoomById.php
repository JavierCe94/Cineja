<?php

namespace Javier\Cineja\Domain\Services\Room;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;

class SearchRoomById
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param int $id
     * @return Room
     * @throws NotFoundRoomsException
     */
    public function execute(int $id): Room
    {
        $room = $this->roomRepository->findRoomById($id);
        if (null === $room) {
            throw new NotFoundRoomsException();
        }

        return $room;
    }
}
