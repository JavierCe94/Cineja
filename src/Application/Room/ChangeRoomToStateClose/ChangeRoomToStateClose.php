<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class ChangeRoomToStateClose
{
    private $roomRepository;
    private $changeRoomToStateCloseTransform;
    private $searchRoomById;

    public function __construct(
        RoomRepository $roomRepository,
        ChangeRoomToStateCloseTransformI $changeRoomToStateCloseTransform,
        SearchRoomById $searchRoomById
    ) {
        $this->roomRepository = $roomRepository;
        $this->changeRoomToStateCloseTransform = $changeRoomToStateCloseTransform;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): string
    {
        $this->roomRepository->changeStateRoom(
            $this->searchRoomById->execute(
                $changeRoomToStateCloseCommand->id()
            ),
            StateRoom::STATE_CLOSE
        );

        return $this->changeRoomToStateCloseTransform->transform();
    }
}
