<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class ChangeRoomToStateOpen
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

    public function handle(ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand): array
    {
        try {
            $room = $this->searchRoomById->execute(
                $changeRoomToStateOpenCommand->id()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return ['ko' => $notFoundRoomsException->getMessage()];
        }
        $this->roomRepository->changeToStateOpenRoom($room);

        return ['ok' => 200];
    }
}
