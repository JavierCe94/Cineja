<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Model\Entity\Room\StateRoom;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class ChangeRoomToStateOpen
{
    private $roomRepository;
    private $changeRoomToStateOpenTransform;
    private $searchRoomById;

    public function __construct(
        RoomRepository $roomRepository,
        ChangeRoomToStateOpenTransformI $changeRoomToStateOpenTransform,
        SearchRoomById $searchRoomById
    ) {
        $this->roomRepository = $roomRepository;
        $this->changeRoomToStateOpenTransform = $changeRoomToStateOpenTransform;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand): string
    {
        $this->roomRepository->changeStateRoom(
            $this->searchRoomById->execute(
                $changeRoomToStateOpenCommand->id()
            ),
            StateRoom::STATE_OPEN
        );

        return $this->changeRoomToStateOpenTransform->transform();
    }
}
