<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class ShowRooms
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform
    ) {
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    public function handle(): array
    {
        $listRooms = $this->roomRepository->findRooms();

        return [
            'data' => $this->showRoomsTransform->transform($listRooms),
            'code' => HttpResponses::OK
        ];
    }
}
