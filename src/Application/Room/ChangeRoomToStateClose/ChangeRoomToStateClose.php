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

    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): array
    {
        try {
            $room = $this->searchRoomById->execute(
                $changeRoomToStateCloseCommand->id()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return [
                'data' => $notFoundRoomsException->getMessage(),
                'code' => $notFoundRoomsException->getCode()
            ];
        }
        $this->roomRepository->changeToStateCloseRoom($room);

        return [
            'data' => 'Se ha cerrado la sala con éxito',
            'code' => 200
        ];
    }
}
