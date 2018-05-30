<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;

class ShowRooms
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(
        RoomRepository $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform
    ) {
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    public function handle(): array
    {
        return $this->showRoomsTransform->transform(
            $this->roomRepository->findRooms()
        );
    }
}
