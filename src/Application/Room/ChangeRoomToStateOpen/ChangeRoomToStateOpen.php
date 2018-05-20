<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchRoomById);
    }

    public function handle(ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand): array
    {
        $room = $this->searchRoomById->execute(
            $changeRoomToStateOpenCommand->id()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $this->roomRepository->changeToStateOpenRoom($room);

        return [
            'data' => 'Se ha abierto la sala con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
