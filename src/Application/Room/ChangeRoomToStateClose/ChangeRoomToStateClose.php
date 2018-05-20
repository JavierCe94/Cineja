<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchRoomById);
    }

    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): array
    {
        $room = $this->searchRoomById->execute(
            $changeRoomToStateCloseCommand->id()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $this->roomRepository->changeToStateCloseRoom($room);

        return [
            'data' => 'Se ha cerrado la sala con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
