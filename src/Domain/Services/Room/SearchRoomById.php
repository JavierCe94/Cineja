<?php

namespace Javier\Cineja\Domain\Services\Room;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Services\Util\Observer\Observer;

class SearchRoomById implements Observer
{
    private $stateException;
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->stateException = false;
        $this->roomRepository = $roomRepository;
    }

    public function execute(int $id): Room
    {
        $room = $this->roomRepository->findRoomById($id);
        if (null === $room) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $room;
    }

    /**
     * @throws NotFoundRoomsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundRoomsException();
        }
    }
}
