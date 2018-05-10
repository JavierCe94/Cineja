<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class ChangeRoomToStateClose
{
    private $roomRepository;
    private $searchRoomById;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        SearchRoomById $searchRoomById
    ) {
        $this->roomRepository = $roomRepository;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand
     * @return array
     */
    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): array
    {
        try {
            $room = $this->searchRoomById->execute(
                $changeRoomToStateCloseCommand->id()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return ['ko' => $notFoundRoomsException->getMessage()];
        }
        $this->roomRepository->changeToStateCloseRoom($room);

        return ['ok' => 200];
    }
}
